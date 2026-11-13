<?php

namespace App\Http\Controllers;

use App\Models\Anulacion;
use App\Models\Comprobante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnulacionController extends Controller
{
    public function index(Request $request)
    {
        $anulaciones = Anulacion::query()
            ->when($request->filled('fecha'), fn ($q) => $q->whereDate('fecha_comprobante', $request->fecha))
            ->when($request->filled('estado'), fn ($q) => $q->where('estado', $request->estado))
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.comprobantes_pendientes.anulaciones', compact('anulaciones'));
    }

    // Devuelve en JSON los comprobantes ya enviados de la fecha elegida (botón "Consultar documentos").
    public function buscar(Request $request)
    {
        $request->validate(['fecha' => 'required|date']);

        $documentos = $this->enviadosAnulables($request->fecha)->get();

        return response()->json([
            'cantidad'     => $documentos->count(),
            'comprobantes' => $documentos->map(fn ($c) => [
                'id'      => $c->id,
                'numero'  => $c->numero_completo,
                'tipo'    => $c->tipo_nombre,
                'cliente' => $c->cliente_nombre,
                'total'   => number_format($c->total, 2),
            ])->values(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_comprobante'  => 'required|date',
            'comprobante_ids'    => 'required|array|min:1',
            'comprobante_ids.*'  => 'integer',
            'motivo'             => 'required|string|max:255',
        ], [
            'comprobante_ids.required' => 'Seleccione al menos un comprobante para anular.',
            'comprobante_ids.min'      => 'Seleccione al menos un comprobante para anular.',
            'motivo.required'          => 'Escriba el motivo de la anulación.',
        ]);

        $documentos = $this->enviadosAnulables($request->fecha_comprobante)
            ->whereIn('id', $request->comprobante_ids)
            ->get();

        if ($documentos->isEmpty()) {
            return redirect()
                ->route('comprobantes.anulaciones')
                ->withErrors(['comprobante_ids' => 'Los comprobantes seleccionados ya no están disponibles para anular.']);
        }

        $anulacion = DB::transaction(function () use ($documentos, $request) {
            $hoy         = now()->toDateString();
            $correlativo = Anulacion::whereDate('fecha_emision', $hoy)->count() + 1;

            $anulacion = Anulacion::create([
                'fecha_emision'         => $hoy,
                'fecha_comprobante'     => $request->fecha_comprobante,
                'identificador'         => 'RA-' . now()->format('Ymd') . '-' . $correlativo,
                'estado'                => 'pendiente',
                'ticket'                => (string) random_int(100000000000000, 999999999999999),
                'motivo'                => $request->motivo,
                'cantidad_comprobantes' => $documentos->count(),
                'user_id'               => auth()->id(),
            ]);

            Comprobante::whereIn('id', $documentos->pluck('id'))->update([
                'anulacion_id'  => $anulacion->id,
                'estado_envio'  => 'anulado',
                'mensaje_sunat' => 'Anulado mediante la comunicación de baja ' . $anulacion->identificador . ' (simulado).',
            ]);

            return $anulacion;
        });

        return redirect()
            ->route('comprobantes.anulaciones')
            ->with('success', 'Comunicación de baja ' . $anulacion->identificador . ' generada con ' . $anulacion->cantidad_comprobantes . ' comprobante(s).');
    }

    // Consulta de ticket simulada. Aquí se conectará el servicio de SUNAT más adelante.
    public function consultar(Anulacion $anulacion)
    {
        if ($anulacion->estado === 'pendiente') {
            $anulacion->estado = 'aceptado';
            $anulacion->save();
        }

        return redirect()
            ->route('comprobantes.anulaciones')
            ->with('success', 'La comunicación de baja ' . $anulacion->identificador . ' fue aceptada (simulado).');
    }

    private function enviadosAnulables(string $fecha)
    {
        return Comprobante::where('estado_envio', 'enviado')
            ->whereNull('anulacion_id')
            ->whereDate('fecha_emision', $fecha)
            ->orderBy('serie')
            ->orderBy('numero');
    }
}
