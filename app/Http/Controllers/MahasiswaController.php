<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KampusApiService;
use Carbon\Carbon;

class MahasiswaController extends Controller
{
    /**
     * =========================
     * HALAMAN LOGIN / INDEX
     * =========================
     */
    public function index()
    {
        return view('mahasiswa.biodata');
    }

    /**
     * =========================
     * VALIDASI MAHASISWA
     * =========================
     */
    public function cari(Request $request, KampusApiService $api)
    {
        $request->validate([
            'nim' => 'required|string',
            'nama_ibu' => 'required|string|min:3',
            'tanggal_lahir' => 'required|date',
        ]);

        $mahasiswa = $api->getMahasiswaByNim($request->nim);

        if (!$mahasiswa) {
            return back()->with('error', 'Data mahasiswa tidak ditemukan');
        }

        if (empty($mahasiswa['mother_name']) || empty($mahasiswa['birth_date'])) {
            return back()->with('error', 'Data mahasiswa tidak lengkap');
        }

        try {
            $tglApi = Carbon::parse($mahasiswa['birth_date'])->format('Y-m-d');
            $tglInput = Carbon::parse($request->tanggal_lahir)->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->with('error', 'Format tanggal tidak valid');
        }

        if (
            strtolower(trim($mahasiswa['mother_name'])) !== strtolower(trim($request->nama_ibu)) ||
            $tglApi !== $tglInput
        ) {
            return back()->with('error', 'Data tidak cocok');
        }

        // 🔥 ambil data tambahan dari API
        $khs = $api->getKhs($mahasiswa['nim'], '2024');
        $jadwal = $api->getJadwalMahasiswa($mahasiswa['nim']);

        return view('mahasiswa.biodata', [
            'mahasiswa' => $mahasiswa,
            'khs' => $khs,
            'jadwal' => $jadwal
        ])->with([
            'success' => 'Data berhasil ditemukan'
        ]);
    }

    /**
     * =========================
     * DASHBOARD MAHASISWA
     * =========================
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

    public function webJsonMahasiswa(KampusApiService $api)
    {
        $data = $api->getAllMahasiswa([
            'size' => 100,
            'page' => 1
        ]);

        return response()->json($data);
    }
}
