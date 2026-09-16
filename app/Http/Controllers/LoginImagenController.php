<?php

namespace App\Http\Controllers;

use App\Models\LoginImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'imagenes' => 'required|array',
            'imagenes.*' => 'image|mimes:png,jpg,jpeg,svg|max:5120',
        ]);

        foreach ($request->file('imagenes') as $archivo) {

            $ruta = $archivo->store('login', 'public');

            $imagen = new LoginImagen();
            $imagen->imagen = 'storage/' . $ruta;
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
        $request->validate([
            'imagen' => 'required|image|mimes:png,jpg,jpeg,svg|max:5120',
        ]);

        if ($request->hasFile('imagen')) {

            if ($loginImagen->imagen && Storage::disk('public')->exists(
                str_replace('storage/', '', $loginImagen->imagen)
            )) {

                Storage::disk('public')->delete(
                    str_replace('storage/', '', $loginImagen->imagen)
                );
            }

            $ruta = $request->file('imagen')->store('login', 'public');

            $loginImagen->imagen = 'storage/' . $ruta;
            $loginImagen->save();
        }

        return redirect()
            ->route('configuracion.login')
            ->with('success', 'Imagen actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoginImagen $loginImagen)
    {
        if ($loginImagen->imagen && Storage::disk('public')->exists(
            str_replace('storage/', '', $loginImagen->imagen)
        )) {

            Storage::disk('public')->delete(
                str_replace('storage/', '', $loginImagen->imagen)
            );
        }

        $loginImagen->delete();

        return redirect()
            ->route('configuracion.login')
            ->with('success', 'Imagen eliminada correctamente.');
    }
}
