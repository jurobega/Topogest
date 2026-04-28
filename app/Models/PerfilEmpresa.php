<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilEmpresa extends Model
{
    /** @use HasFactory<\Database\Factories\PerfilEmpresaFactory> */
    use HasFactory;

    protected $table = 'perfiles_empresa';

    protected $fillable = [
        'nombre_fiscal',
        'nif_cif',
        'descripcion',
        'provincia',
        'telefono',
        'logo_path',
        'visible_directorio',
        'web',               
        'zona_actuacion',     
        'numero_proyectos',   
        'horario_atencion',   
        'anios_experiencia',
        'direccion',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'empresa_servicio', 'empresa_id', 'servicio_id');
    }

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'empresa_id');
    }

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'empresa_id');
    }
}
