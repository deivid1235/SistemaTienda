<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Compania;
use App\Models\LibroReclamo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LibroReclamoController extends Controller
{
    public function index()
    {
        $reclamos  = LibroReclamo::all();
        return view('admin.tienda.libro_reclamacion.index', compact('reclamos'));
    }

    public function pdf( string $id)
    {
        $reclamo = LibroReclamo::findOrFail($id);
        $compania = Compania::find(1);
        $pdf = Pdf::loadView('admin.tienda.libro_reclamacion.pdf',compact('reclamo','compania'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('Hoja_Reclamacion_' .str_pad($reclamo->id, 6, '0', STR_PAD_LEFT) .'.pdf');
    }

    public function visualizarPdf(string $id)
    {
        $reclamo = LibroReclamo::findOrFail($id);
        $compania = Compania::find(1);
        $pdf = Pdf::loadView('admin.tienda.libro_reclamacion.pdf',compact('reclamo', 'compania'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Hoja_Reclamacion_' .str_pad($reclamo->id, 6, '0', STR_PAD_LEFT) .'.pdf');
    }

    public function destroy(string $id)
    {
        $reclamo = LibroReclamo::findOrFail($id);
        $reclamo->delete();
        return back()->with('success', 'El reclamo fue eliminado correctamente.');
    }


    public function responder(Request $request, string $id)
    {
        $datos = $request->validate([
            'mensaje' => 'required|string|max:5000',
        ]);
        $reclamo = LibroReclamo::findOrFail($id);
        if (empty($reclamo->correo) || !filter_var($reclamo->correo, FILTER_VALIDATE_EMAIL)) {
            return back()->with('error', 'El cliente no tiene un correo válido registrado.');
        }
        try {
            Mail::raw($datos['mensaje'], function ($message) use ($reclamo) {
                $message->to($reclamo->correo)->subject('Respuesta a su Libro de Reclamaciones');
            });
            $reclamo->estado = 'Atendido';
            $reclamo->save();
            return back()->with('success', 'La respuesta fue enviada correctamente al correo del cliente.');
        } catch (\Throwable $e) {
        Log::error('ERROR SMTP LIBRO RECLAMACIONES', ['mensaje' => $e->getMessage(),'archivo' => $e->getFile(),'linea' => $e->getLine(),]);
        return back()->with('error','ERROR SMTP: ' . $e->getMessage());
        }
    }

}
