<?php

namespace App\Http\Controllers;

use App\Models\Comprobante;
use Illuminate\Http\Request;

class ComprobanteNoEnviadoController extends Controller
{
    public function index(Request $request)
    {
        $comprobantes = Comprobante::with('usuario')
            ->where('estado_envio', 'pendiente')
            ->when($request->filled('buscar'), function ($query) use ($request) {
                $buscar = $request->buscar;
                $query->where(function ($q) use ($buscar) {
                    $q->where('cliente_nombre', 'like', "%{$buscar}%")
                      ->orWhere('cliente_documento', 'like', "%{$buscar}%")
                      ->orWhere('serie', 'like', "%{$buscar}%")
                      ->orWhere('numero', 'like', "%{$buscar}%");
                });
            })
            ->when($request->filled('tipo'), fn ($q) => $q->where('tipo_comprobante', $request->tipo))
            ->when($request->filled('fecha'), fn ($q) => $q->whereDate('fecha_emision', $request->fecha))
            ->orderByDesc('fecha_emision')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.comprobantes_pendientes.no_enviados', compact('comprobantes'));
    }

    // Envío simulado. Aquí se conectará el servicio de SUNAT/OSE más adelante.
    public function enviar(Comprobante $comprobante)
    {
        $comprobante->estado_envio  = 'enviado';
        $comprobante->fecha_envio   = now();
        $comprobante->mensaje_sunat = 'El comprobante fue aceptado (simulado).';
        $comprobante->save();

        return redirect()
            ->route('comprobantes.no_enviados')
            ->with('success', 'Comprobante ' . $comprobante->numero_completo . ' enviado correctamente.');
    }
}
