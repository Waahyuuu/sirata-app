<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\KampusApiService;
use Carbon\Carbon;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cari(Request $request, KampusApiService $api)
    {
        $request->validate([
            'nim' => 'required',
            'nama_ibu' => 'required',
            'tanggal_lahir' => 'required'
        ]);

        $mahasiswa = $api->getMahasiswaByNim($request->nim);

        if (!$mahasiswa) {
            return back()->with('error', 'Data tidak ditemukan');
        }

        if (!isset($mahasiswa['mother_name'], $mahasiswa['birth_date'])) {
            return back()->with('error', 'Data mahasiswa tidak lengkap');
        }

        try {
            $tglApi = Carbon::parse($mahasiswa['birth_date'])->format('Y-m-d');

            $tglInput = Carbon::createFromFormat('d/m/Y', $request->tanggal_lahir)
                ->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->with('error', 'Format tanggal tidak valid');
        }

        // Validasi Kecocokan Data
        if (
            strtolower(trim($mahasiswa['mother_name'])) !== strtolower(trim($request->nama_ibu)) ||
            $tglApi !== $tglInput
        ) {
            return back()->with('error', 'Data tidak cocok');
        }

        session(['mahasiswa' => $mahasiswa]);

        return redirect('/mahasiswa/dashboard');
    }
}
