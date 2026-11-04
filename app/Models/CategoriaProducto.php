<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{
    public function padre(): BelongsTo
    {
        return $this->belongsTo( CategoriaProducto::class,'categoria_padre_id');
    }

    public function subcategorias(): HasMany
    {
        return $this->hasMany(CategoriaProducto::class,'categoria_padre_id');
    }
}
