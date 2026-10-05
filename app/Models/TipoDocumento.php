<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    public function series()
    {
        return $this->hasMany(Serie::class);
    }
}
