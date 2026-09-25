<?php

namespace App\Http\Controllers;

use App\Models\TipoCliente;
use Illuminate\Http\Request;

class TipoClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoClientes = TipoCliente::all();
        return view('admin.tipocliente.index', compact('tipoClientes'));
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
            'nombre' => 'required|string|max:100|unique:tipo_clientes,nombre',
            'estado' => 'required|boolean',
        ]);

        $tipoCliente = new TipoCliente();
        $tipoCliente->nombre = $request->nombre;
        $tipoCliente->estado = $request->estado;
        $tipoCliente->save();
        return redirect()->route('tipocliente')
            ->with('success', 'Tipo de cliente guardado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoCliente $tipoCliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoCliente $tipoCliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoCliente $tipoCliente)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:tipo_clientes,nombre,' . $tipoCliente->id,
            'estado' => 'required|boolean',
        ]);

        $tipoCliente->nombre = $request->nombre;
        $tipoCliente->estado = $request->estado;
        $tipoCliente->save();

        return redirect()->route('tipocliente')
            ->with('success', 'Tipo de cliente actualizado correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoCliente $tipoCliente)
    {
        $tipoCliente->delete();

        return redirect()->route('tipocliente')
            ->with('success', 'Tipo de cliente eliminado correctamente.');
    }
}
