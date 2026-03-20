<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::latest()->get();
        return view('index', compact('faqs'));
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
            'question' => 'required',
            'answer' => 'required'
        ]);

        if (Faq::count() >= 8) {
            return back()->with('error', 'Maksimal hanya 8 FAQ');
        }

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer
        ]);

        return back()->with('success', 'FAQ berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $faq->update($request->all());

        return back()->with('success', 'FAQ berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return back()->with('success', 'FAQ berhasil dihapus');
    }

    public function admin()
    {
        $faqs = Faq::latest()->get();
        return view('admin.konten.faq.index', compact('faqs'));
    }

    public function deleteAll()
    {
        Faq::truncate();

        return redirect()->back()->with('success', 'Semua data berhasil dihapus!');
    }
}
