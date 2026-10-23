<?php

namespace App\Http\Controllers;

use App\Models\TipoAfectacionIgv;
use Illuminate\Http\Request;

class TipoAfectacionIgvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiposAfectacionIgv = TipoAfectacionIgv::all();
        return view('admin.configuracion.tipoafectacionigv.index',compact('tiposAfectacionIgv'));
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
            'codigo' => 'unique:tipo_afectacion_igvs,codigo',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'activo' => 'nullable|boolean',
        ]);

        $tipoAfectacionIgv = new TipoAfectacionIgv();
        $tipoAfectacionIgv->codigo = $request->codigo;
        $tipoAfectacionIgv->nombre = $request->nombre;
        $tipoAfectacionIgv->descripcion = $request->descripcion;
        $tipoAfectacionIgv->activo = $request->boolean('activo');
        $tipoAfectacionIgv->save();

        return redirect()
            ->route('configuracion.tipoafectacionigv')
            ->with('success', 'Tipo de afectación registrado correctamente.');
    }



    /**
     * Display the specified resource.
     */
    public function show(TipoAfectacionIgv $tipoAfectacionIgv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoAfectacionIgv $tipoAfectacionIgv)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'estado' => 'nullable|boolean',
        ]);
        $tipoAfectacionIgv = TipoAfectacionIgv::findOrFail($id);
        $tipoAfectacionIgv->codigo = $request->codigo;
        $tipoAfectacionIgv->nombre = $request->nombre;
        $tipoAfectacionIgv->descripcion = $request->descripcion;
        $tipoAfectacionIgv->activo = $request->boolean('estado');
        $tipoAfectacionIgv->save();
        return redirect()
            ->route('configuracion.tipoafectacionigv')
            ->with('success', 'Tipo de afectación actualizado correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tipoAfectacionIgv = TipoAfectacionIgv::findOrFail($id);
        $tipoAfectacionIgv->delete();
        return redirect()
            ->route('configuracion.tipoafectacionigv')
            ->with('success', 'Tipo de afectación eliminado correctamente.');
    }
}
