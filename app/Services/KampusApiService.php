<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Stimata\Portal\Facades\Stimata;

class KampusApiService
{
    /**
     * =========================
     * GET ACCESS TOKEN
     * =========================
     */
    private function getToken()
    {
        return Cache::remember('stimata_token', now()->addMinutes(50), function () {
            $token = Stimata::getTokenWithClientCredentials('read');

            if (empty($token['access_token'])) {
                throw new \Exception('Gagal mendapatkan access token STIMATA');
            }

            return $token['access_token'];
        });
    }

    /**
     * =========================
     * HTTP REQUEST HELPER
     * =========================
     */
    private function request($endpoint, $params = [])
    {
        $response = Http::withToken($this->getToken())
            ->acceptJson()
            ->timeout(30)
            ->baseUrl('https://portal-api.stimata.ac.id/api/v1')
            ->get($endpoint, $params);

        if ($response->unauthorized()) {
            Cache::forget('stimata_token');
            return null;
        }

        if ($response->failed()) {
            return null;
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
        $res = $this->request("/student/email/$email");
        return $res['data'] ?? null;
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

    public function getTranskrip($nim)
    {
        $res = $this->request("/transcript/$nim/courses");
        return $res['data'] ?? null;
    }

    public function getKrsHistory()
    {
        $res = $this->request("/academic-plan/history");
        return $res['data'] ?? null;
    }

    public function getKrsDetail($nim, $semester)
    {
        $res = $this->request("/academic-plan/$nim/detail/$semester");
        return $res['data'] ?? null;
    }

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
