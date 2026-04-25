<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    /** @use HasFactory<\Database\Factories\ProyectoFactory> */
    use HasFactory;

    protected $table = 'proyectos';

    protected $fillable = [
        'empresa_id',
        'cliente_id',
        'solicitud_id',
        'tipo',
        'nombre',
        'descripcion',
        'estado',
        'cliente_externo_nombre',
        'cliente_externo_telefono',
        'cliente_externo_email',
        'fecha_inicio',
        'fecha_fin_prevista',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin_prevista' => 'date',
    ];

    public function empresa()
    {
        return $this->belongsTo(PerfilEmpresa::class, 'empresa_id');
    }

    public function cliente()
    {
        return $this->belongsTo(PerfilCliente::class, 'cliente_id');
    }

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitud_id');
    }

    public function documentos()
    {
        return $this->hasMany(DocumentoProyecto::class, 'proyecto_id');
    }

    public function entregables()
    {
        return $this->hasMany(DocumentoProyecto::class, 'proyecto_id')->where('tipo', 'entregable');
    }

    public function presupuestos()
    {
        return $this->hasMany(Presupuesto::class, 'proyecto_id');
    }

    public function esExterno(): bool
    {
        return $this->tipo === 'externo';
    }

    public function esInterno(): bool
    {
        return $this->tipo === 'interno';
    }

    public function mensajes()
    {
        return $this->hasMany(MensajeProyecto::class);
    }
}
