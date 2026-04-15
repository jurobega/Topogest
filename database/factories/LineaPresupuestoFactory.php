<?php

namespace Database\Factories;

use App\Models\LineaPresupuesto;
use App\Models\Presupuesto;
use Illuminate\Database\Eloquent\Factories\Factory;

class LineaPresupuestoFactory extends Factory
{
    protected $model = LineaPresupuesto::class;

    public function definition(): array
    {
        $cantidad = fake()->randomFloat(2, 1, 10);
        $precio = fake()->randomFloat(2, 50, 900);
        $subtotal = $cantidad * $precio;

        return [
            'presupuesto_id' => Presupuesto::query()->inRandomOrder()->value('id') ?? Presupuesto::factory(),
            'concepto' => fake()->randomElement([
                'Levantamiento topográfico',
                'Deslinde de finca',
                'Generación de GML',
                'Replanteo de obra',
                'Informe técnico',
                'Medición de parcela',
            ]),
            'descripcion' => fake()->optional(70)->sentence(),
            'cantidad' => $cantidad,
            'precio_unitario' => $precio,
            'subtotal' => round($subtotal, 2),
            'orden' => fake()->numberBetween(1, 10),
        ];
    }
}