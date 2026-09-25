<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.configuracion.roles.index', compact('roles'));
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
            'nombre' => 'required|string|max:100|unique:roles,nombre',
            'descripcion' => 'nullable|string|max:255',
            'estado' => 'required|boolean',
        ]);

        $role = new Role();
        $role->nombre = $request->nombre;
        $role->descripcion = $request->descripcion;
        $role->estado = $request->estado;
        $role->save();

        return redirect()->route('configuracion.roles')
            ->with('success', 'Rol guardado correctamente.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:roles,nombre,' . $role->id,
            'descripcion' => 'nullable|string|max:255',
            'estado' => 'required|boolean',
        ]);

        $role->nombre = $request->nombre;
        $role->descripcion = $request->descripcion;
        $role->estado = $request->estado;
        $role->save();

        return redirect()->route('configuracion.roles')
            ->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('configuracion.roles')
            ->with('success', 'Rol eliminado correctamente.');
    }
}
