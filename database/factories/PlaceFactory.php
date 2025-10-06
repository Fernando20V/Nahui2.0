<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    protected $model = \App\Models\Place::class;

    public function definition()
    {
        // 20 lugares turísticos del norte de Nicaragua
        $placesData = [
            ['name' => 'Volcán San Cristóbal', 'lat' => 13.4636, 'lng' => -86.6169, 'description' => 'El volcán activo más alto de Nicaragua, con senderos para turistas y vistas impresionantes.', 'images' => ['lugares/volcan san cristobal.jfif'], 'place_category_id' => 3],
            ['name' => 'Reserva Natural Apanas', 'lat' => 13.3724, 'lng' => -86.5767, 'description' => 'Área protegida con lagos, senderos y biodiversidad típica de la región.', 'images' => ['lugares/reserva apanas.jfif'], 'place_category_id' => 3],
            ['name' => 'Cerro Mogotón', 'lat' => 13.4333, 'lng' => -86.3833, 'description' => 'Punto más alto de Nicaragua, frontera con Honduras, ideal para caminatas y observación.', 'images' => ['lugares/cerro mogoton.jfif'], 'place_category_id' => 3],
            ['name' => 'Catedral de Estelí', 'lat' => 13.0900, 'lng' => -86.3583, 'description' => 'Catedral histórica en el centro de Estelí.', 'images' => ['lugares/catedral esteli.jfif'], 'place_category_id' => 2],
            ['name' => 'Museo de Arte Fundación Ortiz-Gurdián', 'lat' => 13.0908, 'lng' => -86.3556, 'description' => 'Museo con exposiciones de arte nicaragüense e internacional.', 'images' => ['lugares/museo esteli.jfif'], 'place_category_id' => 2],
            ['name' => 'Volcán Telica', 'lat' => 12.8983, 'lng' => -86.8500, 'description' => 'Volcán con actividad frecuente y tours de senderismo nocturno.', 'images' => ['lugares/volcan telica.jfif'], 'place_category_id' => 3],
            ['name' => 'Parque Central de León', 'lat' => 12.4373, 'lng' => -86.8787, 'description' => 'Plaza central rodeada de arquitectura colonial.', 'images' => ['lugares/parque leon.jfif'], 'place_category_id' => 2],
            ['name' => 'Catedral de León', 'lat' => 12.4377, 'lng' => -86.8801, 'description' => 'Una de las catedrales más grandes de Centroamérica.', 'images' => ['lugares/catedral leon.jfif'], 'place_category_id' => 2],
            ['name' => 'Reserva Natural Cerro Apante', 'lat' => 13.4333, 'lng' => -86.4667, 'description' => 'Ideal para senderismo y observación de flora y fauna.', 'images' => ['lugares/cerro apante.jfif'], 'place_category_id' => 3],
            ['name' => 'Laguna de Apoyo', 'lat' => 12.1500, 'lng' => -86.3000, 'description' => 'Laguna volcánica con aguas cristalinas y deportes acuáticos.', 'images' => ['lugares/laguna apoyo.jfif'], 'place_category_id' => 3],
            ['name' => 'Reserva Natural Cerro Mogotón', 'lat' => 13.4333, 'lng' => -86.3833, 'description' => 'Área protegida en la frontera con Honduras.', 'images' => ['lugares/cerro mogoton.jfif'], 'place_category_id' => 3],
            ['name' => 'Museo Regional de Estelí', 'lat' => 13.0950, 'lng' => -86.3570, 'description' => 'Museo con historia y cultura local de Estelí.', 'images' => ['lugares/museo regional esteli.jfif'], 'place_category_id' => 2],
            ['name' => 'Reserva Natural Cerro Musún', 'lat' => 13.6000, 'lng' => -86.4000, 'description' => 'Senderos y paisajes naturales en la zona norte.', 'images' => ['lugares/cerro musuln.jfif'], 'place_category_id' => 3],
            ['name' => 'Volcán Cosigüina', 'lat' => 13.7400, 'lng' => -87.0200, 'description' => 'Volcán con cráter grande y vistas panorámicas del Golfo de Fonseca.', 'images' => ['lugares/volcan cosiguina.jfif'], 'place_category_id' => 3],
            ['name' => 'Parque Central de Matagalpa', 'lat' => 12.9200, 'lng' => -86.2600, 'description' => 'Plaza central con actividades culturales y comerciales.', 'images' => ['lugares/parque matagalpa.jfif'], 'place_category_id' => 2],
            ['name' => 'Reserva Natural Cerro Apante', 'lat' => 13.4300, 'lng' => -86.4500, 'description' => 'Zona protegida con fauna y flora diversa.', 'images' => ['lugares/cerro apante.jfif'], 'place_category_id' => 3],
            ['name' => 'Volcán Momotombo', 'lat' => 12.4350, 'lng' => -86.8370, 'description' => 'Volcán icónico cerca de León, popular para excursionistas.', 'images' => ['lugares/volcan momotombo.jfif'], 'place_category_id' => 3],
            ['name' => 'Parque Nacional Cerro Negro', 'lat' => 12.5533, 'lng' => -87.0850, 'description' => 'Volcán para practicar sandboarding y senderismo.', 'images' => ['lugares/cerro negro.jfif'], 'place_category_id' => 3],
            ['name' => 'Balneario Las Brisas', 'lat' => 13.1000, 'lng' => -86.3800, 'description' => 'Balneario popular cerca de Estelí.', 'images' => ['lugares/balneario brisas.jfif'], 'place_category_id' => 1],
            ['name' => 'Parque Central de Jinotega', 'lat' => 13.0890, 'lng' => -86.0660, 'description' => 'Centro histórico y cultural de Jinotega.', 'images' => ['lugares/parque jinotega.jfif'], 'place_category_id' => 2],
        ];

        $place = $this->faker->randomElement($placesData);

        return [
            'name' => $place['name'],
            'place_category_id' => $place['place_category_id'] ?? null,
            'imagenes' => $place['images'],
            'latitude' => $place['lat'],
            'longitude' => $place['lng'],
            'description' => $place['description'],
            'servicios' => $this->faker->sentence,
            'habitaciones' => $this->faker->numberBetween(1, 50),
            'capacidad' => $this->faker->numberBetween(10, 200),
            'reglas' => $this->faker->sentence,
            'promocion' => $this->faker->sentence,
            'address_id' => null,
            'is_public' => true,
            'is_managed' => false,
            'managing_org_id' => null,
            'hours' => null,
            'accessibility_notes' => $this->faker->sentence,
            'entrance_fee' => $this->faker->randomFloat(2, 0, 100),
            'currency' => 'USD',
        ];
    }
}
