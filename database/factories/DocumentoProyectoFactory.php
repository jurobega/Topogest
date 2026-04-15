<?php

namespace Database\Factories;

use App\Models\DocumentoProyecto;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentoProyectoFactory extends Factory
{
    protected $model = DocumentoProyecto::class;

    public function definition(): array
    {
        $tipo = fake()->randomElement(['documento', 'entregable', 'otro']);

        $extensiones = match ($tipo) {
            'entregable' => ['pdf', 'zip', 'gml', 'dxf'],
            'documento' => ['pdf', 'docx', 'xlsx'],
            default => ['pdf', 'jpg', 'png', 'txt'],
        };

        $extension = fake()->randomElement($extensiones);

        $mimeType = match ($extension) {
            'pdf' => 'application/pdf',
            'zip' => 'application/zip',
            'gml' => 'application/xml',
            'dxf' => 'application/dxf',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'txt' => 'text/plain',
            default => 'application/octet-stream',
        };

        return [
            'proyecto_id' => Proyecto::query()->inRandomOrder()->value('id') ?? Proyecto::factory(),
            'subido_por' => User::query()->inRandomOrder()->value('id') ?? User::factory(),
            'nombre_archivo' => fake()->slug() . '.' . $extension,
            'path' => 'documentos/proyectos/' . fake()->uuid() . '.' . $extension,
            'tipo' => $tipo,
            'mime_type' => $mimeType,
            'size_bytes' => fake()->numberBetween(50_000, 8_000_000),
        ];
    }
}