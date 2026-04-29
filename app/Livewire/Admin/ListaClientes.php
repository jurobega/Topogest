<?php

namespace App\Livewire\Admin;

use App\Models\PerfilCliente;
use Livewire\Component;
use Livewire\WithPagination;

class ListaClientes extends Component
{
 use WithPagination;

    public string $buscar = '';

    public function updatingBuscar(): void
    {
        $this->resetPage();
    }

    public function eliminar(int $clienteId): void
    {
        $cliente = PerfilCliente::findOrFail($clienteId);
        $cliente->user->delete();
    }

    public function render()
    {
        $clientes = PerfilCliente::query()
            ->when($this->buscar, function ($q) {
                $q->where(function ($query) {
                    $query->where('nombre_completo', 'like', "%{$this->buscar}%")
                          ->orWhere('provincia', 'like', "%{$this->buscar}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.lista-clientes', compact('clientes'));
    }
}
