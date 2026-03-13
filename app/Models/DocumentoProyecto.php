<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoProyecto extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentoProyectoFactory> */
    use HasFactory;

     protected $table = 'documentos_proyecto';

    protected $fillable = [
        'proyecto_id',
        'subido_por',
        'nombre_archivo',
        'path',
        'tipo',
        'mime_type',
        'size_bytes',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    public function subidoPor()
    {
        return $this->belongsTo(User::class, 'subido_por');
    }
}
