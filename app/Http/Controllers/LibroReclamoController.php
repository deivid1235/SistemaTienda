<?php

namespace App\Http\Controllers;

use App\Models\LibroReclamo;
use Illuminate\Http\Request;

class LibroReclamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('public.libro_reclamacion');       
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
    public function show(LibroReclamo $libroReclamo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LibroReclamo $libroReclamo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LibroReclamo $libroReclamo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LibroReclamo $libroReclamo)
    {
        //
    }
}
