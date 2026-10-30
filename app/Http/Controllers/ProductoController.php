<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\CategoriaProducto;
use App\Models\Inventario;
use App\Models\Marca;
use App\Models\Moneda;
use App\Models\Producto;
use App\Models\TipoAfectacionIgv;
use App\Models\Unidad;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorSVG;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::paginate(10);
        $inventarios = Inventario::all();
        $categorias = CategoriaProducto::all();
        $marcas = Marca::all();
        $unidades = Unidad::all();
        $monedas  = Moneda::all();
        $tiposAfectacionIgv = TipoAfectacionIgv::all();
        $almacenes = Almacen::all();
        return view('admin.producto.index', compact('categorias','marcas','unidades','monedas','tiposAfectacionIgv','almacenes','productos','inventarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:200',
            'descripcion' => 'nullable|string',
            'modelo' => 'nullable|string|max:150',
            'categoria_id' => 'required|exists:categoria_productos,id',
            'marca_id' => 'nullable|exists:marcas,id',
            'unidad_id' => 'nullable|exists:unidads,id',
            'moneda_id' => 'required|exists:monedas,id',
            'tipo_afectacion_igv_id' => 'nullable|exists:tipo_afectacion_igvs,id',
            'precio_unitario' => 'required|numeric|min:0',
            'costo_unitario' => 'nullable|numeric|min:0',
            'codigo_interno' => 'nullable|string|max:50|unique:productos,codigo_interno',
            'codigo_barras' => 'nullable|string|max:100|unique:productos,codigo_barras',
            'codigo_sunat' => 'nullable|string|max:20',
            'codigo_fabricante' => 'nullable|string|max:100',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'almacen_id' => 'required|exists:almacens,id',
            'stock_inicial' => 'required|numeric|min:0',
            'stock_actual' => 'required|numeric|min:0',
            'stock_minimo' => 'required|numeric|min:0',
        ]);
        $archivosGuardados = [];
        try {
            DB::transaction(function () use ($request, &$archivosGuardados) {
                $producto = new Producto();
                $producto->nombre = $request->nombre;
                $producto->descripcion = $request->descripcion;
                $producto->modelo = $request->modelo;
                $producto->categoria_productos_id = $request->categoria_id;
                $producto->marca_id = $request->marca_id;
                $producto->unidad_id = $request->unidad_id;
                $producto->moneda_id = $request->moneda_id;
                $producto->tipo_afectacion_igv_id = $request->tipo_afectacion_igv_id;
                $producto->precio_unitario = $request->precio_unitario;
                $producto->costo_unitario = $request->costo_unitario;
                $producto->incluye_igv = $request->boolean('incluye_igv');
                $producto->incluye_isc = $request->boolean('incluye_isc');
                $producto->codigo_interno = $request->codigo_interno;
                $producto->codigo_barras = $request->codigo_barras;
                $producto->codigo_sunat = $request->codigo_sunat;
                $producto->codigo_fabricante = $request->codigo_fabricante;
                $producto->activo = $request->boolean('activo');
                if ($request->hasFile('imagen')) {
                    $rutaImagen = $request->file('imagen')->store('productos', 'public');
                    $archivosGuardados[] = $rutaImagen;
                    $producto->imagen = $rutaImagen;
                }
                $producto->save();
                $contenidoQr = implode("\n", [
                    'PRODUCTO',
                    'ID: ' . $producto->id,
                    'Nombre: ' . $producto->nombre,
                    'Código interno: ' . ($producto->codigo_interno ?? 'N/A'),
                    'Código de barras: ' . ($producto->codigo_barras ?? 'N/A'),
                ]);
                $rutaQr = 'productos/qr/producto_' . $producto->id . '.svg';
                $imagenQr = QrCode::format('svg')->size(300)->margin(2)->generate($contenidoQr);
                Storage::disk('public')->put($rutaQr, $imagenQr);
                $archivosGuardados[] = $rutaQr;
                $producto->imagen_qr = $rutaQr;
                $producto->save();
                if (!empty($producto->codigo_barras)) {
                    $generador = new BarcodeGeneratorSVG();
                    $imagenBarras = $generador->getBarcode(
                        $producto->codigo_barras,
                        $generador::TYPE_CODE_128
                    );
                    $rutaBarras = 'productos/barras/producto_'. $producto->id . '.svg';
                    Storage::disk('public')->put($rutaBarras,$imagenBarras);
                    $archivosGuardados[] = $rutaBarras;
                }
                $inventario = new Inventario();
                $inventario->producto_id = $producto->id;
                $inventario->almacen_id = $request->almacen_id;
                $inventario->stock_inicial = $request->stock_inicial;
                $inventario->stock_actual = $request->stock_actual;
                $inventario->stock_minimo = $request->stock_minimo;
                $inventario->save();
            });
            return redirect()->back()->with( 'success','Producto registrado correctamente con su código QR y código de barras.');
        } catch (\Throwable $e) {
            foreach ($archivosGuardados as $archivo) {
                Storage::disk('public')->delete($archivo);
            }
            throw $e;
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $producto = Producto::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required|string|max:200',
            'descripcion' => 'nullable|string',
            'modelo' => 'nullable|string|max:150',
            'categoria_id' => 'required|exists:categoria_productos,id',
            'marca_id' => 'nullable|exists:marcas,id',
            'unidad_id' => 'nullable|exists:unidads,id',
            'moneda_id' => 'required|exists:monedas,id',
            'tipo_afectacion_igv_id' => 'nullable|exists:tipo_afectacion_igvs,id',
            'precio_unitario' => 'required|numeric|min:0',
            'costo_unitario' => 'nullable|numeric|min:0',
            'codigo_interno' => 'nullable|string|max:50|unique:productos,codigo_interno,' . $producto->id,
            'codigo_barras' => 'nullable|string|max:100|unique:productos,codigo_barras,' . $producto->id,
            'codigo_sunat' => 'nullable|string|max:20',
            'codigo_fabricante' => 'nullable|string|max:100',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'activo' => 'required|in:0,1',
            'incluye_igv' => 'nullable',
            'incluye_isc' => 'nullable',
            'almacen_id' => 'required|exists:almacens,id',
            'stock_inicial' => 'required|numeric|min:0',
            'stock_actual' => 'required|numeric|min:0',
            'stock_minimo' => 'required|numeric|min:0',
        ]);
        $archivosGuardados = [];
        try {
            DB::transaction(function () use ($request, $producto, $validated, &$archivosGuardados) {
                $producto->nombre = $validated['nombre'];
                $producto->descripcion = $validated['descripcion'] ?? null;
                $producto->modelo = $validated['modelo'] ?? null;
                $producto->categoria_productos_id = $validated['categoria_id'];
                $producto->marca_id = $validated['marca_id'] ?? null;
                $producto->unidad_id = $validated['unidad_id'] ?? null;
                $producto->moneda_id = $validated['moneda_id'];
                $producto->tipo_afectacion_igv_id = $validated['tipo_afectacion_igv_id'] ?? null;
                $producto->precio_unitario = $validated['precio_unitario'];
                $producto->costo_unitario = $validated['costo_unitario'] ?? null;
                $producto->incluye_igv = $request->boolean('incluye_igv');
                $producto->incluye_isc = $request->boolean('incluye_isc');
                $producto->codigo_interno = $validated['codigo_interno'] ?? null;
                $producto->codigo_barras = $validated['codigo_barras'] ?? null;
                $producto->codigo_sunat = $validated['codigo_sunat'] ?? null;
                $producto->codigo_fabricante = $validated['codigo_fabricante'] ?? null;
                $producto->activo = (int) $validated['activo'];
                if ($request->hasFile('imagen')) {
                    if ($producto->imagen) {
                        Storage::disk('public')->delete($producto->imagen);
                    }
                    $rutaImagen = $request->file('imagen')->store('productos', 'public');
                    $archivosGuardados[] = $rutaImagen;
                    $producto->imagen = $rutaImagen;
                }
                $producto->save();
                $contenidoQr = implode("\n", [
                    'PRODUCTO',
                    'ID: ' . $producto->id,
                    'Nombre: ' . $producto->nombre,
                    'Código interno: ' . ($producto->codigo_interno ?? 'N/A'),
                    'Código de barras: ' . ($producto->codigo_barras ?? 'N/A'),
                ]);
                $rutaQr = 'productos/qr/producto_' . $producto->id . '.svg';
                $imagenQr = QrCode::format('svg')->size(300)->margin(2)->generate($contenidoQr);
                Storage::disk('public')->put($rutaQr, $imagenQr);
                $producto->imagen_qr = $rutaQr;
                $producto->save();
                $rutaBarras = 'productos/barras/producto_' . $producto->id . '.svg';
                if (!empty($producto->codigo_barras)) {
                    $generador = new BarcodeGeneratorSVG();
                    $imagenBarras = $generador->getBarcode(
                        $producto->codigo_barras,
                        $generador::TYPE_CODE_128
                    );
                    Storage::disk('public')->put($rutaBarras, $imagenBarras);
                } else {
                    Storage::disk('public')->delete($rutaBarras);
                }
                $inventario = Inventario::where('producto_id', $producto->id)->first();
                if (!$inventario) {
                    $inventario = new Inventario();
                    $inventario->producto_id = $producto->id;
                }
                $inventario->almacen_id = $validated['almacen_id'];
                $inventario->stock_inicial = $validated['stock_inicial'];
                $inventario->stock_actual = $validated['stock_actual'];
                $inventario->stock_minimo = $validated['stock_minimo'];
                $inventario->save();
            });
            return redirect()->route('producto')->with('success', 'Producto actualizado correctamente.');
        } catch (\Throwable $e) {
            foreach ($archivosGuardados as $archivo) {
                Storage::disk('public')->delete($archivo);
            }
            throw $e;
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $producto = Producto::findOrFail($id);
            DB::transaction(function () use ($producto) {
                Inventario::where('producto_id', $producto->id)->delete();
                if ($producto->imagen) {
                    Storage::disk('public')->delete($producto->imagen);
                }
                if ($producto->imagen_qr) {
                    Storage::disk('public')->delete($producto->imagen_qr);
                }
                $rutaBarras = 'productos/barras/producto_' . $producto->id . '.svg';
                Storage::disk('public')->delete($rutaBarras);
                $producto->delete();
            });
            return redirect()->route('producto')->with('success', 'Producto eliminado correctamente con sus imágenes y códigos.');
        } catch (\Throwable $e) {

            return redirect()->route('producto')->with('error', 'Error al eliminar el producto: ' . $e->getMessage());
        }
    }
}
