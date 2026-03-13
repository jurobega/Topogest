<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoSolicitud extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentoSolicitudFactory> */
    use HasFactory;

     protected $table = 'documentos_solicitud';

    protected $fillable = [
        'solicitud_id',
        'nombre_archivo',
        'path',
        'mime_type',
        'size_bytes',
    ];

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitud_id');
    }
}
