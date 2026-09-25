<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function tipoCliente()
    {
        return $this->belongsTo(TipoCliente::class);
    }

    public function sucursals()
    {
        return $this->hasMany(Sucursal::class);
    }

   
}
