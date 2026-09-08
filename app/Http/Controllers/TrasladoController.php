<?php

namespace App\Http\Controllers;

use App\Models\Traslado;
use Illuminate\Http\Request;

class TrasladoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $traslados = Traslado::all();
        return view('admin.configuracion.traslado.index', compact('traslados'));
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
            'codigo' => 'required|string|max:20',
            'descripcion' => 'required|string|max:100',
            'descuenta_stock' => 'required|in:SI,NO',
        ]);

        $traslado = new Traslado();
        $traslado->codigo = $request->codigo;
        $traslado->descripcion = $request->descripcion;
        $traslado->descuenta_stock = $request->descuenta_stock;
        $traslado->save();
        return redirect()
            ->route('configuracion.traslado')
            ->with('success', 'Traslado registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Traslado $traslado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Traslado $traslado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Traslado $traslado)
    {
        $request->validate([
            'codigo' => 'required|string|max:20',
            'descripcion' => 'required|string|max:100',
            'descuenta_stock' => 'required|in:SI,NO',
        ]);

        $traslado->codigo = $request->codigo;
        $traslado->descripcion = $request->descripcion;
        $traslado->descuenta_stock = $request->descuenta_stock;
        $traslado->save();

        return redirect()
            ->route('configuracion.traslado')
            ->with('success', 'Traslado actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Traslado $traslado)
    {
        $traslado->delete();
        return redirect()
        ->route('configuracion.traslado')
        ->with('success', 'Traslado eliminado correctamente.');
    }
}
