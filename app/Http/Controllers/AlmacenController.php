<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Serie;
use App\Models\Sucursal;
use App\Models\Usuario;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $almacenes = Almacen::all();
        $sucursales = Sucursal::all();
        $series = Serie::all();
        $usuarios = Usuario::all();

        return view('admin.almacen.index', compact('sucursales', 'series', 'usuarios','almacenes'));
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
            'codigo' => 'required|string|max:20|unique:almacens,codigo',
            'nombre' => 'required|string|max:100',
            'sucursal_id' => 'required|exists:sucursals,id',
            'serie_id' => 'required|exists:series,id',
            'responsable_id' => 'required|exists:usuarios,id',
            'descripcion' => 'nullable|string',
            'estado' => 'nullable|boolean',
        ]);
        $almacen = new Almacen();
        $almacen->codigo = $request->codigo;
        $almacen->nombre = $request->nombre;
        $almacen->sucursal_id = $request->sucursal_id;
        $almacen->serie_id = $request->serie_id;
        $almacen->responsable_id = $request->responsable_id;
        $almacen->descripcion = $request->descripcion;
        $almacen->estado = $request->boolean('estado', true);
        $almacen->save();

        return redirect()->back()
            ->with('success', 'Almacén registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Almacen $almacen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Almacen $almacen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  string $id)
    {
        $almacen = Almacen::findOrFail($id);

        $request->validate([
            'codigo' => ['required','string','max:20',Rule::unique('almacens', 'codigo')->ignore($id),],
            'nombre' => 'required|string|max:100',
            'sucursal_id' => 'required|exists:sucursals,id',
            'serie_id' => 'required|exists:series,id',
            'responsable_id' => 'required|exists:usuarios,id',
            'descripcion' => 'nullable|string',
            'estado' => 'required|boolean',
        ]);
        $almacen->codigo = $request->codigo;
        $almacen->nombre = $request->nombre;
        $almacen->sucursal_id = $request->sucursal_id;
        $almacen->serie_id = $request->serie_id;
        $almacen->responsable_id = $request->responsable_id;
        $almacen->descripcion = $request->descripcion;
        $almacen->estado = $request->boolean('estado');
        $almacen->save();
        return redirect()->back()
            ->with('success', 'Almacén actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $almacen = Almacen::findOrFail($id);
        $almacen->delete();
        return redirect()->back()
            ->with('success', 'Almacén eliminado correctamente.');
    }
}
