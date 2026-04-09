<?php

namespace App\Livewire;

use App\Models\PerfilEmpresa;
use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithPagination;

class DirectorioEmpresas extends Component
{

    use WithPagination;
    
    public int $servicio_id = 0;
    public string $provincia = "";

    public function render()
    {
       $empresa = PerfilEmpresa::where('provincia' , 'like' , "%{$this->provincia}%")
    ->when($this->servicio_id, function ($query) {
        $query->whereHas('servicios', function ($q) {
            $q->where('servicios.id', $this->servicio_id);
        });
    })
    ->get();
        $servicios = Servicio::select('nombre' , 'id')->get();
        return view('livewire.directorio-empresas' , compact('servicios' , 'empresa'));
    }

    public function limpiar() {
        $this->reset('servicio_id' , 'provincia');
    }
}
