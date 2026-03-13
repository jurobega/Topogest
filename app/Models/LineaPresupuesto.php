<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineaPresupuesto extends Model
{
      protected $table = 'lineas_presupuesto';

    public $timestamps = false;

    protected $fillable = [
        'presupuesto_id',
        'concepto',
        'descripcion',
        'cantidad',
        'precio_unitario',
        'subtotal',
        'orden',
    ];

    protected $casts = [
        'cantidad'        => 'decimal:2',
        'precio_unitario' => 'decimal:2',
        'subtotal'        => 'decimal:2',
    ];

    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class, 'presupuesto_id');
    }
}
