<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\LibroReclamo;
use Illuminate\Http\Request;

class LibroReclamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('public.libro_reclamacion');       
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
        $datos = $request->validate([
            'tipo_documento'          => 'required|string|max:20',
            'numero_documento'        => 'required|string|max:20',
            'primer_nombre'           => 'required|string|max:100',
            'segundo_nombre'          => 'nullable|string|max:100',
            'primer_apellido'         => 'required|string|max:100',
            'segundo_apellido'        => 'required|string|max:100',
            'correo'                  => 'required|email|max:150',
            'telefono'                => 'required|string|max:20',
            'direccion'               => 'required|string|max:255',
            'departamento'            => 'required|string|max:100',
            'provincia'               => 'required|string|max:100',
            'distrito'                => 'required|string|max:100',
            'servicio_contratado'     => 'required|string|max:150',
            'numero_orden'            => 'nullable|string|max:50',
            'identificacion_servicio' => 'nullable|string|max:150',
            'monto_reclamado'         => 'nullable|numeric|min:0|max:99999999.99',
            'tipo_reclamo'            => 'required|in:Reclamo,Queja',
            'motivo'                  => 'required|string',
            'detalle_solicitud'       => 'required|string',
            'pedido_concreto'         => 'required|string',
            'acepto_politicas'        => 'required|accepted',
            'clientes_id'             => 'nullable|exists:clientes,id',
        ]);
        $reclamacion = new LibroReclamo();

        $reclamacion->tipo_documento = $datos['tipo_documento'];
        $reclamacion->numero_documento = $datos['numero_documento'];
        $reclamacion->primer_nombre = $datos['primer_nombre'];
        $reclamacion->segundo_nombre = $datos['segundo_nombre'] ?? null;
        $reclamacion->primer_apellido = $datos['primer_apellido'];
        $reclamacion->segundo_apellido = $datos['segundo_apellido'];
        $reclamacion->correo = $datos['correo'];
        $reclamacion->telefono = $datos['telefono'];
        $reclamacion->direccion = $datos['direccion'];
        $reclamacion->departamento = $datos['departamento'];
        $reclamacion->provincia = $datos['provincia'];
        $reclamacion->distrito = $datos['distrito'];
        $reclamacion->servicio_contratado = $datos['servicio_contratado'];
        $reclamacion->numero_orden = $datos['numero_orden'] ?? null;
        $reclamacion->identificacion_servicio = $datos['identificacion_servicio'] ?? null;
        $reclamacion->monto_reclamado = $datos['monto_reclamado'] ?? null;
        $reclamacion->tipo_reclamo = $datos['tipo_reclamo'];
        $reclamacion->motivo = $datos['motivo'];
        $reclamacion->detalle_solicitud = $datos['detalle_solicitud'];
        $reclamacion->pedido_concreto = $datos['pedido_concreto'];
        $reclamacion->acepto_politicas = true;
        $reclamacion->clientes_id = $datos['clientes_id'] ?? null;
        $reclamacion->save();
        return redirect()->back()->with('success', 'Tu reclamación ha sido registrada correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(LibroReclamo $libroReclamo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LibroReclamo $libroReclamo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LibroReclamo $libroReclamo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LibroReclamo $libroReclamo)
    {
        //
    }
}
