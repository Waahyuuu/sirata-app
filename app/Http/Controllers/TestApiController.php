<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KampusApiService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class TestApiController extends Controller
{
    public function webJsonMahasiswa(KampusApiService $api)
    {
        $data = $api->getAllMahasiswa([
            'size' => 100,
            'page' => 1
        ]);

        return response()->json($data);
    }

    public function showByEmail($email, KampusApiService $api)
    {
        $email = urldecode($email);

        $data = $api->getMahasiswaByEmail($email);

        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'Mahasiswa tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $data
        ]);
    }

    public function show($nim, KampusApiService $api)
    {
        $data = $api->getMahasiswaByNim($nim);

        if (!$data) {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Mahasiswa tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'data' => $data
        ]);
    }

    // KHS
    public function khs($nim, $semester, KampusApiService $api)
    {
        $data = $api->getKhs($nim, $semester);

        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'Data KHS tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $data
        ]);
    }

    // Transkrip

    public function transkrip(Request $request, $nim, KampusApiService $api)
    {
        $final = $request->query('final', false);
        $data = $api->getTranskrip($nim, $final);

        // Cek apakah ada error dari HTTP request (seperti timeout atau 500)
        if (isset($data['error'])) {
            return response()->json([
                'message' => 'API Error: ' . $data['message'],
                'raw_res' => $data
            ], 500);
        }

        // Jika data null tapi tidak error, berarti NIM tersebut memang belum punya transkrip
        if (!$data || empty($data['data'])) {
            return response()->json([
                'code' => 404,
                'message' => 'Data transkrip tidak ditemukan untuk NIM ' . $nim,
                'note' => 'Mahasiswa angkatan baru mungkin belum memiliki data di modul transkrip.'
            ], 404);
        }

        return response()->json($data);
    }

    // KRS History
    public function krsHistory(KampusApiService $api)
    {
        $data = $api->getKrsHistory();

        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'Data KRS history tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $data
        ]);
    }

    // KRS Detail
    public function krsDetail($nim, $semester, KampusApiService $api)
    {
        $data = $api->getKrsDetail($nim, $semester);

        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'Data KRS detail tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $data
        ]);
    }

    public function getTokenTest()
    {
        return response()->json([
            'token' => Cache::get('stimata_token'),
            'exists' => Cache::has('stimata_token')
        ]);
    }

    public function gpaHistory($nim, KampusApiService $api)
    {
        return response()->json(
            $api->getGpaHistory($nim)
        );
    }

    // =====================================================
    // JADWAL (Tambahan Baru)
    // =====================================================

    /**
     * Get Jadwal Pribadi Mahasiswa
     */
    public function jadwalMahasiswa(Request $request, $nim, KampusApiService $api)
    {
        // 1. Ambil parameter 'day' dari query string jika ada (misal: ?day=Monday)
        $day = $request->query('day');

        // 2. Panggil service
        $data = $api->getJadwalMahasiswa($nim, $day);

        // 3. Cek Error dari Request (Timeout/Connection)
        if (isset($data['error'])) {
            return response()->json([
                'code' => 500,
                'message' => 'Gagal mengambil data dari server pusat',
                'error' => $data['message']
            ], 500);
        }

        // 4. Jika data kosong (Mahasiswa mungkin belum ambil KRS)
        if (!$data || empty($data)) {
            return response()->json([
                'code' => 404,
                'message' => 'Jadwal tidak ditemukan. Pastikan mahasiswa sudah mengisi KRS.',
                'data' => []
            ], 404);
        }

        // 5. Sukses
        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'nim' => $nim,
            'filter_day' => $day ?? 'All Days',
            'data' => $data
        ]);
    }

    /**
     * Get Semua Daftar Kelas (Jadwal Lengkap Kampus)
     */
    public function allClass(Request $request, KampusApiService $api)
    {
        $params = $request->all();
        $params['size'] = 100;

        $data = $api->getAllClass($params);
        return response()->json($data);
    }

    public function krsAktif(Request $request, $nim, KampusApiService $api)
    {
        // Ambil semester dari query string, jika tidak ada default ke 20251
        // Contoh akses: /mahasiswa/24510003/krs-aktif?sem=20251
        $semester = $request->query('sem', '20251');

        $data = $api->getKrsDetail($nim, $semester);

        if (!$data || empty($data)) {
            return response()->json([
                'code' => 404,
                'message' => "KRS Semester $semester tidak ditemukan untuk NIM $nim",
                'data' => null
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'semester' => $semester,
            'data' => $data
        ]);
    }

    /**
     * Get Detail Kelas Tertentu
     */
    public function classDetail($id, KampusApiService $api)
    {
        $data = $api->getClassDetail($id);

        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'Detail kelas tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $data
        ]);
    }
}
