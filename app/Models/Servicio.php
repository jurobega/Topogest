<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function empresas()
    {
        return $this->belongsToMany(PerfilEmpresa::class, 'empresa_servicio', 'servicio_id', 'empresa_id');
    }
}