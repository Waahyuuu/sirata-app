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
    public function transkrip($nim, KampusApiService $api)
    {
        $data = $api->getTranskrip($nim);

        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'Data transkrip tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $data
        ]);
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

    public function getTokenTest(\App\Services\KampusApiService $api)
    {
        // ambil token dari cache (kalau sudah pernah dipanggil)
        $token = Cache::get('stimata_token');

        return response()->json([
            'token' => $token
        ]);
    }
}
