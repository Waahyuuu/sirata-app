<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KampusApiService;
use App\Models\ChatSession;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class MahasiswaController extends Controller
{
    public function index()
    {
        return redirect('/');
    }

    private function getMahasiswaData($api)
    {
        $session = session('mahasiswa');

        if (!$session) return null;

        $nim = $session['nim'];

        return Cache::remember("mahasiswa_biodata_$nim", now()->addMinutes(30), function () use ($api, $nim) {

            $mahasiswaByNim = $api->getMahasiswaByNim($nim);

            if (!$mahasiswaByNim) {
                return null;
            }

            $email = $mahasiswaByNim['stimata_email'] ?? null;

            if (!$email) {
                return null;
            }

            return $api->getMahasiswaByEmail($email);
        });
    }

    private function getSemesterData($api, $nim)
    {
        return Cache::remember("semester_data_$nim", now()->addMinutes(30), function () use ($api, $nim) {

            $semesterList = [];
            $totalSksLulus = 0;
            $totalSksDiambil = 0;
            $totalBobotKumulatif = 0;
            $semesterAktif = '-';
            $mataKuliahSemesterIni = [];

            // Cari semester aktif terlebih dahulu
            $maxSemester = 1;
            for ($s = 1; $s <= 14; $s++) {
                $krsData = $api->getKrsDetail($nim, $s);
                if ($krsData && !empty($krsData)) {
                    $maxSemester = $s;
                    $semesterAktif = $s;
                    $mataKuliahSemesterIni = $krsData;
                }
            }

            // Looping dari 1 sampai semester aktif
            for ($semester = 1; $semester <= $maxSemester; $semester++) {

                $krsData = $api->getKrsDetail($nim, $semester);
                $khsData = $api->getKhs($nim, $semester);

                if (!$krsData || empty($krsData)) {
                    // Jika tidak ada KRS, tetap tampilkan dengan data 0
                    $semesterList[] = [
                        'semester' => $semester,
                        'ip' => 0,
                        'ipk' => $totalSksLulus > 0 ? round($totalBobotKumulatif / $totalSksLulus, 2) : 0,
                        'sks' => 0,
                        'sks_diambil' => 0,
                        'krs' => [],
                        'khs' => [],
                        'has_khs' => false,
                        'is_empty' => true,
                    ];
                    continue;
                }

                $sksDiambilSemester = collect($krsData)
                    ->sum(fn($item) => $item['course']['credits'] ?? 0);
                $totalSksDiambil += $sksDiambilSemester;

                $ipSemester = $khsData['semester_gpa'] ?? 0;
                $sksLulusSemester = $khsData['total_credits'] ?? 0;

                if ($sksLulusSemester > 0) {
                    $totalSksLulus += $sksLulusSemester;
                    $totalBobotKumulatif += ($ipSemester * $sksLulusSemester);
                }

                $ipkSaatIni = $totalSksLulus > 0
                    ? ($totalBobotKumulatif / $totalSksLulus)
                    : 0;

                $semesterList[] = [
                    'semester' => $semester,
                    'ip' => round($ipSemester, 2),
                    'ipk' => round($ipkSaatIni, 2),
                    'sks' => $sksLulusSemester,
                    'sks_diambil' => $sksDiambilSemester,
                    'krs' => $krsData,
                    'khs' => $khsData,
                    'has_khs' => $sksLulusSemester > 0,
                    'is_empty' => false,
                ];
            }

            return [
                'semesterList' => $semesterList,
                'semesterAktif' => $semesterAktif,
                'mataKuliahSemesterIni' => $mataKuliahSemesterIni,
                'totalSksLulus' => $totalSksLulus,
                'totalSksDiambil' => $totalSksDiambil,
            ];
        });
    }

    /*
    |--------------------------------------------------------------------------
    | CARI - LOGIN ORANG TUA (DIPERBAIKI)
    |--------------------------------------------------------------------------
    */
    public function cari(Request $request, KampusApiService $api)
    {
        $request->validate([
            'nim'           => 'required|string',
            'nama_ibu'      => 'required|string|min:3',
            'tanggal_lahir' => 'required|date',
        ]);

        // 1. Cari mahasiswa di API
        $mahasiswaByNim = $api->getMahasiswaByNim($request->nim);

        if (!$mahasiswaByNim || empty($mahasiswaByNim['stimata_email'])) {
            return redirect('/#sirata')->with('error', 'Data mahasiswa tidak ditemukan');
        }

        $email = $mahasiswaByNim['stimata_email'];
        $mahasiswa = $api->getMahasiswaByEmail($email);

        if (!$mahasiswa) {
            return redirect('/#sirata')->with('error', 'Data detail mahasiswa tidak ditemukan');
        }

        // 2. Validasi data
        $prospective = $mahasiswa['prospective'];
        try {
            $tglApi   = \Carbon\Carbon::parse($prospective['birth_date'])->format('Y-m-d');
            $tglInput = \Carbon\Carbon::parse($request->tanggal_lahir)->format('Y-m-d');
        } catch (\Exception $e) {
            return redirect('/#sirata')->with('error', 'Tanggal tidak valid');
        }

        if (
            $tglApi !== $tglInput ||
            strtolower(trim($prospective['mother_name'])) !== strtolower(trim($request->nama_ibu))
        ) {
            return redirect('/')
                ->with('error', 'Data tidak cocok')
                ->with('scroll', 'sirata');
        }

        $nim = $mahasiswaByNim['nim'] ?? null;

        if (!$nim) {
            return redirect('/#sirata')
                ->with('error', 'NIM tidak ditemukan');
        }

        $nama = data_get($mahasiswa, 'prospective.name')
            ?? data_get($mahasiswa, 'name')
            ?? 'Mahasiswa';

        // ============================================================
        // 3. === VALIDASI BERHASIL - SIMPAN SESSION ORANG TUA ===
        // ============================================================

        // Buat client_id dengan format: ortu-{nama}-{nim}
        $namaSlug = str_replace(' ', '', $nama);
        $clientId = 'orangtua-' . $namaSlug . '-' . $nim;

        // Cek atau buat ChatSession
        $chatSession = ChatSession::updateOrCreate(
            ['client_id' => $clientId],
            [
                'nim' => $nim,
                'nama_mahasiswa' => $nama,
                'nama_ibu' => $request->nama_ibu,
                'email' => $email,
                'status' => 'parent'
            ]
        );

        // =============================================
        // PERBAIKAN 1: Update messages dengan try-catch
        // =============================================
        try {
            // Update semua pesan yang sudah ada dengan client_id ini
            Message::where('client_id', $clientId)
                ->whereNull('chat_session_id')
                ->update(['chat_session_id' => $chatSession->id]);
        } catch (\Exception $e) {
            Log::warning('chat_session_id column not found, skipping update: ' . $e->getMessage());
        }

        // =============================================
        // PERBAIKAN 2: Set cookie untuk client_id baru
        // =============================================
        setcookie('client_id', $clientId, time() + 86400 * 30, '/');

        // Simpan ke session Laravel
        session([
            'client_id' => $clientId,
            'chat_session_id' => $chatSession->id,
            'mahasiswa' => [
                'nama' => $nama,
                'nim'  => $nim,
                'nama_ibu' => $request->nama_ibu,
                'tanggal_lahir' => $request->tanggal_lahir,
                'client_id' => $clientId,
                'chat_session_id' => $chatSession->id
            ]
        ]);

        return redirect('/mahasiswa/dashboard')
            ->with('success', 'Berhasil masuk dashboard')
            ->with('refresh', true); // ← TAMBAHKAN flag refresh
    }

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    public function dashboard(KampusApiService $api)
    {
        $session = session('mahasiswa');

        if (!$session) {
            return redirect('/')
                ->with('error', 'Silakan isi data terlebih dahulu');
        }

        $nim = $session['nim'] ?? null;

        if (!$nim) {
            return redirect('/')
                ->with('error', 'NIM tidak ditemukan');
        }

        $mahasiswa = $this->getMahasiswaData($api);

        if (!$mahasiswa) {
            return redirect('/')
                ->with('error', 'Data mahasiswa tidak ditemukan');
        }

        $transkripResponse = $api->getTranskrip($nim, true);

        $transkripData = $transkripResponse['data']
            ?? $transkripResponse
            ?? [];

        $semesterData = $this->getSemesterData($api, $nim);
        $semesterList = $semesterData['semesterList'];
        $semesterAktif = $semesterData['semesterAktif'];
        $mataKuliahSemesterIni = $semesterData['mataKuliahSemesterIni'];
        $totalSksLulus = $semesterData['totalSksLulus'];
        $totalSksDiambil = $semesterData['totalSksDiambil'];
        $chartLabels = [];
        $chartIP = [];
        $chartIPK = [];

        foreach ($semesterList as $smt) {

            $chartLabels[] = 'Smt ' . $smt['semester'];

            $chartIP[] = $smt['ip'];

            $chartIPK[] = $smt['ipk'];
        }

        // IPK
        $ipk = !empty($chartIPK)
            ? end($chartIPK)
            : 0;

        $nama = $session['nama'] ?? 'Mahasiswa';
        $prodi = $transkripData['department'] ?? '-';
        $initial = strtoupper(substr($nama, 0, 1));

        $hariMap = [
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
            'Sunday'    => 'Minggu',
        ];

        $hariSekarangEn = now()->format('l');
        $hariIni = $hariMap[$hariSekarangEn] ?? 'Senin';

        // Ambil jadwal dari API
        $jadwalApi = Cache::remember(
            "dashboard_jadwal_$nim",
            now()->addMinutes(30),
            function () use ($api, $nim) {
                return $api->getJadwalMahasiswa($nim);
            }
        );

        $jadwalHariIni = [];

        if (!empty($jadwalApi) && is_array($jadwalApi)) {

            foreach ($jadwalApi as $item) {

                $day = trim(strtolower($item['day'] ?? ''));
                $dayMap = [
                    'monday'    => 'Senin',
                    'tuesday'   => 'Selasa',
                    'wednesday' => 'Rabu',
                    'thursday'  => 'Kamis',
                    'friday'    => 'Jumat',
                    'saturday'  => 'Sabtu',
                    'sunday'    => 'Minggu',

                    // jika API sudah Indonesia
                    'senin'  => 'Senin',
                    'selasa' => 'Selasa',
                    'rabu'   => 'Rabu',
                    'kamis'  => 'Kamis',
                    'jumat'  => 'Jumat',
                    'sabtu'  => 'Sabtu',
                    'minggu' => 'Minggu',
                ];

                $dayFormatted = $dayMap[$day] ?? null;
                if ($dayFormatted !== $hariIni) {
                    continue;
                }

                $jadwalHariIni[] = [
                    'nama' => data_get($item, 'course.course_name')
                        ?? $item['course_name']
                        ?? '-',

                    'jam' => ($item['start_time'] ?? '--:--')
                        . ' - ' .
                        ($item['end_time'] ?? '--:--'),

                    'ruangan' => data_get($item, 'room.name')
                        ?? $item['room_name']
                        ?? '-',

                    'dosen' => data_get($item, 'lecturer.name')
                        ?? '-',
                ];
            }
        }

        return view('mahasiswa.dashboard.index', compact(
            'mahasiswa',
            'nama',
            'nim',
            'initial',
            'prodi',
            'semesterAktif',
            'totalSksLulus',
            'totalSksDiambil',
            'ipk',
            'mataKuliahSemesterIni',
            'jadwalHariIni',
            'chartLabels',
            'chartIP',
            'chartIPK'
        ));
    }

    public function biodata(KampusApiService $api)
    {
        $mahasiswa = $this->getMahasiswaData($api);

        if (!$mahasiswa) {
            return redirect('/')
                ->with('error', 'Data tidak ditemukan');
        }

        $session = session('mahasiswa');

        $nama = $session['nama'] ?? 'Mahasiswa';
        $nim  = $session['nim'] ?? '-';
        $initial = strtoupper(substr($nama, 0, 1));

        return view('mahasiswa.biodata.index', compact(
            'mahasiswa',
            'nama',
            'nim',
            'initial'
        ));
    }

    public function hasilStudi(KampusApiService $api)
    {
        $mahasiswa = session('mahasiswa');

        if (!$mahasiswa) {
            return redirect('/')
                ->with('error', 'Silakan isi data terlebih dahulu');
        }

        $nim = $mahasiswa['nim'] ?? null;

        if (!$nim) {
            return redirect('/')
                ->with('error', 'NIM tidak ditemukan');
        }

        $khs = Cache::remember("hasil_studi_$nim", 3000, function () use ($api, $nim) {

            $semesterList = [];

            $totalSksLulus = 0;
            $totalSksDiambil = 0;
            $totalBobotKumulatif = 0;

            for ($semester = 1; $semester <= 14; $semester++) {

                $krsData = $api->getKrsDetail($nim, $semester);

                if (!$krsData || empty($krsData)) {
                    continue;
                }

                $khsData = $api->getKhs($nim, $semester);
                $infoKrs = $krsData[0];
                $sksDiambilSemester = collect($krsData)
                    ->sum(fn($item) => $item['course']['credits'] ?? 0);

                $totalSksDiambil += $sksDiambilSemester;
                $sksLulusSemester = $khsData['total_credits'] ?? 0;
                $ipSemester = $khsData['semester_gpa'] ?? 0;

                if ($sksLulusSemester > 0) {

                    $totalSksLulus += $sksLulusSemester;

                    $totalBobotKumulatif += (
                        $ipSemester * $sksLulusSemester
                    );
                }

                $ipkSaatIni = $totalSksLulus > 0
                    ? ($totalBobotKumulatif / $totalSksLulus)
                    : 0;

                $itemsToDisplay = [];

                if (!empty($khsData['items'])) {

                    $itemsToDisplay = $khsData['items'];
                } else {

                    foreach ($krsData as $krsItem) {

                        $itemsToDisplay[] = [
                            'course_code' => $krsItem['course']['course_code'] ?? '-',
                            'course_name' => $krsItem['course']['course_name'] ?? '-',
                            'credits'     => $krsItem['course']['credits'] ?? 0,
                            'predicate'   => '-',
                            'grade_point' => 0
                        ];
                    }
                }

                $semesterList[] = [
                    'semester'   => $infoKrs['class']['semester'] ?? $semester,
                    'nama'       => 'Semester ' . ($infoKrs['class']['semester'] ?? $semester),
                    'period'     => $infoKrs['period'] ?? 'Semester',
                    'year'       => $infoKrs['academic_year'] ?? '',
                    'sks'        => ($sksLulusSemester > 0)
                        ? $sksLulusSemester
                        : $sksDiambilSemester,

                    'ip'         => $ipSemester,

                    'ipk'        => round($ipkSaatIni, 2),

                    'is_running' => ($sksLulusSemester == 0),

                    'items'      => $itemsToDisplay
                ];
            }

            return [
                'ipk' => $totalSksLulus > 0
                    ? ($totalBobotKumulatif / $totalSksLulus)
                    : 0,

                'total_sks_lulus' => $totalSksLulus,

                'total_sks_diambil' => $totalSksDiambil,

                'semester' => $semesterList
            ];
        });

        $nama = $mahasiswa['nama'] ?? 'Mahasiswa';

        $initial = strtoupper(substr($nama, 0, 1));

        return view('mahasiswa.hasilstudi.index', compact(
            'khs',
            'nama',
            'nim',
            'initial'
        ));
    }

    public function salinanNilai(KampusApiService $api)
    {
        $mahasiswa = session('mahasiswa');

        if (!$mahasiswa) {
            return redirect('/')
                ->with('error', 'Silakan isi data terlebih dahulu');
        }

        $nim = $mahasiswa['nim'] ?? null;

        if (!$nim) {
            return redirect('/')
                ->with('error', 'NIM tidak ditemukan');
        }

        $cacheKey = "salinan_nilai_$nim";

        $cachedData = Cache::get($cacheKey);

        if ($cachedData) {
            $transkrip = $cachedData['transkrip'];
            $nama = $cachedData['nama'];
            $initial = $cachedData['initial'];

            return view('mahasiswa.salinannilai.index', compact(
                'mahasiswa',
                'transkrip',
                'nama',
                'nim',
                'initial'
            ));
        }

        $response = $api->getTranskrip($nim, true);

        if (!$response) {
            return redirect('/')
                ->with('error', 'Data transkrip tidak ditemukan');
        }

        $data = $response['data'] ?? $response;

        // Validasi minimal data
        if (empty($data) || empty($data['nim'])) {
            return redirect('/')
                ->with('error', 'Data transkrip tidak valid');
        }

        // Ambil data hasil studi untuk perhitungan yang lebih akurat
        $hasilStudi = $this->getHasilStudiData($api, $nim);

        // Format TTL
        $ttl = '-';

        if (!empty($data['birth_place']) && !empty($data['birth_date'])) {
            try {
                $ttl = $data['birth_place'] . ', ' .
                    Carbon::parse($data['birth_date'])
                    ->translatedFormat('d F Y');
            } catch (\Exception $e) {
                $ttl = $data['birth_place'];
            }
        }

        // Ambil tahun angkatan dari NIM
        $angkatan = '-';

        if (!empty($data['nim'])) {
            $nimString = (string) $data['nim'];

            $angkatan = '20' . substr($nimString, 0, 2);
        }

        // Mata kuliah
        $matkul = [];

        foreach (($data['courses'] ?? []) as $course) {
            $matkul[] = [
                'kode'  => $course['course_code'] ?? '-',
                'nama'  => $course['course_name'] ?? '-',
                'sks'   => $course['credits'] ?? 0,
                'nilai' => $course['predicate'] ?? '-',
            ];
        }

        if ($hasilStudi && isset($hasilStudi['total_sks_lulus'])) {
            $totalSksLulus = $hasilStudi['total_sks_lulus'];
            $totalSksTempuh = $hasilStudi['total_sks_diambil'] ?? $this->calculateTotalSksFromCourses($data['courses'] ?? []);
            $ipk = $hasilStudi['ipk'] ?? 0;
        } else {
            // Fallback ke perhitungan manual dari data transkrip
            $totalSksTempuh = $this->calculateTotalSksFromCourses($data['courses'] ?? []);

            $totalSksLulus = collect($data['courses'] ?? [])
                ->filter(function ($item) {
                    return ($item['grade_point'] ?? 0) > 0;
                })
                ->sum(function ($item) {
                    return $item['credits'] ?? 0;
                });

            // Hitung total bobot
            $totalBobot = collect($data['courses'] ?? [])
                ->sum(function ($item) {
                    return ($item['credits'] ?? 0)
                        * ($item['grade_point'] ?? 0);
                });

            // Hitung IPK manual
            $ipk = $totalSksLulus > 0
                ? ($totalBobot / $totalSksLulus)
                : 0;
        }

        if (
            isset($data['summary']['gpa']) &&
            $data['summary']['gpa'] > 0
        ) {
            if ($ipk == 0) {
                $ipk = $data['summary']['gpa'];
            }
        }

        if (
            isset($data['summary']['total_credits']) &&
            $data['summary']['total_credits'] > 0
        ) {
            if ($totalSksTempuh == 0) {
                $totalSksTempuh = $data['summary']['total_credits'];
            }
        }

        if (
            isset($data['summary']['passed_credits']) &&
            $data['summary']['passed_credits'] > 0
        ) {
            if ($totalSksLulus == 0) {
                $totalSksLulus = $data['summary']['passed_credits'];
            }
        }

        $transkrip = [
            'nama' => $data['name'] ?? ($mahasiswa['nama'] ?? 'Mahasiswa'),
            'nim' => $data['nim'] ?? $nim,
            'prodi' => $data['department'] ?? '-',
            'angkatan' => $angkatan,
            'ttl' => $ttl,
            'advisor' => $data['advisor']['name'] ?? '-',

            'matkul' => $matkul,

            'total_sks_tempuh' => $totalSksTempuh,
            'total_sks_lulus' => $totalSksLulus,
            'ipk' => round($ipk, 2),
        ];

        $nama = $mahasiswa['nama'] ?? 'Mahasiswa';
        $initial = strtoupper(substr($nama, 0, 1));

        Cache::put($cacheKey, [
            'transkrip' => $transkrip,
            'nama' => $nama,
            'initial' => $initial
        ], now()->addMinutes(30));

        return view('mahasiswa.salinannilai.index', compact(
            'mahasiswa',
            'transkrip',
            'nama',
            'nim',
            'initial'
        ));
    }

    /**
     * Helper function to get hasil studi data with cache 30 menit
     */
    private function getHasilStudiData(KampusApiService $api, $nim)
    {
        $cacheKey = "hasil_studi_data_$nim";

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($api, $nim) {
            try {
                $totalSksLulus = 0;
                $totalSksDiambil = 0;
                $totalBobotKumulatif = 0;

                for ($semester = 1; $semester <= 14; $semester++) {
                    $krsData = $api->getKrsDetail($nim, $semester);

                    if (!$krsData || empty($krsData)) {
                        continue;
                    }

                    $khsData = $api->getKhs($nim, $semester);
                    $sksDiambilSemester = collect($krsData)
                        ->sum(fn($item) => $item['course']['credits'] ?? 0);

                    $totalSksDiambil += $sksDiambilSemester;
                    $sksLulusSemester = $khsData['total_credits'] ?? 0;
                    $ipSemester = $khsData['semester_gpa'] ?? 0;

                    if ($sksLulusSemester > 0) {
                        $totalSksLulus += $sksLulusSemester;
                        $totalBobotKumulatif += ($ipSemester * $sksLulusSemester);
                    }
                }

                return [
                    'ipk' => $totalSksLulus > 0
                        ? ($totalBobotKumulatif / $totalSksLulus)
                        : 0,
                    'total_sks_lulus' => $totalSksLulus,
                    'total_sks_diambil' => $totalSksDiambil
                ];
            } catch (\Exception $e) {
                // Jika terjadi error, return null agar menggunakan fallback
                return null;
            }
        });
    }

    /**
     * Helper function to calculate total SKS from courses
     */
    private function calculateTotalSksFromCourses($courses)
    {
        if (empty($courses)) {
            return 0;
        }

        return collect($courses)->sum(function ($item) {
            return $item['credits'] ?? 0;
        });
    }

    public function jadwal(KampusApiService $api)
    {
        $session = session('mahasiswa');

        if (!$session) {
            return redirect('/')
                ->with('error', 'Silakan isi data terlebih dahulu');
        }

        $nim = $session['nim'] ?? null;

        if (!$nim) {
            return redirect('/')
                ->with('error', 'NIM tidak ditemukan');
        }

        $mahasiswa = $this->getMahasiswaData($api);

        if (!$mahasiswa) {
            return redirect('/')
                ->with('error', 'Data mahasiswa tidak ditemukan');
        }

        $hariMap = [
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
            'Sunday'    => 'Minggu',
        ];

        $hariSekarangEn = now()->format('l');
        $hariIni = $hariMap[$hariSekarangEn] ?? 'Senin';

        $jadwalApi = Cache::remember(
            "jadwal_mahasiswa_$nim",
            now()->addMinutes(30),
            function () use ($api, $nim) {
                return $api->getJadwalMahasiswa($nim);
            }
        );

        $jadwal = [
            'Senin' => [],
            'Selasa' => [],
            'Rabu' => [],
            'Kamis' => [],
            'Jumat' => [],
            'Sabtu' => [],
        ];

        if (!empty($jadwalApi)) {
            foreach ($jadwalApi as $item) {

                $day = $item['day'] ?? null;

                if (!$day || !isset($jadwal[$day])) {
                    continue;
                }

                // Format waktu menggunakan Carbon (tanpa detik)
                try {
                    $startTime = !empty($item['start_time'])
                        ? Carbon::parse($item['start_time'])->format('H:i')
                        : '--:--';
                } catch (\Exception $e) {
                    $startTime = '--:--';
                }

                try {
                    $endTime = !empty($item['end_time'])
                        ? Carbon::parse($item['end_time'])->format('H:i')
                        : '--:--';
                } catch (\Exception $e) {
                    $endTime = '--:--';
                }

                $jadwal[$day][] = [
                    'nama' => $item['course']['course_name']
                        ?? $item['course_name']
                        ?? '-',

                    'jam' => $startTime . ' - ' . $endTime,

                    'ruangan' => $item['room']['name']
                        ?? $item['room_name']
                        ?? '-',

                    'dosen' => $item['lecturer']['name']
                        ?? '-',
                ];
            }
        }

        $jadwalHariIni = $jadwal[$hariIni] ?? [];

        $nama = $session['nama'] ?? 'Mahasiswa';
        $initial = strtoupper(substr($nama, 0, 1));

        $tanggalHariIni = Carbon::now()
            ->locale('id')
            ->translatedFormat('l, d F Y');

        return view('mahasiswa.jadwal.index', compact(
            'mahasiswa',
            'jadwal',
            'jadwalHariIni',
            'hariIni',
            'tanggalHariIni',
            'nim',
            'initial',
            'nama'
        ));
    }

    public function kehadiran(KampusApiService $api)
    {
        $session = session('mahasiswa');

        if (!$session) {
            return redirect('/')
                ->with('error', 'Silakan isi data terlebih dahulu');
        }

        $nim = $session['nim'] ?? null;

        if (!$nim) {
            return redirect('/')
                ->with('error', 'NIM tidak ditemukan');
        }

        $mahasiswa = $this->getMahasiswaData($api);

        if (!$mahasiswa) {
            return redirect('/')
                ->with('error', 'Data mahasiswa tidak ditemukan');
        }

        $nama = $session['nama'] ?? 'Mahasiswa';
        $initial = strtoupper(substr($nama, 0, 1));

        // ============================================================
        //  Toggle status setiap refresh menggunakan session
        // ============================================================
        $sessionKey = 'kehadiran_status_' . $nim;

        // Ambil status sebelumnya, default false (Aman)
        $previousStatus = session($sessionKey, false);

        // Toggle: jika sebelumnya true (Cekal) → jadi false (Aman)
        //          jika sebelumnya false (Aman) → jadi true (Cekal)
        $isCekalMode = !$previousStatus;

        // Simpan status baru untuk refresh berikutnya
        session([$sessionKey => $isCekalMode]);

        // ============================================================
        // Ambil data mata kuliah dari jadwal (KRS) semester AKTIF
        // ============================================================
        $semesterData = $this->getSemesterData($api, $nim);
        $semesterAktif = $semesterData['semesterAktif'] ?? 1;
        $mataKuliahSemesterIni = $semesterData['mataKuliahSemesterIni'] ?? [];

        // Jika tidak ada mata kuliah di semester aktif, coba ambil dari semester 1
        if (empty($mataKuliahSemesterIni)) {
            $krsData = $api->getKrsDetail($nim, $semesterAktif);
            if (!empty($krsData)) {
                $mataKuliahSemesterIni = $krsData;
            }
        }

        // Jika masih kosong, coba cari semester yang memiliki KRS
        if (empty($mataKuliahSemesterIni)) {
            for ($s = $semesterAktif; $s >= 1; $s--) {
                $krsData = $api->getKrsDetail($nim, $s);
                if (!empty($krsData)) {
                    $mataKuliahSemesterIni = $krsData;
                    $semesterAktif = $s;
                    break;
                }
            }
        }

        // ============================================================
        // Generate data kehadiran berdasarkan mode (Cekal atau Aman)
        // ============================================================
        $kehadiranMatkul = [];
        $totalHadir = 0;
        $totalTidakHadir = 0;
        $cekalMatkulList = [];

        if (!empty($mataKuliahSemesterIni)) {
            foreach ($mataKuliahSemesterIni as $index => $krs) {
                // Ambil data mata kuliah dari KRS asli
                $course = $krs['course'] ?? [];
                $kodeMatkul = $course['course_code'] ?? 'MTK' . ($index + 1);
                $namaMatkul = $course['course_name'] ?? 'Mata Kuliah ' . ($index + 1);

                // ============================================================
                // 🔥 Tentukan kehadiran berdasarkan mode
                // ============================================================
                if ($isCekalMode) {
                    // MODE CEKAL: Buat 1-2 mata kuliah yang cekal
                    if ($index == 0 || $index == 2) {
                        // Cekal: hadir sedikit (4-7), tidak hadir banyak (4-8)
                        $hadir = rand(4, 7);
                        $tidakHadir = rand(4, 8);
                    } else {
                        // Normal: hadir banyak (8-14), tidak hadir sedikit (1-5)
                        $hadir = rand(8, 14);
                        $tidakHadir = rand(1, 5);
                    }
                } else {
                    // MODE AMAN: Semua mata kuliah aman (hadir >= 75%)
                    $hadir = rand(11, 15);
                    $tidakHadir = rand(0, 3);
                }

                $totalPertemuan = $hadir + $tidakHadir;
                $presentase = $totalPertemuan > 0 ? round(($hadir / $totalPertemuan) * 100) : 0;

                $totalHadir += $hadir;
                $totalTidakHadir += $tidakHadir;

                $isCekal = $presentase < 75;

                if ($isCekal) {
                    $cekalMatkulList[] = [
                        'kode' => $kodeMatkul,
                        'nama' => $namaMatkul,
                        'presentase' => $presentase . '%',
                        'hadir' => $hadir,
                        'tidak_hadir' => $tidakHadir,
                        'total_pertemuan' => $totalPertemuan,
                    ];
                }

                $kehadiranMatkul[] = [
                    'kode' => $kodeMatkul,
                    'nama' => $namaMatkul,
                    'hadir' => $hadir,
                    'tidak_hadir' => $tidakHadir,
                    'total_pertemuan' => $totalPertemuan,
                    'presentase' => $presentase . '%',
                    'is_cekal' => $isCekal,
                    'semester' => $semesterAktif,
                ];
            }
        } else {
            // ============================================================
            // 🔥 FALLBACK: Jika tidak ada data KRS sama sekali
            // ============================================================
            if ($isCekalMode) {
                // MODE CEKAL dengan data dummy
                $kehadiranMatkul = [
                    [
                        'kode' => 'TIF401',
                        'nama' => 'Pemrograman Web',
                        'hadir' => 5,
                        'tidak_hadir' => 7,
                        'total_pertemuan' => 12,
                        'presentase' => '42%',
                        'is_cekal' => true,
                        'semester' => $semesterAktif,
                    ],
                    [
                        'kode' => 'TIF402',
                        'nama' => 'Basis Data',
                        'hadir' => 6,
                        'tidak_hadir' => 6,
                        'total_pertemuan' => 12,
                        'presentase' => '50%',
                        'is_cekal' => true,
                        'semester' => $semesterAktif,
                    ],
                    [
                        'kode' => 'TIF403',
                        'nama' => 'Jaringan Komputer',
                        'hadir' => 13,
                        'tidak_hadir' => 1,
                        'total_pertemuan' => 14,
                        'presentase' => '93%',
                        'is_cekal' => false,
                        'semester' => $semesterAktif,
                    ],
                    [
                        'kode' => 'TIF404',
                        'nama' => 'Sistem Operasi',
                        'hadir' => 12,
                        'tidak_hadir' => 2,
                        'total_pertemuan' => 14,
                        'presentase' => '86%',
                        'is_cekal' => false,
                        'semester' => $semesterAktif,
                    ],
                    [
                        'kode' => 'TIF405',
                        'nama' => 'Kecerdasan Buatan',
                        'hadir' => 14,
                        'tidak_hadir' => 1,
                        'total_pertemuan' => 15,
                        'presentase' => '93%',
                        'is_cekal' => false,
                        'semester' => $semesterAktif,
                    ],
                ];
            } else {
                // MODE AMAN dengan data dummy
                $kehadiranMatkul = [
                    [
                        'kode' => 'TIF401',
                        'nama' => 'Pemrograman Web',
                        'hadir' => 12,
                        'tidak_hadir' => 2,
                        'total_pertemuan' => 14,
                        'presentase' => '86%',
                        'is_cekal' => false,
                        'semester' => $semesterAktif,
                    ],
                    [
                        'kode' => 'TIF402',
                        'nama' => 'Basis Data',
                        'hadir' => 13,
                        'tidak_hadir' => 1,
                        'total_pertemuan' => 14,
                        'presentase' => '93%',
                        'is_cekal' => false,
                        'semester' => $semesterAktif,
                    ],
                    [
                        'kode' => 'TIF403',
                        'nama' => 'Jaringan Komputer',
                        'hadir' => 14,
                        'tidak_hadir' => 1,
                        'total_pertemuan' => 15,
                        'presentase' => '93%',
                        'is_cekal' => false,
                        'semester' => $semesterAktif,
                    ],
                    [
                        'kode' => 'TIF404',
                        'nama' => 'Sistem Operasi',
                        'hadir' => 12,
                        'tidak_hadir' => 2,
                        'total_pertemuan' => 14,
                        'presentase' => '86%',
                        'is_cekal' => false,
                        'semester' => $semesterAktif,
                    ],
                    [
                        'kode' => 'TIF405',
                        'nama' => 'Kecerdasan Buatan',
                        'hadir' => 13,
                        'tidak_hadir' => 0,
                        'total_pertemuan' => 13,
                        'presentase' => '100%',
                        'is_cekal' => false,
                        'semester' => $semesterAktif,
                    ],
                ];
            }

            foreach ($kehadiranMatkul as $item) {
                $totalHadir += $item['hadir'];
                $totalTidakHadir += $item['tidak_hadir'];

                if ($item['is_cekal']) {
                    $cekalMatkulList[] = [
                        'kode' => $item['kode'],
                        'nama' => $item['nama'],
                        'presentase' => $item['presentase'],
                        'hadir' => $item['hadir'],
                        'tidak_hadir' => $item['tidak_hadir'],
                        'total_pertemuan' => $item['total_pertemuan'],
                    ];
                }
            }
        }

        // ============================================================
        // 🔥 Hitung persentase total
        // ============================================================
        $totalPertemuan = $totalHadir + $totalTidakHadir;
        $hadirPercent = $totalPertemuan > 0 ? round(($totalHadir / $totalPertemuan) * 100) : 0;
        $tidakHadirPercent = $totalPertemuan > 0 ? round(($totalTidakHadir / $totalPertemuan) * 100) : 0;

        $hasCekal = count($cekalMatkulList) > 0;
        $cekalMatkulNama = collect($cekalMatkulList)->pluck('nama')->implode(', ');

        // ============================================================
        // 🔥 Buat pesan status sesuai format yang diminta
        // ============================================================
        $batasMinimal = 75;

        if ($hasCekal) {
            // ===== PESAN CEKAL =====
            $message = "⚠️ TERANCAM CEKAL! Terdapat " . count($cekalMatkulList) . " mata kuliah yang perlu diperhatikan. " .
                "Persentase kehadiran Anda saat ini " . $hadirPercent . "%. " .
                "Batas minimal kehadiran untuk tidak terkena cekal adalah " . $batasMinimal . "%.";

            $pesanOrangTua = "⚠️ PENTING UNTUK ORANG TUA/WALI:\n\n" .
                "Anak Anda ({$nama} - NIM: {$nim}) terancam CEKAL akademik pada mata kuliah:\n" .
                "• " . implode("\n• ", collect($cekalMatkulList)->map(function ($item) {
                    return "{$item['kode']} - {$item['nama']} (Kehadiran: {$item['presentase']})";
                })->toArray()) . "\n\n" .
                "Persentase kehadiran di bawah " . $batasMinimal . "% dapat menyebabkan:\n" .
                "❌ Tidak dapat mengikuti ujian akhir semester (UAS)\n" .
                "❌ Mengulang mata kuliah di semester berikutnya\n" .
                "❌ Terhambatnya kelulusan\n\n" .
                "💡 SARAN:\n" .
                "• Segera hubungi dosen wali untuk konsultasi\n" .
                "• Pantau terus perkembangan akademik anak Anda";
        } else {
            // ===== PESAN AMAN (SESUAI GAMBAR) =====
            $message = "Tidak ada mata kuliah yang terancam cekal. " .
                "Mahasiswa memiliki kehadiran yang sangat baik dengan persentase kehadiran " . $hadirPercent . "%. " .
                "Batas minimal kehadiran untuk tidak terkena cekal adalah " . $batasMinimal . "%.";

            $pesanOrangTua = "✅ Informasi untuk Orang Tua/Wali:\n\n" .
                "Anak Anda ({$nama} - NIM: {$nim}) memiliki kehadiran yang SANGAT BAIK.\n" .
                "Total kehadiran: " . $hadirPercent . "%\n" .
                "Tidak ada mata kuliah yang terancam cekal.\n\n" .
                "Batas minimal kehadiran untuk tidak terkena cekal adalah " . $batasMinimal . "%.\n" .
                "Pertahankan prestasi ini!";
        }

        $summary = [
            'hadir_percent' => $hadirPercent,
            'tidak_hadir_percent' => $tidakHadirPercent,
            'status' => $hasCekal ? 'Cekal' : 'Tidak Cekal',
            'message' => $message,
            'pesan_orang_tua' => $pesanOrangTua,
            'cekal_matkul' => $cekalMatkulList,
            'semester_aktif' => $semesterAktif,
            'batas_minimal' => $batasMinimal,
        ];

        // ============================================================
        // 🔥 Generate riwayat ketidak hadiran
        // ============================================================
        $riwayatKetidakHadiran = [];

        if (!empty($kehadiranMatkul)) {
            $tanggalMulai = Carbon::now()->subDays(30);
            $keteranganList = ['Sakit', 'Izin', 'Dispensasi', 'Acara Keluarga', 'Kegiatan Kampus', '-'];

            foreach ($kehadiranMatkul as $matkul) {
                // Generate 1-3 ketidak hadiran per mata kuliah
                $jumlahTidakHadir = min($matkul['tidak_hadir'], 3);

                for ($i = 0; $i < $jumlahTidakHadir; $i++) {
                    $tanggal = $tanggalMulai->copy()->addDays(rand(1, 28));
                    $keterangan = $keteranganList[rand(0, count($keteranganList) - 1)];

                    $riwayatKetidakHadiran[] = [
                        'tanggal' => $tanggal->locale('id')->translatedFormat('d M Y'),
                        'mata_kuliah' => $matkul['nama'],
                        'waktu' => rand(7, 15) . ':00 - ' . rand(8, 16) . ':30',
                        'status' => 'Tidak Hadir',
                        'keterangan' => $keterangan,
                    ];
                }
            }

            // Sort by tanggal descending
            usort($riwayatKetidakHadiran, function ($a, $b) {
                return strtotime($b['tanggal']) - strtotime($a['tanggal']);
            });

            // Ambil 10 terbaru
            $riwayatKetidakHadiran = array_slice($riwayatKetidakHadiran, 0, 10);
        }

        return view('mahasiswa.kehadiran.index', compact(
            'mahasiswa',
            'nama',
            'nim',
            'initial',
            'summary',
            'kehadiranMatkul',
            'riwayatKetidakHadiran'
        ));
    }

    public function ukt(KampusApiService $api)
    {
        $session = session('mahasiswa');

        if (!$session) {
            return redirect('/')
                ->with('error', 'Silakan isi data terlebih dahulu');
        }

        $nim = $session['nim'] ?? null;

        if (!$nim) {
            return redirect('/')
                ->with('error', 'NIM tidak ditemukan');
        }

        $nama = $session['nama'] ?? 'Mahasiswa';
        $initial = strtoupper(substr($nama, 0, 1));

        // Ambil seluruh semester
        $allTagihan = Cache::remember(
            "tagihan_semua_$nim",
            now()->addMinutes(30),
            function () use ($api, $nim) {

                $data = [];

                for ($semester = 1; $semester <= 14; $semester++) {

                    $tagihanSemester = $api->getTagihan([
                        'semester' => $semester,
                        'search' => $nim,
                        'size' => 100
                    ]);

                    $items = $tagihanSemester['data']
                        ?? $tagihanSemester
                        ?? [];

                    if (empty($items)) {
                        continue;
                    }

                    foreach ($items as $item) {

                        // hanya nim mahasiswa login
                        if (($item['nim'] ?? null) != $nim) {
                            continue;
                        }

                        // ambil detail tagihan
                        $detail = $api->getTagihanDetail(
                            $item['id']
                        );

                        $data[] = $detail;
                    }
                }

                return $data;
            }
        );

        $mappingJenis = [
            'tuition' => 'SPP',
            'development' => 'DPP',
            'savings' => 'Tabungan',
        ];

        $tagihanFormatted = collect($allTagihan)
            ->sortBy('semester')
            ->map(function ($item) use ($mappingJenis) {

                $details = collect($item['details'] ?? [])
                    ->map(function ($detail) use ($mappingJenis) {

                        $amount = $detail['amount'] ?? 0;
                        $paid = $detail['amount_paid'] ?? 0;

                        return [
                            'jenis' => $mappingJenis[$detail['type']]
                                ?? ucfirst($detail['type']),

                            'total' => $amount,
                            'dibayar' => $paid,
                            'sisa' => $amount - $paid,
                            'lunas' => $paid >= $amount,
                        ];
                    });

                $totalTagihan = $details->sum('total');
                $totalBayar = $details->sum('dibayar');
                $sisa = $totalTagihan - $totalBayar;

                // Tentukan status
                $isLunas = $sisa <= 0;

                $tanggal = '-';
                if (!empty($item['created_at'])) {
                    try {
                        $tanggal = Carbon::parse($item['created_at'])
                            ->locale('id')
                            ->translatedFormat('d F Y');
                    } catch (\Exception $e) {
                        $tanggal = '-';
                    }
                }

                return [
                    'id' => $item['id'],
                    'semester' => $item['semester'] ?? '-',

                    'tanggal' => $tanggal,

                    'status' => $isLunas ? 'Lunas' : 'Belum Lunas',
                    'is_lunas' => $isLunas,

                    'total' => $totalTagihan,
                    'dibayar' => $totalBayar,
                    'sisa' => $sisa,
                    'details' => $details,
                ];
            })
            ->values();

        return view('mahasiswa.spp.index', compact(
            'nama',
            'nim',
            'initial',
            'tagihanFormatted'
        ));
    }

    public function adminIndex(Request $request, KampusApiService $api)
    {
        $size = (int) $request->get('size', 10);
        $page = max((int) $request->get('page', 1), 1);

        $allData = [];
        $cursor = null;

        do {
            $params = ['size' => 1000];
            if ($cursor) $params['cursor'] = $cursor;

            $result = $api->getAllMahasiswa($params);
            $batch = $result['data'] ?? [];

            // Ambil status dari endpoint email
            foreach ($batch as &$item) {
                $email = $item['stimata_email'] ?? null;
                if ($email) {
                    // Pake cache biar ga nge-hit API berkali-kali
                    $cacheKey = "mahasiswa_status_" . md5($email);
                    $status = Cache::remember($cacheKey, now()->addHours(24), function () use ($api, $email) {
                        $detail = $api->getMahasiswaByEmail($email);
                        return $detail['student']['student_status'] ?? '-';
                    });
                    $item['status'] = $status;
                } else {
                    $item['status'] = '-';
                }
            }

            $allData = array_merge($allData, $batch);
            $cursor = $result['meta']['next'] ?? null;
        } while ($cursor && count($batch) > 0);

        $data = $allData;

        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $data = array_values(array_filter(
                $data,
                fn($row) =>
                str_contains(strtolower($row['name']), $search) ||
                    str_contains(strtolower($row['nim']), $search)
            ));
        }

        if ($request->filled('jurusan')) {
            $data = array_values(array_filter($data, function ($row) use ($request) {
                $prodi = strtolower($row['programe'] ?? '');

                return match ($request->jurusan) {
                    'TI' => str_contains($prodi, 'teknologi informasi'),
                    'SI' => str_contains($prodi, 'sistem informasi') && !str_contains($prodi, 'd3'),
                    'D3' => str_contains($prodi, 'd3'),
                    default => true
                };
            }));
        }

        if ($request->filled('tahun')) {
            $data = array_values(array_filter(
                $data,
                fn($row) =>
                date('Y', strtotime($row['entry_date'])) == $request->tahun
            ));
        }

        if ($request->filled('sort_nama')) {
            usort(
                $data,
                fn($a, $b) =>
                $request->sort_nama === 'desc'
                    ? strcmp($b['name'], $a['name'])
                    : strcmp($a['name'], $b['name'])
            );
        }

        $total = count($data);
        $offset = ($page - 1) * $size;
        $data = array_slice($data, $offset, $size);

        $start = $total ? $offset + 1 : 0;
        $end = min($offset + count($data), $total);

        return view('admin.mahasiswa.index', [
            'mahasiswa' => $data,
            'start'     => $start,
            'end'       => $end,
            'total'     => $total,
            'page'      => $page,
            'size'      => $size
        ]);
    }
}
