<?php

namespace App\Http\Controllers;

use App\Models\Compania;
use App\Models\Login;
use App\Models\LoginImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
     {
        $compania = Compania::first();
        $login = Login::where('compania_id', $compania->id)->first();
        $imagenes = LoginImagen::where('estado', true)->get();
        return view('admin.configuracion.login.index', compact('login', 'imagenes'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Login $login)
    {
        $request->validate([
            'posicion_formulario' => 'required|in:IZQUIERDA,DERECHA',
            'posicion_logo' => 'required|in:SUPERIOR_IZQUIERDA,SUPERIOR_CENTRO,SUPERIOR_DERECHA',
        ]);

        $compania = Compania::first();

        $login = Login::where('compania_id', $compania->id)->first();

        if (!$login) {
            $login = new Login();
            $login->compania_id = $compania->id;
        }

        $login->posicion_formulario = $request->posicion_formulario;
        $login->mostrar_logo = $request->has('mostrar_logo');
        $login->posicion_logo = $request->posicion_logo;
        $login->mostrar_facebook = $request->has('mostrar_facebook');
        $login->mostrar_twitter = $request->has('mostrar_twitter');
        $login->mostrar_instagram = $request->has('mostrar_instagram');
        $login->mostrar_linkedin = $request->has('mostrar_linkedin');

        $login->save();

        return redirect()
            ->route('configuracion.login')
            ->with('success', 'Configuración del login actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Login $login)
    {
        //
    }

}
