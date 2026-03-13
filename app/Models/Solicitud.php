<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    /** @use HasFactory<\Database\Factories\SolicitudFactory> */
    use HasFactory;



      protected $table = 'solicitudes';

    protected $fillable = [
        'cliente_id',
        'empresa_id',
        'servicio_id',
        'asunto',
        'descripcion',
        'estado',
    ];

    public function cliente()
    {
        return $this->belongsTo(PerfilCliente::class, 'cliente_id');
    }

    public function empresa()
    {
        return $this->belongsTo(PerfilEmpresa::class, 'empresa_id');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }

    public function documentos()
    {
        return $this->hasMany(DocumentoSolicitud::class, 'solicitud_id');
    }

    public function mensajes()
    {
        return $this->hasMany(MensajeSolicitud::class, 'solicitud_id');
    }

    public function proyecto()
    {
        return $this->hasOne(Proyecto::class, 'solicitud_id');
    }
}
