<?php

namespace Database\Factories;

use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MensajeProyecto>
 */
class MensajeProyectoFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'proyecto_id' => Proyecto::inRandomOrder()->first()->id,
            'remitente_id' => User::inRandomOrder()->first()->id,
            'mensaje' => fake()->sentence(rand(5, 20)),
            'leido' => fake()->boolean(70), // 70% de probabilidad de leído
            'created_at' => fake()->dateTimeBetween('-2 months', 'now'),
        ];
    }
}
