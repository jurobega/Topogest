<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
     protected $table = 'presupuestos';

    protected $fillable = [
        'proyecto_id',
        'numero',
        'estado',
        'fecha_emision',
        'fecha_caducidad',
        'base_imponible',
        'iva_porcentaje',
        'total',
        'pdf_path',
        'notas',
    ];

    protected $casts = [
        'fecha_emision'    => 'date',
        'fecha_caducidad'  => 'date',
        'base_imponible'   => 'decimal:2',
        'iva_porcentaje'   => 'decimal:2',
        'total'            => 'decimal:2',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    public function lineas()
    {
        return $this->hasMany(LineaPresupuesto::class, 'presupuesto_id');
    }
}
