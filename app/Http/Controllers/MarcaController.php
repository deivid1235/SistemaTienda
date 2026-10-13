<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marca::all();
        return view('admin.marca.index',compact('marcas'));
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
            'nombre' => 'required|string|max:100|unique:marcas,nombre',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'descripcion' => 'nullable|string',
            'estado' => 'required|boolean',
        ]);

        $marca = new Marca();

        $marca->nombre = $request->nombre;
        $marca->descripcion = $request->descripcion;
        $marca->estado = $request->estado;

        if ($request->hasFile('logo')) {
            $marca->logo = $request->file('logo')->store('marcas', 'public');
        }
        $marca->save();
        return redirect()->route('marca')
            ->with('success', 'Marca registrada correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Marca $marca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, string $id)
    {
        $marca = Marca::findOrFail($id);
        $request->validate([
            'nombre' => 'required|string|max:100|unique:marcas,nombre,' . $id,
            'descripcion' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'estado' => 'required|boolean',
        ]);

        $marca->nombre = $request->nombre;
        $marca->descripcion = $request->descripcion;
        $marca->estado = $request->estado;

        // Si se sube un logo nuevo, eliminar el anterior
        if ($request->hasFile('logo')) {
            if ($marca->logo && Storage::disk('public')->exists($marca->logo)) {
                Storage::disk('public')->delete($marca->logo);
            }
            $marca->logo = $request->file('logo')->store('marcas', 'public');
        }

        $marca->save();
        return redirect()->route('marca')
            ->with('success', 'Marca actualizada correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    
    public function destroy( string $id)
    {
        $marca = Marca::findOrFail($id);
        if ($marca->logo && Storage::disk('public')->exists($marca->logo)) {
            Storage::disk('public')->delete($marca->logo);
        }
        $marca->delete();
        return redirect()->route('marca')
            ->with('success', 'Marca eliminada correctamente.');
    }

}
