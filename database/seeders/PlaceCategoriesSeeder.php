<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaceCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Hoteles',
                'description' => 'Establecimientos de alojamiento de corta estancia con servicios variados.',
            ],
            [
                'name' => 'Restaurantes',
                'description' => 'Lugares donde se sirven comidas y bebidas a los visitantes.',
            ],
            [
                'name' => 'Alojamientos',
                'description' => 'Opciones de hospedaje alternativas como hostales, cabañas o apartamentos.',
            ],
        ];

        foreach ($categories as $category) {
            DB::table('place_categories')->updateOrInsert(
                ['name' => $category['name']], // busca por nombre
                [
                    'description' => $category['description'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
