<?php

namespace App\Http\Controllers;

use App\Models\CuentaContable;
use Illuminate\Http\Request;

class CuentaContableController extends Controller
{
    public function index()
    {
        $cuenta = CuentaContable::first();
        return view('admin.configuracion.contable.index', compact('cuenta'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'venta_total_soles'      => 'required|string|max:20',
            'venta_igv_soles'        => 'required|string|max:20',
            'venta_subtotal_soles'   => 'required|string|max:20',
            'venta_total_dolares'    => 'required|string|max:20',
            'venta_igv_dolares'      => 'required|string|max:20',
            'venta_subtotal_dolares' => 'required|string|max:20',
        ]);

        $cuenta = CuentaContable::first() ?? new CuentaContable();
        $cuenta->fill($datos);
        $cuenta->save();

        return redirect()
            ->route('configuracion.contable')
            ->with('success', 'Las cuentas contables se guardaron correctamente.');
    }
}
