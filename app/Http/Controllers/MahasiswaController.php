<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KampusApiService;
use Carbon\Carbon;

class MahasiswaController extends Controller
{
    /**
     * =====================================================
     * LOGIN PAGE
     * =====================================================
     */
    public function index()
    {
        return view('mahasiswa.biodata');
    }

    /**
     * =====================================================
     * VALIDASI MAHASISWA
     * =====================================================
     */
    public function cari(Request $request, KampusApiService $api)
    {
        $request->validate([
            'nim'           => 'required|string',
            'nama_ibu'      => 'required|string|min:3',
            'tanggal_lahir' => 'required|date',
        ]);

        $mahasiswa = $api->getMahasiswaByNim($request->nim);

        if (!$mahasiswa) {
            return back()->with('error', 'Data mahasiswa tidak ditemukan');
        }

        try {
            $tglApi   = Carbon::parse($mahasiswa['birth_date'])->format('Y-m-d');
            $tglInput = Carbon::parse($request->tanggal_lahir)->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->with('error', 'Tanggal tidak valid');
        }

        if (
            strtolower(trim($mahasiswa['mother_name'])) !== strtolower(trim($request->nama_ibu))
            || $tglApi !== $tglInput
        ) {
            return back()->with('error', 'Data tidak cocok');
        }

        $khs    = $api->getKhs($mahasiswa['nim'], '2024');
        $jadwal = $api->getJadwalMahasiswa($mahasiswa['nim']);

        return view('mahasiswa.biodata', compact(
            'mahasiswa',
            'khs',
            'jadwal'
        ))->with('success', 'Data berhasil ditemukan');
    }

    /**
     * =====================================================
     * DASHBOARD
     * =====================================================
     */
    public function dashboard()
    {
        $mahasiswa = session('mahasiswa');

        if (!$mahasiswa) {
            return redirect()
                ->route('mahasiswa.index')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        return view('mahasiswa.dashboard', compact('mahasiswa'));
    }

    /**
     * =====================================================
     * ADMIN LIST MAHASISWA
     * =====================================================
     */
    public function adminIndex(Request $request, KampusApiService $api)
    {
        $size = (int) $request->get('size', 10);
        $page = max((int) $request->get('page', 1), 1);

        /**
         * ============================
         * AMBIL SEMUA DATA (WAJIB)
         * ============================
         */
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

        /**
         * ============================
         * FILTER
         * ============================
         */
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

        /**
         * ============================
         * PAGINATION MANUAL
         * ============================
         */
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
