<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::latest()->get();
        return view('index', compact('links'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'url'  => 'required|url|unique:links,url',
        ], [
            'url.unique'  => 'URL sudah terdaftar',
        ]);

        Link::create([
            'name' => $request->name,
            'url'  => $request->url
        ]);

        return redirect()->route('admin.konten', ['tab' => 'link'])
            ->with('success', 'Link berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Link $link)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url'  => 'required|url|unique:links,url,' . $link->id,
        ]);

        $link->update($request->only('name', 'url'));

        return redirect()->route('admin.konten', ['tab' => 'link'])
            ->with('success', 'Link berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Link::findOrFail($id)->delete();

        return redirect()->route('admin.konten', ['tab' => 'link'])
            ->with('success', 'Link berhasil dihapus');
    }

    public function deleteAll()
    {
        Link::truncate();

        return redirect()->route('admin.konten', ['tab' => 'link'])
            ->with('success', 'Semua data Link berhasil dihapus!');
    }
}
