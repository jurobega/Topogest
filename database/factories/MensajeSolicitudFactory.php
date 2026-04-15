<?php

namespace Database\Factories;

use App\Models\MensajeSolicitud;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MensajeSolicitudFactory extends Factory
{
    protected $model = MensajeSolicitud::class;

    public function definition(): array
    {
        return [
            'solicitud_id' => Solicitud::query()->inRandomOrder()->value('id') ?? Solicitud::factory(),
            'remitente_id' => User::query()->inRandomOrder()->value('id') ?? User::factory(),
            'mensaje' => fake()->paragraphs(fake()->numberBetween(1, 3), true),
            'leido' => fake()->boolean(70),
            'created_at' => fake()->dateTimeBetween('-2 months', 'now'),
        ];
    }
}