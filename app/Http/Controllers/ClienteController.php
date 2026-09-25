<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use App\Models\Cliente;
use App\Models\TipoCliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        $tipoClientes = TipoCliente::where('estado', true)->get();
        return view('admin.cliente.index',compact('tipoClientes','clientes'));
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
            'tipo_documento' => 'required|string|max:20',
            'numero_documento' => 'required|string|max:30',
            'nombre' => 'required|string|max:100',
            'nombre_comercial' => 'nullable|string|max:150',
            'codigo_interno' => 'nullable|string|max:50',
            'nacionalidad' => 'nullable|string|max:100',
            'tipo_cliente_id' => 'required|exists:tipo_clientes,id',
            'codigo_barra' => 'nullable|string|max:100',
            'direccion' => 'nullable|string|max:255',
            'pais' => 'nullable|string|max:100',
            'codigo_sucursal' => 'nullable|string|max:50',
            'telefono' => 'nullable|string|max:30',
            'correo_electronico' => 'nullable|email|max:150',
            'sitio_web' => 'nullable|string|max:255',
            'dias_credito' => 'nullable|integer|min:0',
            'observaciones' => 'nullable|string',
            'estado' => 'required|boolean',
        ]);

        $cliente = new Cliente();
        $cliente->tipo_documento = $request->tipo_documento;
        $cliente->numero_documento = $request->numero_documento;
        $cliente->nombre = $request->nombre;
        $cliente->nombre_comercial = $request->nombre_comercial;
        $cliente->codigo_interno = $request->codigo_interno;
        $cliente->nacionalidad = $request->nacionalidad;
        $cliente->tipo_cliente_id = $request->tipo_cliente_id;
        $cliente->codigo_barra = $request->codigo_barra;
        $cliente->direccion = $request->direccion;
        $cliente->pais = $request->pais;
        $cliente->codigo_sucursal = $request->codigo_sucursal;
        $cliente->telefono = $request->telefono;
        $cliente->correo_electronico = $request->correo_electronico;
        $cliente->sitio_web = $request->sitio_web;
        $cliente->dias_credito = $request->dias_credito ?? 0;
        $cliente->observaciones = $request->observaciones;
        $cliente->estado = $request->estado;
        $cliente->save();

        return redirect()->route('cliente')
            ->with('success', 'Cliente guardado correctamente.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'tipo_documento' => 'required|string|max:20',
            'numero_documento' => 'required|string|max:30',
            'nombre' => 'required|string|max:100',
            'nombre_comercial' => 'nullable|string|max:150',
            'codigo_interno' => 'nullable|string|max:50',
            'nacionalidad' => 'nullable|string|max:100',
            'tipo_cliente_id' => 'required|exists:tipo_clientes,id',
            'codigo_barra' => 'nullable|string|max:100',
            'direccion' => 'nullable|string|max:255',
            'pais' => 'nullable|string|max:100',
            'codigo_sucursal' => 'nullable|string|max:50',
            'telefono' => 'nullable|string|max:30',
            'correo_electronico' => 'nullable|email|max:150',
            'sitio_web' => 'nullable|string|max:255',
            'dias_credito' => 'nullable|integer|min:0',
            'observaciones' => 'nullable|string',
            'estado' => 'required|boolean',
        ]);

        $cliente->tipo_documento = $request->tipo_documento;
        $cliente->numero_documento = $request->numero_documento;
        $cliente->nombre = $request->nombre;
        $cliente->nombre_comercial = $request->nombre_comercial;
        $cliente->codigo_interno = $request->codigo_interno;
        $cliente->nacionalidad = $request->nacionalidad;
        $cliente->tipo_cliente_id = $request->tipo_cliente_id;
        $cliente->codigo_barra = $request->codigo_barra;
        $cliente->direccion = $request->direccion;
        $cliente->pais = $request->pais;
        $cliente->codigo_sucursal = $request->codigo_sucursal;
        $cliente->telefono = $request->telefono;
        $cliente->correo_electronico = $request->correo_electronico;
        $cliente->sitio_web = $request->sitio_web;
        $cliente->dias_credito = $request->dias_credito ?? 0;
        $cliente->observaciones = $request->observaciones;
        $cliente->estado = $request->estado;
        $cliente->save();

        return redirect()->route('cliente')
            ->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('cliente')
            ->with('success', 'Cliente eliminado correctamente.');
    }

    public function consultaDocumento(Request $request)
    {
        $request->validate([
            'tipo_documento' => 'required|in:DNI,RUC',
            'numero_documento' => 'required|string',
        ]);

        $tipo = $request->tipo_documento;
        $numero = $request->numero_documento;

        if ($tipo === 'DNI' && strlen($numero) !== 8) {
            return response()->json([
                'success' => false,
                'message' => 'El DNI debe tener 8 dígitos.'
            ], 422);
        }

        if ($tipo === 'RUC' && strlen($numero) !== 11) {
            return response()->json([
                'success' => false,
                'message' => 'El RUC debe tener 11 dígitos.'
            ], 422);
        }

        $endpoint = $tipo === 'DNI' ? '/dni' : '/ruc';
        $campo = $tipo === 'DNI' ? 'dni' : 'ruc';

        $response = Http::timeout(10)
            ->withToken(env('APIPERU_TOKEN'))
            ->acceptJson()
            ->post(env('APIPERU_URL') . $endpoint, [
                $campo => $numero,
            ]);

        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => $response->json('message', 'Error al consultar API Perú.'),
                'codigo' => $response->status()
            ], $response->status());
        }

        return response()->json($response->json());
    }

}
