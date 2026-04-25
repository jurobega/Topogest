<?php

namespace App\Livewire\Empresa\Proyectos;

use App\Models\Proyecto;
use Livewire\Component;

class DetallesProyectos extends Component
{

    public ?Proyecto $proyecto = null;

    public function render()
    {
        return view('livewire.empresa.proyectos.detalles-proyectos' );
    }
}
