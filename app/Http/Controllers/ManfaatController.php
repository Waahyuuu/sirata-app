<?php

namespace App\Http\Controllers;

use App\Models\Manfaat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManfaatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $maxIconSizeKB = 2048;
    public function index()
    {
        $manfaats = Manfaat::latest()
            ->take(6)
            ->get();

        return view('index', [
            'manfaats' => $manfaats,
            'maxIconSizeKB' =>
            $this->maxIconSizeKB
        ]);
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
        if (Manfaat::count() >= 6) {
            return redirect()->route('admin.konten', ['tab' => 'manfaat'])
                ->withErrors([
                    'limit' => 'Maksimal hanya 6 manfaat yang dapat ditambahkan'
                ]);
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'icon_file' => 'nullable|mimes:png,jpg,jpeg,svg|max:' . $this->maxIconSizeKB,
            'icon_svg' => 'nullable|string'
        ]);

        $icon = null;

        if ($request->hasFile('icon_file')) {
            $icon = $request->file('icon_file')
                ->store('manfaat', 'public');
        } elseif ($request->icon_svg) {
            $icon = $request->icon_svg;
        }

        if (!$icon) {
            return back()->withErrors([
                'icon' => 'Icon wajib diisi'
            ]);
        }

        Manfaat::create([
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $icon
        ]);

        return redirect()->route(
            'admin.konten',
            ['tab' => 'manfaat']
        )->with(
            'success',
            'Manfaat berhasil ditambahkan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Manfaat $manfaat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manfaat $manfaat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        Manfaat $manfaat
    ) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'icon_file' => 'nullable|mimes:png,jpg,jpeg,svg|max:' . $this->maxIconSizeKB,
            'icon_svg' => 'nullable|string'
        ]);

        $icon = $manfaat->icon;

        if ($request->hasFile('icon_file')) {

            if (
                $manfaat->icon &&
                !str_contains(
                    $manfaat->icon,
                    '<svg'
                )
            ) {
                if (
                    Storage::disk('public')
                    ->exists($manfaat->icon)
                ) {
                    Storage::disk('public')
                        ->delete($manfaat->icon);
                }
            }

            $icon = $request->file('icon_file')
                ->store('manfaat', 'public');
        } elseif ($request->icon_svg) {
            $icon = $request->icon_svg;
        }

        $manfaat->update([
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $icon
        ]);

        return redirect()->route(
            'admin.konten',
            ['tab' => 'manfaat']
        )->with(
            'success',
            'Manfaat berhasil diubah'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manfaat $manfaat)
    {
        if ($manfaat->icon && !str_contains($manfaat->icon, '<svg')) {

            if (Storage::disk('public')->exists($manfaat->icon)) {
                Storage::disk('public')->delete($manfaat->icon);
            }
        }

        $manfaat->delete();

        return redirect()->route('admin.konten', ['tab' => 'manfaat'])
            ->with('success', 'Manfaat berhasil dihapus');
    }

    public function deleteAll()
    {
        $manfaats = Manfaat::all();

        foreach ($manfaats as $manfaat) {

            if ($manfaat->icon && !str_contains($manfaat->icon, '<svg')) {

                if (Storage::disk('public')->exists($manfaat->icon)) {
                    Storage::disk('public')->delete($manfaat->icon);
                }
            }
        }

        Manfaat::truncate();

        return redirect()->route('admin.konten', ['tab' => 'manfaat'])
            ->with('success', 'Semua data Manfaat berhasil dihapus!');
    }
}
