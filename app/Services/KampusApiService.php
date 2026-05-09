<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Stimata\Portal\Facades\Stimata;

class KampusApiService
{
    private function baseUrl()
    {
        return config('services.stimata.base_url');
    }

    /**
     * =========================
     * GET ACCESS TOKEN
     * =========================
     */
    private function getToken()
    {
        return Cache::remember('stimata_token', now()->addSeconds(3500), function () {

            $scope = implode(' ', [
                'student:read',
                'penilaian:khs-read',
                'transkrip:get',
                'krs:read',
                'kelas:read',
                'presensi:get',
                'presensi:get-rekap',
                'tagihan:read',
                'cekal:read'
            ]);

            try {
                $token = Stimata::getTokenWithClientCredentials($scope);

                if (!isset($token['access_token'])) {
                    throw new \Exception('Token tidak valid dari STIMATA');
                }

                return $token['access_token'];
            } catch (\Throwable $e) {
                Cache::forget('stimata_token');
                throw new \Exception('Gagal ambil token: ' . $e->getMessage());
            }
        });
    }

    /**
     * =========================
     * REQUEST FUNC
     * =========================
     */
    private function request($endpoint, $params = [])
    {
        $token = $this->getToken();

        $response = Http::withToken($token)
            ->acceptJson()
            ->timeout(30)
            ->baseUrl($this->baseUrl())
            ->get($endpoint, $params);

        if ($response->unauthorized()) {
            Cache::forget('stimata_token');

            $newToken = $this->getToken();
            $response = Http::withToken($newToken)
                ->acceptJson()
                ->timeout(30)
                ->baseUrl($this->baseUrl())
                ->get($endpoint, $params);
        }

        if ($response->failed()) {
            return [
                'error' => true,
                'message' => $response->body()
            ];
        }

        return $response->json();
    }

    // =====================================================
    // BIODATA MAHASISWA
    // =====================================================

    public function getMahasiswaByNim($nim)
    {
        $res = $this->request("/student/$nim");
        return $res['data'] ?? null;
    }

    public function getMahasiswaByEmail($email)
    {
        $email = trim($email);

        $res = $this->request("/student/email/$email");

        if (!$res || empty($res['data'])) {
            return null;
        }

        return $res['data'];
    }

    public function getAllMahasiswa($params = [])
    {
        $params = array_merge([
            'size' => 10
        ], $params);

        $res = $this->request('/student', $params);

        return [
            'data'    => $res['data'] ?? [],
            'meta'    => $res['meta'] ?? [],
            'message' => $res['message'] ?? null,
            'code'    => $res['code'] ?? 500
        ];
    }

    // =====================================================
    // KHS / NILAI
    // =====================================================

    public function getKhs($nim, $semester)
    {
        $res = $this->request("/grade-report/$nim", [
            'semester' => $semester
        ]);

        return $res['data'] ?? null;
    }

    public function getTranskrip($nim, $final = false)
    {
        $res = $this->request("/transcript/$nim/courses", [
            'final' => $final ? 'true' : 'false'
        ]);

        return $res;
    }

    public function getKrsHistory($params = [])
    {
        $res = $this->request("/academic-plan/history", $params);
        return $res['data'] ?? null;
    }

    // public function getKrsDetail($nim, $semester)
    // {
    //     $res = $this->request("/academic-plan/$nim/detail/$semester");
    //     return $res['data'] ?? null;
    // }

    // =====================================================
    // IPK / IPS
    // =====================================================

    public function getGpaHistory($nim)
    {
        $res = $this->request("/gpa-history/histories/$nim");
        return $res['data'] ?? null;
    }

    public function getIpkSemester($nim, $semester)
    {
        $res = $this->request("/gpa-history/ipk/$nim/$semester");
        return $res['data'] ?? null;
    }

    // =====================================================
    // JADWAL
    // =====================================================

    public function getJadwalMahasiswa($nim, $day = null)
    {
        $params = ['nim' => $nim];

        if ($day) {
            $params['day'] = $day;
        }

        $res = $this->request("/class/personal-schedule", $params);
        return $res['data'] ?? null;
    }

    public function getKrsDetail($nim, $semester)
    {
        // Pastikan path-nya sesuai dokumentasi: /academic-plan/{nim}/detail/{semester}
        $res = $this->request("/academic-plan/$nim/detail/$semester");
        return $res['data'] ?? null;
    }

    public function getAllClass($params = [])
    {
        return $this->request("/class", $params);
    }

    public function getClassDetail($id)
    {
        $res = $this->request("/class/$id");
        return $res['data'] ?? null;
    }

    // =====================================================
    // PRESENSI
    // =====================================================

    public function getAttendanceHistory($classId)
    {
        $res = $this->request("/attendance/history/$classId");
        return $res['data'] ?? null;
    }

    public function getAttendanceDetail($classId, $meeting)
    {
        $res = $this->request("/attendance/history/$classId/values/$meeting");
        return $res['data'] ?? null;
    }

    public function getAttendanceRecap($classId)
    {
        $res = $this->request("/attendance/recap/$classId");
        return $res['data'][0] ?? null;
    }

    // =====================================================
    // KEUANGAN
    // =====================================================

    public function getTagihan($params = [])
    {
        $res = $this->request("/tagihan", $params);
        return $res['data'] ?? null;
    }

    public function getTagihanDetail($id)
    {
        $res = $this->request("/tagihan/$id");
        return $res['data'] ?? null;
    }

    public function getCekal($semester)
    {
        $res = $this->request("/cekal/$semester");
        return $res['data']['data'] ?? null;
    }
}
