<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProducto;
use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{

    public function agregar(string $id)
    {
        $carrito = session()->get('carrito', []);
        $producto = Producto::findOrFail($id);
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [ 'id' => $producto->id, 'nombre' => $producto->nombre,'precio_unitario' => 
            $producto->precio_unitario, 'imagen' => $producto->imagen,'cantidad' => 1,];
        }
        session()->put('carrito', $carrito);
        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    public function disminuir(string $id)
    {
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']--;
            if ($carrito[$id]['cantidad'] <= 0) {
                unset($carrito[$id]);
            }
        }
        session()->put('carrito', $carrito);
        return redirect()->back();
    }

    public function eliminar(string $id)
    {
        $carrito = session()->get('carrito', []);
        if (!isset($carrito[$id])) {
            return redirect()->back()->with('error','El producto no existe en el carrito.');}
        unset($carrito[$id]);
        session()->put('carrito', $carrito);
        return redirect()->back()->with('success','Producto eliminado del carrito correctamente.');
    }
}
