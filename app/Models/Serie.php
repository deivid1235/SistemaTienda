<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
}
