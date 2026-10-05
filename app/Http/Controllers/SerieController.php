<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SerieController extends Controller
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
        $request->validate([
            'tipo_documento_id' => 'required|exists:tipo_documentos,id',
            'sucursal_id' => 'required|exists:sucursals,id',
            'serie' => 'required|string|max:10',
            'contingencia' => 'required|in:SI,NO',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);

        $serie = new Serie();
        $serie->tipo_documento_id = $request->tipo_documento_id;
        $serie->sucursal_id = $request->sucursal_id;
        $serie->serie = $request->serie;
        $serie->contingencia = $request->contingencia;
        $serie->estado = $request->estado;
        $serie->save();

        return redirect()
            ->route('sucursal')
            ->with('success', 'Serie registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Serie $serie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Serie $serie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tipo_documento_id' => 'required|exists:tipo_documentos,id',
            'sucursal_id' => 'required|exists:sucursals,id',
            'serie' => 'required|string|max:10',
            'contingencia' => 'required|in:SI,NO',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);

        $serie = Serie::findOrFail($id);

        $serie->tipo_documento_id = $request->tipo_documento_id;
        $serie->sucursal_id = $request->sucursal_id;
        $serie->serie = $request->serie;
        $serie->contingencia = $request->contingencia;
        $serie->estado = $request->estado;

        $serie->save();
        return redirect()
            ->route('sucursal')
            ->with('success', 'Serie actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( string $id)
    {
        $serie = Serie::findOrFail($id);
        $serie->delete();
        return redirect()
            ->route('sucursal')
            ->with('success', 'Serie eliminada correctamente.');
    }
}
