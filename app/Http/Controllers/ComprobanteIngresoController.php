<?php

namespace App\Http\Controllers;

use App\Models\ComprobanteGasto;
use App\Models\ComprobanteIngreso;
use Illuminate\Http\Request;

class ComprobanteIngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comprobantesGasto = ComprobanteGasto::all();
        $comprobantesIngreso = ComprobanteIngreso::all();
        return view('admin.configuracion.tipocomprobante.index', compact('comprobantesIngreso','comprobantesGasto'));
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

        $comprobanteIngreso = new ComprobanteIngreso();
        $comprobanteIngreso->descripcion = $request->descripcion;
        $comprobanteIngreso->estado = $request->estado;
        $comprobanteIngreso->save();
        return redirect()
            ->route('configuracion.tipocomprobante')
            ->with('success', 'Tipo de comprobante de ingreso registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ComprobanteIngreso $comprobanteIngreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComprobanteIngreso $comprobanteIngreso)
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

        $comprobanteIngreso = ComprobanteIngreso::findOrFail($id);
        $comprobanteIngreso->descripcion = $request->descripcion;
        $comprobanteIngreso->estado = $request->estado;
        $comprobanteIngreso->save();
        return redirect()
            ->route('configuracion.tipocomprobante')
            ->with('success', 'Tipo de comprobante de ingreso actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( string $id)
    {
        $comprobanteIngreso = ComprobanteIngreso::findOrFail($id);
        $comprobanteIngreso->delete();
        return redirect()
            ->route('configuracion.tipocomprobante')
            ->with('success', 'Tipo de comprobante de ingreso eliminado correctamente.');
    }
}
