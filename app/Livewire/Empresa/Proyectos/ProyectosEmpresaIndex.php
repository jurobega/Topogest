<?php

namespace App\Livewire\Empresa\Proyectos;

use App\Models\PerfilEmpresa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProyectosEmpresaIndex extends Component
{
    use WithPagination;

    public string $buscar = "";

    public string $estado = "";

    public string $orden = "";


    public function render()
    {
       $empresa = PerfilEmpresa::where('user_id', Auth::id())->firstOrFail();

        $proyectos = $empresa->proyectos()
        ->with(['cliente', 'documentos'])
        ->when($this->buscar, function ($q) {
            $q->where(function ($query) {
                $query->where('nombre', 'like', "%{$this->buscar}%")
                    ->orWhereHas('cliente', function ($clienteQuery) {
                        $clienteQuery->where('nombre_completo', 'like', "%{$this->buscar}%");
                    });
            });
        })
        ->when($this->estado, fn($q) => $q->where('estado', $this->estado))
        ->when($this->orden === 'antiguo', fn($q) => $q->oldest())
        ->when($this->orden === 'nombre', fn($q) => $q->orderBy('nombre'))
        ->when(!$this->orden || $this->orden === 'reciente', fn($q) => $q->latest())
        ->paginate(10);
        return view('livewire.empresa.proyectos.proyectos-empresa-index', compact('proyectos'));
    }
}
