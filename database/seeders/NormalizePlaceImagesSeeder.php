<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Place;

class NormalizePlaceImagesSeeder extends Seeder
{
    public function run(): void
    {
        Place::all()->each(function($place) {
            if ($place->imagenes) {
                $place->imagenes = array_map(function($img) {
                    // Quita /public/ si existe
                    return str_replace('/public/', '', $img);
                }, $place->imagenes);
                $place->save();
            }
        });

        $this->command->info('Se han normalizado las rutas de imágenes de todos los lugares.');
    }
}
