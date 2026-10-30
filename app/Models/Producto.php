<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public function categoria()
    {
        return $this->belongsTo(CategoriaProducto::class);
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }

    public function moneda()
    {
        return $this->belongsTo(Moneda::class);
    }

    public function tipoAfectacionIgv()
    {
        return $this->belongsTo(TipoAfectacionIgv::class);
    }

    public function inventario(): HasMany
{
    return $this->hasMany(Inventario::class, 'producto_id');
}

}
