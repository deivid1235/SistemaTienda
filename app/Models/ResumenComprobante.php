<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResumenComprobante extends Model
{
    protected $table = 'resumen_comprobantes';

    protected $fillable = [
        'fecha_emision',
        'fecha_referencia',
        'identificador',
        'estado',
        'ticket',
        'cantidad_comprobantes',
        'total',
        'user_id',
    ];

    protected $casts = [
        'fecha_emision'    => 'date',
        'fecha_referencia' => 'date',
        'total'            => 'decimal:2',
    ];

    public function comprobantes(): HasMany
    {
        return $this->hasMany(Comprobante::class, 'resumen_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
