<?php

namespace Database\Factories;

use App\Models\PerfilCliente;
use App\Models\PerfilEmpresa;
use App\Models\Proyecto;
use App\Models\Solicitud;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProyectoFactory extends Factory
{
    protected $model = Proyecto::class;

    public function definition(): array
    {
        $estado = fake()->randomElement([
            'borrador',
            'pendiente_aceptacion',
            'activo',
            'entregado',
            'cerrado',
            'rechazado',
        ]);

        $fechaInicio = fake()->optional(85)->dateTimeBetween('-4 months', 'now');
        $fechaFinPrevista = $fechaInicio
            ? fake()->optional(80)->dateTimeBetween($fechaInicio, '+3 months')
            : null;

        return [
            'empresa_id' => PerfilEmpresa::query()->inRandomOrder()->value('id') ?? PerfilEmpresa::factory(),
            'cliente_id' => PerfilCliente::query()->inRandomOrder()->value('id') ?? PerfilCliente::factory(),
            'solicitud_id' => fake()->boolean(65)
                ? Solicitud::query()->inRandomOrder()->value('id')
                : null,
            'tipo' => fake()->randomElement(['interno', 'externo']),
            'nombre' => fake()->randomElement([
                'Deslinde parcela rústica',
                'Levantamiento topográfico',
                'GML catastral',
                'Segregación de finca',
                'Replanteo de obra',
                'Medición de linderos',
                'Georreferenciación de parcela',
                'Actualización cartográfica',
            ]) . ' ' . fake()->numberBetween(1, 99),
            'descripcion' => fake()->paragraphs(fake()->numberBetween(1, 3), true),
            'estado' => $estado,
            'cliente_externo_nombre' => fake()->boolean(20) ? fake()->name() : null,
            'cliente_externo_telefono' => fake()->boolean(20) ? fake()->numerify('6########') : null,
            'cliente_externo_email' => fake()->boolean(20) ? fake()->safeEmail() : null,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin_prevista' => $fechaFinPrevista,
            'created_at' => fake()->dateTimeBetween('-5 months', 'now'),
            'updated_at' => fake()->dateTimeBetween('-2 months', 'now'),
        ];
    }
}