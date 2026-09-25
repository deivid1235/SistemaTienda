<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function tipoCliente()
    {
        return $this->belongsTo(TipoCliente::class);
    }
}
