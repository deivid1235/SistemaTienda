<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
        ]);

        $user = User::create([
            'name' => 'Grupoaosc IA',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
        ]);

        $user->assignRole('ADMINISTRADOR');
    }
}