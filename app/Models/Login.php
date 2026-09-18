<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public function compania()
    {
        return $this->belongsTo(Compania::class);
    }
}
