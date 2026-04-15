<?php

namespace Database\Factories;

use App\Models\DocumentoSolicitud;
use App\Models\Solicitud;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentoSolicitudFactory extends Factory
{
    protected $model = DocumentoSolicitud::class;

    public function definition(): array
    {
        $extension = fake()->randomElement(['pdf', 'jpg', 'png', 'gml', 'zip']);

        $mimeType = match ($extension) {
            'pdf' => 'application/pdf',
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gml' => 'application/xml',
            'zip' => 'application/zip',
            default => 'application/octet-stream',
        };

        return [
            'solicitud_id' => Solicitud::query()->inRandomOrder()->value('id') ?? Solicitud::factory(),
            'nombre_archivo' => fake()->slug() . '.' . $extension,
            'path' => 'documentos/solicitudes/' . fake()->uuid() . '.' . $extension,
            'mime_type' => $mimeType,
            'size_bytes' => fake()->numberBetween(30_000, 5_000_000),
        ];
    }
}