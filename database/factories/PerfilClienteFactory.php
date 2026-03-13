<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PerfilCliente>
 */
class PerfilClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'user_id'        => User::factory(),
            'nombre_completo' => $this->faker->name(),
            'nif_nie'        => strtoupper($this->faker->bothify('########?')),
            'telefono'       => $this->faker->numerify('6########'),
            'direccion'      => $this->faker->streetAddress(),
            'provincia'      => $this->faker->randomElement([
                'Almería', 'Cádiz', 'Córdoba', 'Granada',
                'Huelva', 'Jaén', 'Málaga', 'Sevilla',
                'Madrid', 'Barcelona', 'Valencia', 'Zaragoza',
            ]),
        ];
    }
}
