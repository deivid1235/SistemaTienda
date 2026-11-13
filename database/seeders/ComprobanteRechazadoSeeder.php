<?php

namespace Database\Seeders;

use App\Models\Comprobante;
use App\Models\User;
use Illuminate\Database\Seeder;

class ComprobanteRechazadoSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::first()?->id;

        $datos = [
            [
                'tipo'    => '01',
                'serie'   => 'F001',
                'numero'  => 2,
                'cliente' => 'COMERCIAL EL SOL S.A.C.',
                'doc'     => '20456789123',
                'total'   => 236.00,
                'mensaje' => '2017 - El número de RUC del receptor no existe o no está activo.',
                'fecha'   => now()->subDays(2)->toDateString(),
            ],
            [
                'tipo'    => '01',
                'serie'   => 'F001',
                'numero'  => 3,
                'cliente' => 'INVERSIONES PIURA E.I.R.L.',
                'doc'     => '20512345678',
                'total'   => 590.00,
                'mensaje' => '3030 - El comprobante fue registrado previamente con otros datos.',
                'fecha'   => now()->subDay()->toDateString(),
            ],
            [
                'tipo'    => '03',
                'serie'   => 'B001',
                'numero'  => 5,
                'cliente' => 'IMAN BRUNO, DEIVID DAVID',
                'doc'     => '60163615',
                'total'   => 45.50,
                'mensaje' => '2800 - El importe total no coincide con la suma de los ítems.',
                'fecha'   => now()->toDateString(),
            ],
        ];

        foreach ($datos as $d) {
            Comprobante::create([
                'entorno'           => 'Demo',
                'user_id'           => $userId,
                'fecha_emision'     => $d['fecha'],
                'cliente_nombre'    => $d['cliente'],
                'cliente_documento' => $d['doc'],
                'tipo_comprobante'  => $d['tipo'],
                'serie'             => $d['serie'],
                'numero'            => $d['numero'],
                'total'             => $d['total'],
                'estado_envio'      => 'rechazado',
                'mensaje_sunat'     => $d['mensaje'],
            ]);
        }
    }
}
