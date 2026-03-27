<?php

namespace App\Livewire\Cliente;

use App\Models\Servicio;
use Livewire\Component;

class SolicitarServicio extends Component
{
    public function render()
    {
        $servicios = Servicio::all();
        return view('livewire.cliente.solicitar-servicio' , compact('servicios'));
    }

    public function cancelar() {
        redirect('/');
    }
}
