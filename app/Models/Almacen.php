<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Almacen extends Model
{
   
    public function sucursal(): BelongsTo
    {
        return $this->belongsTo(Sucursal::class);
    }

   
    public function serie(): BelongsTo
    {
        return $this->belongsTo(Serie::class);
    }

   
    public function responsable(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }
}
