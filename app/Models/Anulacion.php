<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anulacion extends Model
{
    protected $table = 'anulacions';

    protected $fillable = [
        'fecha_emision',
        'fecha_comprobante',
        'identificador',
        'estado',
        'ticket',
        'motivo',
        'cantidad_comprobantes',
        'user_id',
    ];

    protected $casts = [
        'fecha_emision'     => 'date',
        'fecha_comprobante' => 'date',
    ];

    public function comprobantes(): HasMany
    {
        return $this->hasMany(Comprobante::class, 'anulacion_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
