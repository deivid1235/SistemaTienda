<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProducto;
use App\Models\Compania;
use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categorias = CategoriaProducto::all();
        $marcas = Marca::all();
        $compania = Compania::first();
        $query = Producto::query();
        if ($request->filled('categoria')) {
           $query->where('categoria_productos_id', $request->categoria);
        }
        $productos = $query->get();
        $carrito = session()->get('carrito', []);
        return view('public.Home', compact('categorias', 'productos', 'marcas','compania','carrito'));
    }

   
    public function categorias(string $categoria)
    {
        $categorias = CategoriaProducto::all();
        $categoria = CategoriaProducto::findOrFail($categoria);
        $compania = Compania::first();
        $productos = Producto::where('categoria_productos_id', $categoria->id)->get();
        return view('public.categoria', compact('categorias','categoria','productos','compania'));
    }
}