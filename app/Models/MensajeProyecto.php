<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MensajeProyecto extends Model
{

    use HasFactory;

    protected $table = 'mensaje_proyectos';

    protected $fillable = ['proyecto_id', 'remitente_id', 'mensaje' , 'leido'];

    public function remitente()
    {
        return $this->belongsTo(User::class, 'remitente_id');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
