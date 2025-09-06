<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicacionesSeeder extends Seeder
{
    public function run()
    {
        $ubicaciones = [
            "Suba" => ["Lisboa", "La Campiña", "Niza", "Suba Rincón"],
            "Kennedy" => ["Timiza", "Patio Bonito", "Kennedy Central", "El Amparo"],
            "Engativá" => ["Villa Luz", "Boyacá Real", "Normandía", "La Estrada"],
            "Chapinero" => ["Rosales", "Chicó", "El Refugio", "La Cabrera"],
            "Bosa" => ["La Libertad", "San Bernardino", "Bosa Centro", "Bosa Laureles"],
            "Fontibón" => ["Modelia", "Versalles", "Fontibón Centro", "Capellanía"],
            "Usaquén" => ["Santa Ana", "Cedritos", "Santa Bibiana", "La Calleja"],
            "Ciudad Bolívar" => ["Lucero", "Meissen", "El Paraíso", "Perdomo"],
            "San Cristóbal" => ["Altamira", "20 de Julio", "San Blas", "Villa del Cerro"],
            "Rafael Uribe Uribe" => ["Quiroga", "Molinos", "Bravo Páez", "Olaya"],
            "Tunjuelito" => ["Venecia", "San Vicente", "El Carmen", "Fátima"],
            "Usme" => ["Diana Turbay", "Santa Librada", "El Tuno", "La Fiscala"],
            "Barrios Unidos" => ["Doce de Octubre", "Simón Bolívar", "Benjamín Herrera"],
            "Teusaquillo" => ["La Soledad", "Teusaquillo", "Palermo", "El Recuerdo"],
            "Antonio Nariño" => ["Restrepo", "Ciudad Berna", "Fátima", "Santander"],
            "Los Mártires" => ["La Favorita", "Samper Mendoza", "Santa Fe", "La Estanzuela"],
            "Puente Aranda" => ["Industrial Centenario", "Pablo VI", "Zona Industrial"],
            "Santa Fe" => ["Las Aguas", "La Macarena", "Egipto", "Belén"],
            "La Candelaria" => ["El Rosario", "La Catedral", "Las Nieves"],
            "Sumapaz" => ["Nazareth", "San Juan", "La Unión"],
        ];

        foreach ($ubicaciones as $localidad => $barrios) {
            foreach ($barrios as $barrio) {
                DB::table('ubicacions')->insert([
                    'localidad' => $localidad,
                    'barrio' => $barrio,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

