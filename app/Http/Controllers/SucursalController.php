<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sucursals = Sucursal::all();
        return view('admin.sucursal.index', compact('sucursals'));
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
            'pais' => 'required|string|max:100',
            'departamento' => 'required|string|max:100',
            'provincia' => 'required|string|max:100',
            'distrito' => 'required|string|max:100',
            'direccion_fiscal' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:30',
            'direccion_comercial' => 'nullable|string|max:255',
            'correo_contacto' => 'nullable|email|max:150',
            'direccion_web' => 'nullable|string|max:255',
            'informacion_adicional' => 'nullable|string',
            'codigo_sucursal' => 'required|string|max:20|unique:sucursals,codigo_sucursal',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);

        $sucursal = new Sucursal();

        $sucursal->descripcion = $request->descripcion;
        $sucursal->pais = $request->pais;
        $sucursal->departamento = $request->departamento;
        $sucursal->provincia = $request->provincia;
        $sucursal->distrito = $request->distrito;
        $sucursal->direccion_fiscal = $request->direccion_fiscal;
        $sucursal->telefono = $request->telefono;
        $sucursal->direccion_comercial = $request->direccion_comercial;
        $sucursal->correo_contacto = $request->correo_contacto;
        $sucursal->direccion_web = $request->direccion_web;
        $sucursal->informacion_adicional = $request->informacion_adicional;
        $sucursal->codigo_sucursal = $request->codigo_sucursal;
        $sucursal->estado = $request->estado;

        $sucursal->save();

        return redirect()->route('sucursal')
            ->with('success', 'Sucursal registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sucursal $sucursal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sucursal $sucursal)
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
            'pais' => 'required|string|max:100',
            'departamento' => 'required|string|max:100',
            'provincia' => 'required|string|max:100',
            'distrito' => 'required|string|max:100',
            'direccion_fiscal' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:30',
            'direccion_comercial' => 'nullable|string|max:255',
            'correo_contacto' => 'nullable|email|max:150',
            'direccion_web' => 'nullable|string|max:255',
            'informacion_adicional' => 'nullable|string',
            'codigo_sucursal' => 'required|string|max:20|unique:sucursals,codigo_sucursal,' . $id,
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);

        $sucursal = Sucursal::findOrFail($id);

        $sucursal->descripcion = $request->descripcion;
        $sucursal->pais = $request->pais;
        $sucursal->departamento = $request->departamento;
        $sucursal->provincia = $request->provincia;
        $sucursal->distrito = $request->distrito;
        $sucursal->direccion_fiscal = $request->direccion_fiscal;
        $sucursal->telefono = $request->telefono;
        $sucursal->direccion_comercial = $request->direccion_comercial;
        $sucursal->correo_contacto = $request->correo_contacto;
        $sucursal->direccion_web = $request->direccion_web;
        $sucursal->informacion_adicional = $request->informacion_adicional;
        $sucursal->codigo_sucursal = $request->codigo_sucursal;
        $sucursal->estado = $request->estado;

        $sucursal->save();

        return redirect()->route('sucursal')
            ->with('success', 'Sucursal actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( string $id)
    {
        $sucursal = Sucursal::findOrFail($id);
        $sucursal->delete();
        return redirect()->route('sucursal')
            ->with('success', 'Sucursal eliminada correctamente.');
    }

}
