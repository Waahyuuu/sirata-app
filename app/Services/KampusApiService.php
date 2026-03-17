<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class KampusApiService
{
    // Base URL
    protected $baseUrl = 'https://siakadz.stimata.ac.id/api/v1';

    // Biodata Mahasiswa Start
    // Get Detail Mahasiswa by NIM
    public function getMahasiswaByNim($nim)
    {
        $response = Http::get($this->baseUrl . "/student/$nim");

        if ($response->successful()) {
            return $response->json()['data'];
        }

        return null;
    }

    // Get Detail Mahasiswa by Email
    public function getMahasiswaByEmail($email)
    {
        $response = Http::get($this->baseUrl . "/student/email/$email");

        if ($response->successful()) {
            return $response->json()['data'];
        }

        return null;
    }

    // Get Daftar Mahasiswa
    public function getAllMahasiswa($params = [])
    {
        $response = Http::get($this->baseUrl . "/student", $params);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
    // Biodata Mahasiswa End

    // ---------------------Pembatas--------------------- //

    // Hasil Studi (Kartu Hasil Studi / KHS) Start
    // Get KHS (Grade Report) per Semester
    public function getKhs($nim, $semester)
    {
        $response = Http::get($this->baseUrl . "/grade-report/$nim", [
            'semester' => $semester
        ]);

        if ($response->successful()) {
            return $response->json()['data'];
        }

        return null;
    }

    // Get Transkrip Nilai
    public function getTranskrip($nim)
    {
        $response = Http::get($this->baseUrl . "/transcript/$nim/courses");

        if ($response->successful()) {
            return $response->json()['data'];
        }

        return null;
    }

    // Get KRS History
    public function getKrsHistory()
    {
        $response = Http::get($this->baseUrl . "/academic-plan/history");

        if ($response->successful()) {
            return $response->json()['data'];
        }

        return null;
    }

    // Get KRS Detail per Semester
    public function getKrsDetail($nim, $semester)
    {
        $response = Http::get($this->baseUrl . "/academic-plan/$nim/detail/$semester");

        if ($response->successful()) {
            return $response->json()['data'];
        }

        return null;
    }
    // Hasil Studi (Kartu Hasil Studi / KHS) End

    // ---------------------Pembatas--------------------- //

    // Indeks Prestasi (IPK / IPS) Start
    // Get Riwayat IP Seluruh Semester
    public function getGpaHistory($nim)
    {
        $response = Http::get($this->baseUrl . "/gpa-history/histories/$nim");

        if ($response->successful()) {
            return $response->json()['data'];
        }

        return null;
    }

    // Get IP per Semester
    public function getIpkSemester($nim, $semester)
    {
        $response = Http::get($this->baseUrl . "/gpa-history/ipk/$nim/$semester");

        if ($response->successful()) {
            return $response->json()['data'];
        }

        return null;
    }
    // Indeks Prestasi (IPK / IPS) End

    // ---------------------Pembatas--------------------- //

    // Jadwal Mata Kuliah Start
    // Get Jadwal Mahasiswa (Personal Schedule)
    public function getJadwalMahasiswa($nim, $day = null)
    {
        $params = ['nim' => $nim];

        if ($day) {
            $params['day'] = $day;
        }

        $response = Http::get($this->baseUrl . "/class/personal-schedule", $params);

        if ($response->successful()) {
            return $response->json()['data'];
        }

        return null;
    }

    // Get Daftar Kelas (Jadwal Lengkap)
    public function getAllClass($params = [])
    {
        $response = Http::get($this->baseUrl . "/class", $params);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    // Get Detail Kelas by ID
    public function getClassDetail($id)
    {
        $response = Http::get($this->baseUrl . "/class/$id");

        if ($response->successful()) {
            return $response->json()['data'];
        }

        return null;
    }
    // Jadwal Mata Kuliah End

    // ---------------------Pembatas--------------------- //

    // Kehadiran (Presensi) Start
    // Get Riwayat Presensi Kelas
    public function getAttendanceHistory($classId)
    {
        $response = Http::get($this->baseUrl . "/attendance/history/$classId");

        if ($response->successful()) {
            return $response->json()['data'];
        }

        return null;
    }

    // Get Detail Presensi per Pertemuan
    public function getAttendanceDetail($classId, $meeting)
    {
        $response = Http::get($this->baseUrl . "/attendance/history/$classId/values/$meeting");

        if ($response->successful()) {
            return $response->json()['data'];
        }

        return null;
    }

    // Get Rekap Presensi Kelas
    public function getAttendanceRecap($classId)
    {
        $response = Http::get($this->baseUrl . "/attendance/recap/$classId");

        if ($response->successful()) {
            return $response->json()['data'][0] ?? null;
        }

        return null;
    }
    // Kehadiran (Presensi) End

    // ---------------------Pembatas--------------------- //

    // SPP / Keuangan (Tagihan)
    // Get Daftar Tagihan
    public function getTagihan($params = [])
    {
        $response = Http::get($this->baseUrl . "/tagihan", $params);

        if ($response->successful()) {
            return $response->json()['data'];
        }

        return null;
    }

    // Get Detail Tagihan by ID
    public function getTagihanDetail($id)
    {
        $response = Http::get($this->baseUrl . "/tagihan/$id");

        if ($response->successful()) {
            return $response->json()['data'];
        }

        return null;
    }

    // Get Status Cekal (Akses Akademik)
    public function getCekal($semester)
    {
        $response = Http::get($this->baseUrl . "/cekal/$semester");

        if ($response->successful()) {
            return $response->json()['data']['data'];
        }

        return null;
    }
    // SPP / Keuangan (Tagihan) End
}
