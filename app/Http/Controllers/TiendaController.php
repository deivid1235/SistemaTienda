<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProducto;
use App\Models\Compania;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\TipoCliente;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
     public function index(Request $request)
    {
        $categorias = CategoriaProducto::all();
        $tiposClientes = TipoCliente::where('estado', 1)->get();
        $marcas = Marca::all();
        $compania = Compania::first();
        $query = Producto::query();
        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }
        $productos = $query->get();
        return view('public.Home', compact('categorias','marcas', 'compania', 'productos','tiposClientes'));
    }
}
