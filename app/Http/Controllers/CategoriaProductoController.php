<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoriaProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = CategoriaProducto::orderBy('nombre')->get();
        return view('admin.categoriaproducto.index', compact('categorias'));
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
        $validated = $request->validate([
            'categoria_padre_id' => ['nullable','integer','exists:categoria_productos,id'],
            'nombre' => ['required', 'string', 'max:100'],
            'slug' => ['nullable', 'string', 'max:120'],
            'descripcion' => ['nullable', 'string'],
            'imagen' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048',],
            'estado' => ['required', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ]);
        $slug = Str::slug(!empty($validated['slug'])? $validated['slug']: $validated['nombre']);
        $request->validate([
            'slug' => ['nullable',
                function ($attribute, $value, $fail) use ($slug) {
                    if (CategoriaProducto::where('slug', $slug)->exists()) {
                        $fail('Este slug ya está registrado. Ingresa otro.');
                    }
                },
            ],
        ]);

        $imagen = null;
        if ($request->hasFile('imagen')) {$imagen = $request->file('imagen')->store('categorias', 'public');}
        $categoria = new CategoriaProducto();
        $categoria->categoria_padre_id = $validated['categoria_padre_id'] ?? null;
        $categoria->nombre = $validated['nombre'];
        $categoria->slug = $slug;
        $categoria->descripcion = $validated['descripcion'] ?? null;
        $categoria->imagen = $imagen;
        $categoria->estado = $validated['estado'];
        $categoria->orden = $validated['orden'] ?? 0;
        $categoria->save();
        return redirect()
            ->route('categoriaproducto')
            ->with('success', 'Categoría registrada correctamente.');
    }
    /**
     * Display the specified resource.
     */
    public function show(CategoriaProducto $categoriaProducto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoriaProducto $categoriaProducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categoriaProducto = CategoriaProducto::findOrFail($id);
        $request->validate([
            'nombre' => 'required|string|max:100',
            'slug' => 'required|string|max:120|unique:categoria_productos,slug,' . $categoriaProducto->id,
            'categoria_padre_id' => 'nullable|exists:categoria_productos,id',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
            'orden' => 'required|integer|min:0',
            'estado' => 'required|boolean',
        ]);
        if ($request->categoria_padre_id == $categoriaProducto->id) {
            return back()
                ->withErrors(['categoria_padre_id' => 'Una categoría no puede ser su propia categoría padre.'])
                ->withInput();
        }

        $categoriaProducto->nombre = $request->nombre;
        $categoriaProducto->slug = $request->slug;
        $categoriaProducto->categoria_padre_id = $request->categoria_padre_id;
        $categoriaProducto->descripcion = $request->descripcion;
        $categoriaProducto->orden = $request->orden;
        $categoriaProducto->estado = $request->estado;
        if ($request->hasFile('imagen')) {
            if ($categoriaProducto->imagen && \Illuminate\Support\Facades\Storage::disk('public')->exists($categoriaProducto->imagen)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($categoriaProducto->imagen);
            }
            $categoriaProducto->imagen = $request->file('imagen')->store('categorias', 'public');
        }
        $categoriaProducto->save();
        return redirect()
            ->route('categoriaproducto')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    
    public function destroy( string $id)
    {
        $categoriaProducto = CategoriaProducto::findOrFail($id);

        // Eliminar la imagen de la categoría si existe
        if ($categoriaProducto->imagen && Storage::disk('public')->exists($categoriaProducto->imagen)) {
            Storage::disk('public')->delete($categoriaProducto->imagen);
        }

        // Eliminar la categoría de la base de datos
        $categoriaProducto->delete();

        return redirect()->route('categoria')
            ->with('success', 'Categoría eliminada correctamente.');
    }

}
