<?php

namespace App\Livewire\Cliente;

use App\Models\PerfilCliente;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ActualizarPerfilCliente extends Component
{
      public string $nif_nie = '';
    public string $telefono = '';
    public string $direccion = '';
    public string $provincia = '';
    public string $nombre_completo = '';

    public function mount(): void
    {
        $perfil = PerfilCliente::where('user_id', Auth::id())->firstOrFail();

        $this->nombre_completo = $perfil->nombre_completo ?? '';
        $this->nif_nie   = $perfil->nif_nie ?? '';
        $this->telefono  = $perfil->telefono ?? '';
        $this->direccion = $perfil->direccion ?? '';
        $this->provincia = $perfil->provincia ?? '';
    }

    public function guardar(): void
    {
        $this->validate([
            'nombre_completo' => 'required|string|max:150',
            'nif_nie'   => 'nullable|string|max:20',
            'telefono'  => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:100',
        ]);

        $perfil = PerfilCliente::where('user_id', Auth::id())->firstOrFail();

        $perfil->update([
            'nombre_completo' => $this->nombre_completo,
            'nif_nie'   => $this->nif_nie,
            'telefono'  => $this->telefono,
            'direccion' => $this->direccion,
            'provincia' => $this->provincia,
        ]);

        Auth::user()->forceFill([
        'name' => $this->nombre_completo,
        ])->save();

        $this->dispatch('guardado');
    }

    public function render()
    {
        return view('livewire.cliente.actualizar-perfil-cliente');
    }
}
