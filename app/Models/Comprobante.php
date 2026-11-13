<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comprobante extends Model
{
    protected $fillable = [
        'entorno',
        'user_id',
        'fecha_emision',
        'cliente_nombre',
        'cliente_documento',
        'tipo_comprobante',
        'serie',
        'numero',
        'total',
        'estado_envio',
        'resumen_id',
        'anulacion_id',
        'fecha_envio',
        'mensaje_sunat',
    ];

    protected $casts = [
        'fecha_emision' => 'date',
        'fecha_envio'   => 'datetime',
        'total'         => 'decimal:2',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function resumen(): BelongsTo
    {
        return $this->belongsTo(ResumenComprobante::class, 'resumen_id');
    }

    public function anulacion(): BelongsTo
    {
        return $this->belongsTo(Anulacion::class, 'anulacion_id');
    }

    public function getTipoNombreAttribute(): string
    {
        return match ($this->tipo_comprobante) {
            '01' => 'FACTURA ELECTRÓNICA',
            '03' => 'BOLETA DE VENTA ELECTRÓNICA',
            '07' => 'NOTA DE CRÉDITO ELECTRÓNICA',
            '08' => 'NOTA DE DÉBITO ELECTRÓNICA',
            default => 'COMPROBANTE',
        };
    }

    public function getNumeroCompletoAttribute(): string
    {
        return $this->serie . '-' . $this->numero;
    }

    // Facturas: 3 días. Boletas y demás: 7 días.
    public function getDiasRestantesAttribute(): int
    {
        $plazo  = $this->tipo_comprobante === '01' ? 3 : 7;
        $limite = $this->fecha_emision->copy()->addDays($plazo)->startOfDay();

        return (int) now()->startOfDay()->diffInDays($limite, false);
    }

    public function getPlazoVencidoAttribute(): bool
    {
        return $this->dias_restantes < 0;
    }
}
