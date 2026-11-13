<?php

namespace App\Http\Controllers;

use App\Models\Comprobante;
use App\Models\ResumenComprobante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResumenController extends Controller
{
    public function index(Request $request)
    {
        $resumenes = ResumenComprobante::query()
            ->when($request->filled('fecha'), fn ($q) => $q->whereDate('fecha_referencia', $request->fecha))
            ->when($request->filled('estado'), fn ($q) => $q->where('estado', $request->estado))
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.comprobantes_pendientes.resumenes', compact('resumenes'));
    }

    // Devuelve en JSON las boletas pendientes de la fecha elegida (botón "Buscar comprobantes").
    public function buscar(Request $request)
    {
        $request->validate(['fecha' => 'required|date']);

        $boletas = $this->boletasPendientes($request->fecha)->get();

        return response()->json([
            'cantidad'     => $boletas->count(),
            'total'        => number_format($boletas->sum('total'), 2),
            'comprobantes' => $boletas->map(fn ($b) => [
                'numero'    => $b->numero_completo,
                'cliente'   => $b->cliente_nombre,
                'documento' => $b->cliente_documento ?? '-',
                'total'     => number_format($b->total, 2),
            ])->values(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['fecha_referencia' => 'required|date']);

        $boletas = $this->boletasPendientes($request->fecha_referencia)->get();

        if ($boletas->isEmpty()) {
            return redirect()
                ->route('comprobantes.resumenes')
                ->withErrors(['fecha_referencia' => 'No hay boletas pendientes para la fecha seleccionada.']);
        }

        $resumen = DB::transaction(function () use ($boletas, $request) {
            $hoy         = now()->toDateString();
            $correlativo = ResumenComprobante::whereDate('fecha_emision', $hoy)->count() + 1;

            $resumen = ResumenComprobante::create([
                'fecha_emision'         => $hoy,
                'fecha_referencia'      => $request->fecha_referencia,
                'identificador'         => 'RC-' . now()->format('Ymd') . '-' . $correlativo,
                'estado'                => 'pendiente',
                'ticket'                => (string) random_int(100000000000000, 999999999999999),
                'cantidad_comprobantes' => $boletas->count(),
                'total'                 => $boletas->sum('total'),
                'user_id'               => auth()->id(),
            ]);

            Comprobante::whereIn('id', $boletas->pluck('id'))->update([
                'resumen_id'    => $resumen->id,
                'estado_envio'  => 'enviado',
                'fecha_envio'   => now(),
                'mensaje_sunat' => 'Incluido en el resumen diario ' . $resumen->identificador . ' (simulado).',
            ]);

            return $resumen;
        });

        return redirect()
            ->route('comprobantes.resumenes')
            ->with('success', 'Resumen ' . $resumen->identificador . ' generado con ' . $resumen->cantidad_comprobantes . ' boleta(s).');
    }

    // Consulta de ticket simulada. Aquí se conectará el servicio de SUNAT más adelante.
    public function consultar(ResumenComprobante $resumen)
    {
        if ($resumen->estado === 'pendiente') {
            $resumen->estado = 'aceptado';
            $resumen->save();
        }

        return redirect()
            ->route('comprobantes.resumenes')
            ->with('success', 'El resumen ' . $resumen->identificador . ' fue aceptado (simulado).');
    }

    private function boletasPendientes(string $fecha)
    {
        return Comprobante::where('tipo_comprobante', '03')
            ->where('estado_envio', 'pendiente')
            ->whereNull('resumen_id')
            ->whereDate('fecha_emision', $fecha)
            ->orderBy('serie')
            ->orderBy('numero');
    }
}
