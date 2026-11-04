<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProducto;
use App\Models\Producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Obtener todas las categorías
        $categorias = CategoriaProducto::all();

        // Consultar productos
        $query = Producto::query();

        // Filtrar por categoría si se selecciona una
        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }

        $productos = $query->get();

        return view('public.Home', compact('categorias', 'productos'));
    }
}