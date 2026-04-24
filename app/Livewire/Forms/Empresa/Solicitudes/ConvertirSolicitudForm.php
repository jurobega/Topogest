<?php

namespace App\Livewire\Forms\Empresa\Solicitudes;

use App\Models\Proyecto;
use App\Models\Solicitud;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ConvertirSolicitudForm extends Form
{

    #[Validate(['required', 'string', 'min:3', 'max:150'])]
    public string $nombre = "";

    #[Validate(['nullable', 'string', 'min:3', 'max:150'])]
    public string $descripcion = "";

    #[Validate(['nullable', 'date'])]
    public ?string $fecha_fin_prevista = null;



    public function crearProyectoForm(Solicitud $solicitud): Proyecto
    {
        $datos = $this->validate();

        return Proyecto::create([
            'empresa_id' => $solicitud->empresa_id,
            'cliente_id' => $solicitud->cliente_id,
            'solicitud_id' => $solicitud->id,
            'tipo' => 'interno',
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'],
            'estado' => 'pendiente_aceptacion',
            'fecha_fin_prevista' => $datos['fecha_fin_prevista'],
        ]);
    }

    public function cancelarForm() {
        $this->resetValidation();
        $this->reset();
    }
}
