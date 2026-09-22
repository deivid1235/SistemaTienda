<?php

namespace App\Http\Controllers;

use App\Models\MotivoGasto;
use App\Models\MotivoIngreso;
use Illuminate\Http\Request;

class MotivoGastoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motivosGasto  = MotivoGasto::all();
        $motivosIngreso = MotivoIngreso::all();
        return view('admin.configuracion.motivogasto.index', compact('motivosGasto','motivosIngreso'));
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

        $motivo = new MotivoGasto();
        $motivo->descripcion = $request->descripcion;
        $motivo->estado = $request->estado;
        $motivo->save();

        return redirect()
            ->route('configuracion.motivogasto')
            ->with('success', 'Motivo de gasto guardado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MotivoGasto $motivoGasto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MotivoGasto $motivoGasto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  string $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:150',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);
        $motivoGasto = MotivoGasto::findOrFail($id);
        $motivoGasto->descripcion = $request->descripcion;
        $motivoGasto->estado = $request->estado;
        $motivoGasto->save();
        return redirect()
            ->route('configuracion.motivogasto')
            ->with('success', 'Motivo de gasto actualizado correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $motivoGasto = MotivoGasto::findOrFail($id);
        $motivoGasto->delete();
        return redirect()
            ->route('configuracion.motivogasto')
            ->with('success', 'Motivo de gasto eliminado correctamente.');
    }
}
