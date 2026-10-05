<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuentaContable extends Model
{
    protected $table = 'cuentas_contables';

    protected $fillable = [
        'venta_total_soles',
        'venta_igv_soles',
        'venta_subtotal_soles',
        'venta_total_dolares',
        'venta_igv_dolares',
        'venta_subtotal_dolares',
    ];
}
