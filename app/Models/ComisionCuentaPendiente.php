<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComisionCuentaPendiente extends Model
{
    protected $table = 'comision_cuentas_pendientes';

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
