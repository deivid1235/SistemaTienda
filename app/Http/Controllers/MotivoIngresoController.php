<?php

namespace App\Http\Controllers;

use App\Models\MotivoIngreso;
use Illuminate\Http\Request;

class MotivoIngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$motivosIngreso = MotivoIngreso::all();
        //return view('admin.configuracion.motivogasto.index', compact('motivosIngreso'));
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

        $motivoIngreso = new MotivoIngreso();
        $motivoIngreso->descripcion = $request->descripcion;
        $motivoIngreso->estado = $request->estado;
        $motivoIngreso->save();

        return redirect()
            ->route('configuracion.motivogasto')
            ->with('success', 'Motivo de ingreso registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MotivoIngreso $motivoIngreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MotivoIngreso $motivoIngreso)
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

        $motivoIngreso = MotivoIngreso::findOrFail($id);

        $motivoIngreso->descripcion = $request->descripcion;
        $motivoIngreso->estado = $request->estado;
        $motivoIngreso->save();

        return redirect()
            ->route('configuracion.motivogasto')
            ->with('success', 'Motivo de ingreso actualizado correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $motivoIngreso = MotivoIngreso::findOrFail($id);
        $motivoIngreso->delete();
        return redirect()
            ->route('configuracion.motivogasto')
            ->with('success', 'Motivo de ingreso eliminado correctamente.');
    }
}
