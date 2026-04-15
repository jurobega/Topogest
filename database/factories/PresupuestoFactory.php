<?php

namespace Database\Factories;

use App\Models\Presupuesto;
use App\Models\Proyecto;
use Illuminate\Database\Eloquent\Factories\Factory;

class PresupuestoFactory extends Factory
{
    protected $model = Presupuesto::class;

    public function definition(): array
    {
        $base = fake()->randomFloat(2, 150, 3000);
        $iva = 21.00;
        $total = $base + ($base * $iva / 100);

        $fechaEmision = fake()->dateTimeBetween('-2 months', 'now');
        $fechaCaducidad = fake()->optional(80)->dateTimeBetween($fechaEmision, '+1 month');

        return [
            'proyecto_id' => Proyecto::query()->inRandomOrder()->value('id') ?? Proyecto::factory(),
            'numero' => 'P-' . fake()->unique()->numberBetween(1000, 9999),
            'estado' => fake()->randomElement(['borrador', 'enviado', 'aceptado', 'rechazado', 'caducado']),
            'fecha_emision' => $fechaEmision,
            'fecha_caducidad' => $fechaCaducidad,
            'base_imponible' => $base,
            'iva_porcentaje' => $iva,
            'total' => round($total, 2),
            'pdf_path' => fake()->boolean(70) ? 'presupuestos/' . fake()->uuid() . '.pdf' : null,
            'notas' => fake()->optional(60)->sentence(),
        ];
    }
}