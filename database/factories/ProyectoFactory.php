<?php

namespace Database\Factories;

use App\Models\PerfilCliente;
use App\Models\PerfilEmpresa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proyecto>
 */
class ProyectoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'empresa_id'               => PerfilEmpresa::inRandomOrder()->first()->id,
            'cliente_id'               => PerfilCliente::inRandomOrder()->first()->id,
            'solicitud_id'             => null,
            'tipo'                     => 'interno',
            'nombre'                   => $this->faker->sentence(4),
            'descripcion'              => $this->faker->paragraph(),
            'estado'                   => $this->faker->randomElement([
                'borrador', 'pendiente_aceptacion', 'activo', 'entregado', 'cerrado'
            ]),
            'cliente_externo_nombre'   => null,
            'cliente_externo_telefono' => null,
            'cliente_externo_email'    => null,
            'fecha_inicio'             => $this->faker->dateTimeBetween('-3 months', 'now'),
            'fecha_fin_prevista'       => $this->faker->dateTimeBetween('now', '+3 months'),
        ];
    }
}
