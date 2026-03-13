<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $servicios = [
            ['nombre' => 'Levantamiento topográfico', 'descripcion' => 'Medición y representación gráfica del terreno.'],
            ['nombre' => 'Replanteo', 'descripcion' => 'Materialización sobre el terreno de un proyecto.'],
            ['nombre' => 'Georreferenciación', 'descripcion' => 'Asignación de coordenadas reales a elementos cartográficos.'],
            ['nombre' => 'Deslinde y amojonamiento', 'descripcion' => 'Delimitación de lindes entre propiedades.'],
            ['nombre' => 'Topografía de obras', 'descripcion' => 'Control topográfico durante la ejecución de obras.'],
            ['nombre' => 'Elaboración de planos', 'descripcion' => 'Generación de planos topográficos y cartográficos.'],
            ['nombre' => 'Informe pericial topográfico', 'descripcion' => 'Documentación técnica para procedimientos legales.'],
            ['nombre' => 'Vuelo con drone', 'descripcion' => 'Captura aérea de datos topográficos mediante drones.'],
        ];

        foreach ($servicios as $servicio) {
            Servicio::create($servicio);
        }
    }
}
