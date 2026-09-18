<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compania extends Model
{
    public function login()
    {
        return $this->hasOne(Login::class);
    }
}
