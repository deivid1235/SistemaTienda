<?php

namespace App\Http\Controllers;

use App\Models\LoginImagen;
use Illuminate\Http\Request;

class LoginImagenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'imagen_fondo' => 'required|array',
            'imagen_fondo.*' => 'mimes:png,svg|max:5120',
        ]);

        foreach ($request->file('imagen_fondo') as $archivo) {
            $ruta = $archivo->store('login', 'public');
            $imagen = new LoginImagen();
            $imagen->imagen = $ruta;
            $imagen->estado = true;
            $imagen->save();
        }

        return redirect()
            ->route('configuracion.login')
            ->with('success', 'Imágenes guardadas correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LoginImagen $loginImagen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoginImagen $loginImagen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoginImagen $loginImagen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoginImagen $loginImagen)
    {
        //
    }
}
