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

    public function dashboard()
    {
        $mahasiswa = session('mahasiswa');

        if (!$mahasiswa) {
            return redirect('/')
                ->with('error', 'Silakan isi data terlebih dahulu');
        }

        $nama = $mahasiswa['nama'] ?? 'Mahasiswa';
        $nim  = $mahasiswa['nim'] ?? '-';

        $initial = strtoupper(substr($nama, 0, 1));

        return view('mahasiswa.dashboard.index', compact(
            'mahasiswa',
            'nama',
            'nim',
            'initial'
        ));
    }

    public function biodata()
    {
        $mahasiswa = session('mahasiswa');

        if (!$mahasiswa) {
            return redirect('/')
                ->with('error', 'Silakan isi data terlebih dahulu');
        }

        return view('mahasiswa.biodata.index', compact('mahasiswa'));
    }

    public function hasilStudi(KampusApiService $api)
    {
        $mahasiswa = session('mahasiswa');

        if (!$mahasiswa) {
            return redirect('/')
                ->with('error', 'Silakan isi data terlebih dahulu');
        }

        $nim = $mahasiswa['nim'] ?? $mahasiswa['data']['nim'] ?? null;

        if (!$nim) {
            return redirect('/')
                ->with('error', 'NIM tidak ditemukan');
        }

        $semesterList = [];
        $totalSks = 0;
        $totalBobot = 0;

        $semester = 1;

        while (true) {

            $khs = $api->getKhs($nim, $semester);

            if (!$khs || empty($khs['items'])) {
                break;
            }

            $sks = $khs['total_credits'] ?? 0;
            $ip  = $khs['semester_gpa'] ?? 0;

            $totalSks += $sks;
            $totalBobot += ($ip * $sks);

            $semesterList[] = [
                'nama'    => 'Semester ' . $semester,
                'periode' => 'Semester ' . $semester,
                'sks'     => $sks,
                'ip'      => $ip,
                'ipk'     => $totalSks ? ($totalBobot / $totalSks) : 0,
            ];

            $semester++;

            // 🔒 safety biar gak infinite loop
            if ($semester > 14) break;
        }

        $ipk = $totalSks ? ($totalBobot / $totalSks) : 0;

        $khs = [
            'ipk' => $ipk,
            'total_sks' => $totalSks,
            'semester' => $semesterList
        ];

        return view('mahasiswa.hasilstudi.index', compact('mahasiswa', 'khs'));
    }
    public function salinanNilai()
    {
        $mahasiswa = session('mahasiswa');

        if (!$mahasiswa) {
            return redirect('/')
                ->with('error', 'Silakan isi data terlebih dahulu');
        }

        // DATA STATIK
        $transkrip = [
            'nama' => 'Nama Mahasiswa',
            'nim' => '16237163',
            'prodi' => 'Sistem Informasi',
            'angkatan' => '2022',
            'ttl' => 'Malang, 01 Januari 2000',

            'matkul' => array_fill(0, 20, [
                'kode' => 'MBB0-3101',
                'nama' => 'Perilaku Dalam Berorganisasi',
                'sks' => 2,
                'nilai' => 'A'
            ]),

            'total_sks_tempuh' => 80,
            'total_sks_lulus' => 80,
            'ipk' => 4.00
        ];

        return view('mahasiswa.salinannilai.index', compact('mahasiswa', 'transkrip'));
    }

    public function jadwal()
    {
        $mahasiswa = session('mahasiswa');

        if (!$mahasiswa) {
            return redirect('/')
                ->with('error', 'Silakan isi data terlebih dahulu');
        }

        // DATA STATIK JADWAL
        $jadwal = [
            'Senin' => [
                ['nama' => 'Pemrograman Web', 'jam' => '08:00 - 10:00'],
                ['nama' => 'Basis Data', 'jam' => '10:00 - 12:00'],
                ['nama' => 'Jaringan Komputer', 'jam' => '13:00 - 15:00'],
            ],
            'Selasa' => [
                ['nama' => 'Sistem Operasi', 'jam' => '08:00 - 10:00'],
                ['nama' => 'UI/UX Design', 'jam' => '10:00 - 12:00'],
                ['nama' => 'Algoritma', 'jam' => '13:00 - 15:00'],
            ],
            'Rabu' => [
                ['nama' => 'Pemrograman Mobile', 'jam' => '08:00 - 10:00'],
                ['nama' => 'Data Mining', 'jam' => '10:00 - 12:00'],
                ['nama' => 'Manajemen Proyek', 'jam' => '13:00 - 15:00'],
            ],
            'Kamis' => [
                ['nama' => 'Keamanan Sistem', 'jam' => '08:00 - 10:00'],
                ['nama' => 'Cloud Computing', 'jam' => '10:00 - 12:00'],
                ['nama' => 'Big Data', 'jam' => '13:00 - 15:00'],
            ],
            'Jumat' => [
                ['nama' => 'Etika Profesi', 'jam' => '08:00 - 10:00'],
                ['nama' => 'Kecerdasan Buatan', 'jam' => '10:00 - 12:00'],
                ['nama' => 'Statistika', 'jam' => '13:00 - 15:00'],
            ],
        ];

        // Jadwal hari ini (contoh ambil Rabu)
        $jadwalHariIni = $jadwal['Rabu'];

        return view('mahasiswa.jadwal.index', compact('mahasiswa', 'jadwal', 'jadwalHariIni'));
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
