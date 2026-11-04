<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
     public function index()
    {
        $productos = Producto::where('activo', true)->orderBy('id', 'desc')->get();
        return view('public.Home', compact('productos'));
    }
}
