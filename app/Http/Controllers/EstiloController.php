<?php

namespace App\Http\Controllers;

use App\Models\Estilo;
use Illuminate\Http\Request;

class EstiloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estilos = Estilo::all();
        return view('admin.configuracion.configuracion_menu', compact('estilos'));
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
        $estilo = new Estilo();
        $estilo->nombre = $request->nombre;
        $estilo->color = $request->color;
        $estilo->modo = $request->modo;
        $estilo->menu_lateral = $request->menu_lateral;
        $estilo->estado = 'INACTIVO';
        $estilo->save();

        return back()->with('success', 'Estilo guardado correctamente.');
    }

    public function activar( string $id)
{
    Estilo::where('estado', 'ACTIVO')->update([
        'estado' => 'INACTIVO'
    ]);

    $estilo = Estilo::findOrFail($id);

    $estilo->estado = 'ACTIVO';
    $estilo->save();

    return back()->with('success', 'Estilo activado correctamente.');
}

    /**
     * Display the specified resource.
     */
    public function show(Estilo $estilo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editar(string $id)
    {
        $estilos = Estilo::all();
        $estiloEditar = Estilo::findOrFail($id);
        return view('admin.configuracion.configuracion_menu', compact('estilos', 'estiloEditar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  string $id)
    {
        $estilo = Estilo::findOrFail($id);

        $estilo->nombre = $request->nombre;
        $estilo->color = $request->color;
        $estilo->modo = $request->modo;
        $estilo->menu_lateral = $request->menu_lateral;

        $estilo->save();

        return redirect()
            ->route('configuracion')
            ->with('success', 'Estilo actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $estilo = Estilo::findOrFail($id);
        $estilo->delete();
        return back()->with('success', 'Estilo eliminado correctamente.');
    }
}
