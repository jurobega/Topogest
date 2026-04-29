<?php

namespace App\Livewire\Admin;

use App\Models\PerfilEmpresa;
use App\Models\Proyecto;
use App\Models\Solicitud;
use Livewire\Component;
use Livewire\WithPagination;

class ListaEmpresas extends Component
{
   use WithPagination;

    public string $buscar = '';

    public function updatingBuscar(): void
    {
        $this->resetPage();
    }

    public function toggleVisibilidad(int $empresaId): void
    {
        $empresa = PerfilEmpresa::findOrFail($empresaId);
        $empresa->update([
            'visible_directorio' => !$empresa->visible_directorio,
        ]);
    }

    public function eliminar(int $empresaId): void
    {
        $empresa = PerfilEmpresa::findOrFail($empresaId);

        Proyecto::where('empresa_id', $empresaId)
            ->whereIn('estado', ['activo', 'pendiente_aceptacion', 'borrador'])
            ->update(['estado' => 'cerrado']);

        Solicitud::where('empresa_id', $empresaId)
            ->whereIn('estado', ['pendiente', 'vista', 'en_negociacion'])
            ->update(['estado' => 'rechazada']);

        $empresa->user->delete();
    }

    public function render()
    {
        $empresas = PerfilEmpresa::query()
            ->when($this->buscar, function ($q) {
                $q->where(function ($query) {
                    $query->where('nombre_fiscal', 'like', "%{$this->buscar}%")
                          ->orWhere('provincia', 'like', "%{$this->buscar}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.lista-empresas' , compact('empresas'));
    }
}
