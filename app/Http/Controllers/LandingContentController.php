<?php

namespace App\Http\Controllers;

use App\Models\LandingContent;
use Illuminate\Http\Request;

class LandingContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
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
    public function show(LandingContent $landingContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LandingContent $landingContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LandingContent $landingContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LandingContent $landingContent)
    {
        //
    }
}
