<?php

namespace App\Livewire\Empresa\Proyectos;

use App\Livewire\Forms\Empresa\Proyectos\CrearProyectoExternoForm;
use Livewire\Component;

class CrearProyectoExterno extends Component
{

    public bool $openCrear = false;
    public CrearProyectoExternoForm $cform;
    public function render()
    {
        return view('livewire.empresa.proyectos.crear-proyecto-externo');
    }

    public function crear(): void
    {
        $this->cform->crearProyectoExternoForm();
        $this->cancelar();
        $this->dispatch('mensaje' , 'Proyecto Creado Correctamente');
        $this->dispatch('proyectoCreado');
    }

    public function cancelar(): void
    {
        $this->cform->cancelarForm();
        $this->openCrear = false;
    }
}
