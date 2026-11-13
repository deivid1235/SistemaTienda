<?php

namespace Database\Seeders;

use App\Models\Comprobante;
use App\Models\User;
use Illuminate\Database\Seeder;

class ComprobanteSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::first()?->id;

        $datos = [
            ['fecha' => '2026-03-01', 'numero' => 4],
            ['fecha' => '2026-01-27', 'numero' => 3],
            ['fecha' => '2026-01-27', 'numero' => 2],
            ['fecha' => '2026-01-27', 'numero' => 1],
        ];

        foreach ($datos as $d) {
            Comprobante::create([
                'entorno'           => 'Demo',
                'user_id'           => $userId,
                'fecha_emision'     => $d['fecha'],
                'cliente_nombre'    => 'IMAN BRUNO, DEIVID DAVID',
                'cliente_documento' => '60163615',
                'tipo_comprobante'  => '03',
                'serie'             => 'B001',
                'numero'            => $d['numero'],
                'total'             => 50.00,
                'estado_envio'      => 'pendiente',
            ]);
        }

        // Uno reciente para ver el badge verde "Quedan X días"
        Comprobante::create([
            'entorno'           => 'Demo',
            'user_id'           => $userId,
            'fecha_emision'     => now()->subDay()->toDateString(),
            'cliente_nombre'    => 'CLIENTE DE PRUEBA S.A.C.',
            'cliente_documento' => '20123456789',
            'tipo_comprobante'  => '01',
            'serie'             => 'F001',
            'numero'            => 1,
            'total'             => 118.00,
            'estado_envio'      => 'pendiente',
        ]);
    }
}
