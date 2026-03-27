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
        'web'                 => $this->faker->domainName(),
        'anios_experiencia'   => $this->faker->numberBetween(1, 30),
        'zona_actuacion'      => $this->faker->randomElement([
            'Toda Andalucía',
            'Provincia de Almería y limítrofes',
            'Comunidad de Madrid',
            'Todo el territorio nacional',
            'Levante y Murcia',
            'Cataluña y Aragón',
        ]),
        'numero_proyectos'    => $this->faker->numberBetween(10, 500),
        'horario_atencion'    => $this->faker->randomElement([
            'Lunes a Viernes 8:00 - 18:00',
            'Lunes a Viernes 9:00 - 14:00 y 16:00 - 19:00',
            'Lunes a Sábado 8:00 - 20:00',
            'Lunes a Viernes 7:00 - 15:00',
        ]),
    ];
    }
}
