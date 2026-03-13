<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PerfilEmpresa>
 */
class PerfilEmpresaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'             => User::factory(),
            'nombre_fiscal'       => $this->faker->company(),
            'nif_cif'             => strtoupper($this->faker->bothify('?########')),
            'descripcion'         => $this->faker->paragraph(),
            'provincia'           => $this->faker->randomElement([
                'Almería', 'Cádiz', 'Córdoba', 'Granada',
                'Huelva', 'Jaén', 'Málaga', 'Sevilla',
                'Madrid', 'Barcelona', 'Valencia', 'Zaragoza',
            ]),
            'telefono'            => $this->faker->numerify('6########'),
            'logo_path'           => null,
            'visible_directorio'  => true,
        ];
    }
}
