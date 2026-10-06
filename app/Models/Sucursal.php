<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function series()
    {
        return $this->hasMany(Serie::class);
    }
    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }
}
