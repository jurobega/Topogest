<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MensajeSolicitud extends Model
{
    /** @use HasFactory<\Database\Factories\MensajeSolicitudFactory> */
    use HasFactory;

    protected $table = 'mensajes_solicitud';

    public $timestamps = false;

    protected $fillable = [
        'solicitud_id',
        'remitente_id',
        'mensaje',
        'leido',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitud_id');
    }

    public function remitente()
    {
        return $this->belongsTo(User::class, 'remitente_id');
    }
}
