<?php

namespace App\Livewire;

use App\Models\PerfilEmpresa;
use App\Models\Servicio;
use Livewire\Component;

class DirectorioEmpresas extends Component
{

    public function render()
    {
        $empresa = PerfilEmpresa::all();
        $servicios = Servicio::select('nombre' , 'id')->get();
        return view('livewire.directorio-empresas' , compact('servicios' , 'empresa'));
    }
}
