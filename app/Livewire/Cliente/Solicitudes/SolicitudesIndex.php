<?php

namespace App\Livewire\Cliente\Solicitudes;

use App\Models\PerfilCliente;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class SolicitudesIndex extends Component
{

    use WithPagination;


    public string $buscar = "";

    public ?string $estado = null;

    public bool $openMostrar = false;

    public ?Solicitud $solicitud = null;

    public function render()
    {

        $cliente = PerfilCliente::where('user_id', Auth::id())->firstOrFail();

        $solicitudes = $cliente->solicitudes()
        ->with('empresa' , 'documentos')
        ->when($this->buscar, function ($q) {
            $q->where('asunto', 'like', "%{$this->buscar}%")
            ->orWhereHas('empresa', function ($empresaQuery) {
                $empresaQuery->where('nombre_fiscal', 'like', "%{$this->buscar}%");
            });
        })
        ->when($this->estado, function ($q) {
            $q->where('estado',  $this->estado);
        })
        ->latest()
        ->paginate(10);

        $estados = Solicitud::select('estado')->distinct()->pluck('estado');

        return view('livewire.cliente.solicitudes.solicitudes-index' , compact('solicitudes' , 'estados') );
    }

    public function updatingBuscar(){
        $this->resetPage();
    }

    public function mostrarSolicitud(?int $id = null) {
        $this->solicitud = Solicitud::findOrFail($id);
        $this->openMostrar = true;
    }
}
