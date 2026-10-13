<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{
    public function padre(): BelongsTo
    {
        return $this->belongsTo(
            CategoriaProducto::class,
            'categoria_padre_id'
        );
    }

    // Una categoría puede tener varias subcategorías
    public function subcategorias(): HasMany
    {
        return $this->hasMany(
            CategoriaProducto::class,
            'categoria_padre_id'
        );
    }
}
