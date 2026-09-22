<?php

namespace App\Http\Controllers;

use App\Models\ComprobanteGasto;
use Illuminate\Http\Request;

class ComprobanteGastoController extends Controller
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
            'descripcion' => 'required|string|max:150',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);
        $comprobanteGasto = new ComprobanteGasto();
        $comprobanteGasto->descripcion = $request->descripcion;
        $comprobanteGasto->estado = $request->estado;
        $comprobanteGasto->save();
        return redirect()
            ->route('configuracion.tipocomprobante')
            ->with('success', 'Tipo de comprobante de gasto registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ComprobanteGasto $comprobanteGasto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComprobanteGasto $comprobanteGasto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:150',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);

        $comprobanteGasto = ComprobanteGasto::findOrFail($id);
        $comprobanteGasto->descripcion = $request->descripcion;
        $comprobanteGasto->estado = $request->estado;
        $comprobanteGasto->save();
        return redirect()
            ->route('configuracion.tipocomprobante')
            ->with('success', 'Tipo de comprobante de gasto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( string $id)
    {
        $comprobanteGasto = ComprobanteGasto::findOrFail($id);
        $comprobanteGasto->delete();
        return redirect()
            ->route('configuracion.tipocomprobante')
            ->with('success', 'Tipo de comprobante de gasto eliminado correctamente.');
    }
}
