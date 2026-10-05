<?php

namespace App\Http\Controllers;

use App\Models\ComisionVendedor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ComisionVendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ComisionVendedor::with('vendedor');

        if ($request->filled('vendedor')) {
            $query->whereHas('vendedor', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->vendedor . '%');
            });
        }

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        $comisiones = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        // Usuarios que todavía no tienen comisión (para el modal Nuevo)
        $disponibles = User::whereNotIn('id', ComisionVendedor::pluck('user_id'))
            ->orderBy('name')
            ->get();

        return view('admin.configuracion.vendedor.index', compact('comisiones', 'disponibles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:comision_vendedores,user_id',
            'tipo'    => 'required|in:monto,porcentaje',
            'valor'   => ['required', 'numeric', 'min:0', Rule::when($request->tipo === 'porcentaje', ['max:100'])],
        ], [
            'user_id.unique' => 'Este vendedor ya tiene una comisión registrada.',
            'valor.max'      => 'El porcentaje no puede ser mayor a 100.',
        ]);

        $comision = new ComisionVendedor();
        $comision->user_id = $request->user_id;
        $comision->tipo = $request->tipo;
        $comision->valor = $request->valor;
        $comision->save();

        return redirect()->route('configuracion.vendedor')
            ->with('success', 'Comisión registrada correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ComisionVendedor $comision)
    {
        $request->validate([
            'tipo'  => 'required|in:monto,porcentaje',
            'valor' => ['required', 'numeric', 'min:0', Rule::when($request->tipo === 'porcentaje', ['max:100'])],
        ], [
            'valor.max' => 'El porcentaje no puede ser mayor a 100.',
        ]);

        $comision->tipo = $request->tipo;
        $comision->valor = $request->valor;
        $comision->save();

        return redirect()->route('configuracion.vendedor')
            ->with('success', 'Comisión actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ComisionVendedor $comision)
    {
        $comision->delete();

        return redirect()->route('configuracion.vendedor')
            ->with('success', 'Comisión eliminada correctamente.');
    }
}
