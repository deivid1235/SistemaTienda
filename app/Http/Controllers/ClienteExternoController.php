<?php

namespace App\Http\Controllers;

use App\Models\ClienteExterno;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ClienteExternoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $clientesExternos = ClienteExterno::with('user')->get();
        return view('admin.cliente_externo.index', compact('clientesExternos'));

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
            'correo' => 'required|email|max:150|unique:users,email',
            'contrasena' => 'required|string|min:8',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'tipo_documento' => 'required|in:DNI,CE,PASAPORTE',
            'numero_documento' => 'required|string|max:20|unique:cliente_externos,numero_documento',
            'celular' => 'required|string|max:15',
            'acepta_terminos' => 'required|accepted',
            'declaracion_jurada' => 'required|accepted',
        ]);
        DB::beginTransaction();
        try {
            $usuario = new User();
            $usuario->name = $request->nombre . ' ' . $request->apellido;
            $usuario->email = $request->correo;
            $usuario->password = Hash::make($request->contrasena);
            $usuario->save();
            $clienteExterno = new ClienteExterno();
            $clienteExterno->user_id = $usuario->id;
            $clienteExterno->nombre = $request->nombre;
            $clienteExterno->apellido = $request->apellido;
            $clienteExterno->tipo_documento = $request->tipo_documento;
            $clienteExterno->numero_documento = $request->numero_documento;
            $clienteExterno->celular = $request->celular;
            $clienteExterno->acepta_terminos = $request->acepta_terminos;
            $clienteExterno->declaracion_jurada = $request->declaracion_jurada;
            $clienteExterno->save();
            DB::commit();
            return redirect()->back()->with('success', 'Cliente registrado correctamente. Ya puedes iniciar sesión.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error al registrar el cliente.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ClienteExterno $clienteExterno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClienteExterno $clienteExterno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClienteExterno $clienteExterno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClienteExterno $clienteExterno)
    {
        //
    }
}
