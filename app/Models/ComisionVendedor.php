<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComisionVendedor extends Model
{
    protected $table = 'comision_vendedores';

    protected $fillable = [
        'user_id',
        'tipo',
        'valor',
    ];

    protected function casts(): array
    {
        return [
            'valor' => 'decimal:2',
        ];
    }

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
