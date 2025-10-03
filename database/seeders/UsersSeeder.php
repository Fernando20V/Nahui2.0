<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario propietario (host)
        User::updateOrCreate(
            ['email' => 'propietario@example.com'],
            [
                'name' => 'Propietario',
                'password' => Hash::make('12345678'),
                'role' => 'host',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Usuario normal
        User::updateOrCreate(
            ['email' => 'usuario@example.com'],
            [
                'name' => 'Usuario Normal',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
