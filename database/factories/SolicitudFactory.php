<?php

namespace Database\Factories;

use App\Models\PerfilCliente;
use App\Models\PerfilEmpresa;
use App\Models\Servicio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Solicitud>
 */
class SolicitudFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
              'cliente_id'  => PerfilCliente::inRandomOrder()->first()->id,
            'empresa_id'  => PerfilEmpresa::inRandomOrder()->first()->id,
            'servicio_id' => Servicio::inRandomOrder()->first()->id,
            'asunto'      => $this->faker->sentence(6),
            'descripcion' => $this->faker->paragraph(),
            'estado'      => $this->faker->randomElement([
                'pendiente', 'vista', 'en_negociacion', 'convertida', 'rechazada'
            ]),
        ];
    }
}
