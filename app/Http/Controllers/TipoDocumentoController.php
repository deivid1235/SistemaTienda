<?php

namespace App\Http\Controllers;

use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoDocumentos = TipoDocumento::all();
        return view('admin.configuracion.tipodocumento.index', compact('tipoDocumentos'));
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
            'codigo' => 'required|string|max:10|unique:tipo_documentos,codigo',
            'nombre' => 'required|string|max:150',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->codigo = $request->codigo;
        $tipoDocumento->nombre = $request->nombre;
        $tipoDocumento->estado = $request->estado;
        $tipoDocumento->save();

        return redirect()
            ->route('configuracion.tipodocumento')
            ->with('success', 'Tipo de documento registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoDocumento $tipoDocumento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoDocumento $tipoDocumento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  string $id)
    {
        $request->validate([
            'codigo' => 'required|string|max:10|unique:tipo_documentos,codigo,' . $id,
            'nombre' => 'required|string|max:150',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);

        $tipoDocumento = TipoDocumento::findOrFail($id);

        $tipoDocumento->codigo = $request->codigo;
        $tipoDocumento->nombre = $request->nombre;
        $tipoDocumento->estado = $request->estado;
        $tipoDocumento->save();

        return redirect()
            ->route('configuracion.tipodocumento')
            ->with('success', 'Tipo de documento actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( string $id)
    {
        $tipoDocumento = TipoDocumento::findOrFail($id);
        $tipoDocumento->delete();
        return redirect()
            ->route('configuracion.tipodocumento')
            ->with('success', 'Tipo de documento eliminado correctamente.');
    }
}
