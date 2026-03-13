<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilCliente extends Model
{
    /** @use HasFactory<\Database\Factories\PerfilClienteFactory> */
    use HasFactory;


    protected $table = 'perfiles_cliente';

    protected $fillable = [
        'user_id',
        'nombre_completo',
        'nif_nie',
        'telefono',
        'direccion',
        'provincia',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'cliente_id');
    }

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'cliente_id');
    }
}
