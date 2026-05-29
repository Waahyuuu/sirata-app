<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KampusApiService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

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

            for ($semester = 1; $semester <= 14; $semester++) {

                $krsData = $api->getKrsDetail($nim, $semester);
                $khsData = $api->getKhs($nim, $semester);

                if (!$krsData || empty($krsData)) {
                    continue;
                }

                $semesterAktif = $semester;
                $mataKuliahSemesterIni = $krsData;

                $sksDiambilSemester = collect($krsData)
                    ->sum(fn($item) => $item['course']['credits'] ?? 0);

                $totalSksDiambil += $sksDiambilSemester;
                $ipSemester = $khsData['semester_gpa'] ?? 0;
                $sksLulusSemester = $khsData['total_credits'] ?? 0;

                if ($sksLulusSemester > 0) {

                    $totalSksLulus += $sksLulusSemester;

                    $totalBobotKumulatif += (
                        $ipSemester * $sksLulusSemester
                    );

                    $ipkSaatIni = $totalSksLulus > 0
                        ? ($totalBobotKumulatif / $totalSksLulus)
                        : 0;

                    $semesterList[] = [
                        'semester' => $semester,
                        'ip' => round($ipSemester, 2),
                        'ipk' => round($ipkSaatIni, 2),
                        'sks' => $sksLulusSemester,
                        'krs' => $krsData,
                        'khs' => $khsData,
                    ];
                }
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

    public function cari(Request $request, KampusApiService $api)
    {
        $request->validate([
            'nim'           => 'required|string',
            'nama_ibu'      => 'required|string|min:3',
            'tanggal_lahir' => 'required|date',
        ]);
        $mahasiswaByNim = $api->getMahasiswaByNim($request->nim);

        if (!$mahasiswaByNim || empty($mahasiswaByNim['stimata_email'])) {
            return redirect('/#sirata')->with('error', 'Data mahasiswa tidak ditemukan');
        }

        $email = $mahasiswaByNim['stimata_email'];
        $mahasiswa = $api->getMahasiswaByEmail($email);

        if (!$mahasiswa) {
            return redirect('/#sirata')->with('error', 'Data detail mahasiswa tidak ditemukan');
        }

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

        $mahasiswaSession = [
            'nama' => $nama,
            'nim'  => $nim,
        ];

        session([
            'mahasiswa' => $mahasiswaSession
        ]);

        return redirect('/mahasiswa/dashboard')
            ->with('success', 'Berhasil masuk dashboard');
    }

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
            now()->addMinutes(10),
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

        $khs = Cache::remember("hasil_studi_$nim", 300, function () use ($api, $nim) {

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

        // Ambil data transkrip dari API
        // true = final transcript
        $response = $api->getTranskrip($nim, true);

        if (!$response) {
            return redirect('/')
                ->with('error', 'Data transkrip tidak ditemukan');
        }

        /**
         * Support 2 kemungkinan response:
         *
         * 1. Full response API
         * [
         *   'code' => 200,
         *   'data' => [...]
         * ]
         *
         * 2. Langsung isi data
         * [
         *   'nim' => ...
         * ]
         */
        $data = $response['data'] ?? $response;

        // Validasi minimal data
        if (empty($data) || empty($data['nim'])) {
            return redirect('/')
                ->with('error', 'Data transkrip tidak valid');
        }

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

            // contoh:
            // 24520006 => 2024
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

        // Hitung total SKS tempuh
        $totalSksTempuh = collect($data['courses'] ?? [])
            ->sum(function ($item) {
                return $item['credits'] ?? 0;
            });

        // Hitung total SKS lulus
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

        // Gunakan summary jika tersedia & valid
        if (
            isset($data['summary']['gpa']) &&
            $data['summary']['gpa'] > 0
        ) {
            $ipk = $data['summary']['gpa'];
        }

        if (
            isset($data['summary']['total_credits']) &&
            $data['summary']['total_credits'] > 0
        ) {
            $totalSksTempuh = $data['summary']['total_credits'];
        }

        if (
            isset($data['summary']['passed_credits']) &&
            $data['summary']['passed_credits'] > 0
        ) {
            $totalSksLulus = $data['summary']['passed_credits'];
        }

        // Final data untuk view
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

        return view('mahasiswa.salinannilai.index', compact(
            'mahasiswa',
            'transkrip',
            'nama',
            'nim',
            'initial'
        ));
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
            now()->addMinutes(10),
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

                $jadwal[$day][] = [
                    'nama' => $item['course']['course_name']
                        ?? $item['course_name']
                        ?? '-',

                    'jam' => ($item['start_time'] ?? '--:--')
                        . ' - ' .
                        ($item['end_time'] ?? '--:--'),

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

        // SUMMARY KEHADIRAN
        $summary = [
            'hadir_percent' => 98,
            'tidak_hadir_percent' => 2,
            'status' => 'Aman',
            'message' => 'Tidak ada mata kuliah yang terancam cekal. Mahasiswa memiliki kehadiran yang sangat baik dengan persentase kehadiran 94.5%. Batas minimal kehadiran untuk tidak terkena cecal adalah 75%.'
        ];

        // KEHADIRAN PER MATA KULIAH
        $kehadiranMatkul = [
            [
                'kode' => 'TIF401',
                'nama' => 'Pemrograman Web',
                'hadir' => 12,
                'tidak_hadir' => 2,
                'presentase' => '98%'
            ],
            [
                'kode' => 'TIF402',
                'nama' => 'Basis Data',
                'hadir' => 14,
                'tidak_hadir' => 1,
                'presentase' => '93%'
            ],
            [
                'kode' => 'TIF403',
                'nama' => 'Jaringan Komputer',
                'hadir' => 13,
                'tidak_hadir' => 1,
                'presentase' => '92%'
            ],
            [
                'kode' => 'TIF404',
                'nama' => 'Sistem Operasi',
                'hadir' => 10,
                'tidak_hadir' => 3,
                'presentase' => '77%'
            ],
            [
                'kode' => 'TIF405',
                'nama' => 'Kecerdasan Buatan',
                'hadir' => 15,
                'tidak_hadir' => 0,
                'presentase' => '100%'
            ],
        ];

        // RIWAYAT KEHADIRAN TERBARU
        $riwayatKehadiran = [
            [
                'tanggal' => '17 Des 2024',
                'mata_kuliah' => 'Kecerdasan Buatan',
                'waktu' => '13:00 - 15:30',
                'status' => 'Hadir',
                'keterangan' => '-'
            ],
            [
                'tanggal' => '16 Des 2024',
                'mata_kuliah' => 'Pemrograman Web',
                'waktu' => '08:00 - 10:00',
                'status' => 'Hadir',
                'keterangan' => '-'
            ],
            [
                'tanggal' => '15 Des 2024',
                'mata_kuliah' => 'Basis Data',
                'waktu' => '10:00 - 12:00',
                'status' => 'Tidak Hadir',
                'keterangan' => 'Sakit'
            ],
            [
                'tanggal' => '14 Des 2024',
                'mata_kuliah' => 'Jaringan Komputer',
                'waktu' => '13:00 - 15:00',
                'status' => 'Hadir',
                'keterangan' => '-'
            ],
            [
                'tanggal' => '13 Des 2024',
                'mata_kuliah' => 'Sistem Operasi',
                'waktu' => '08:00 - 10:00',
                'status' => 'Hadir',
                'keterangan' => '-'
            ],
        ];

        return view('mahasiswa.kehadiran.index', compact(
            'mahasiswa',
            'nama',
            'nim',
            'initial',
            'summary',
            'kehadiranMatkul',
            'riwayatKehadiran'
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
        now()->addMinutes(10),
        function () use ($api, $nim) {

            $data = [];

            for ($semester = 1; $semester <= 14; $semester++) {

                $tagihanSemester = $api->getTagihan([
                    'semester' => $semester,
                    'search' => $nim,
                    'size' => 100
                ]);

                // Support response pagination/data
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

            return [
                'id' => $item['id'],
                'semester' => $item['semester'] ?? '-',

                'tanggal' => !empty($item['created_at'])
                    ? Carbon::parse($item['created_at'])
                        ->translatedFormat('d F Y')
                    : '-',

                'status' => $sisa <= 0
                    ? 'Lunas'
                    : 'Belum Lunas',

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
