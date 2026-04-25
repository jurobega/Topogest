<?php

namespace App\Livewire\Cliente\Proyectos;

use App\Models\MensajeProyecto;
use App\Models\PerfilCliente;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProyectosIndex extends Component
{
   
    public string $buscar = "";

    public bool $mostrarProyectos = false;

    public ?Proyecto $proyecto = null;

    public string $nuevoMensaje = "";

    public function render()
    {
        $cliente = PerfilCliente::where('user_id', Auth::id())->firstOrFail();

        $proyectos = $cliente->proyectos()
            ->with('empresa', 'documentos' , 'mensajes')
            ->when($this->buscar, function ($q) {
                $q->where(function ($query) {
                    $query->where('nombre', 'like', "%{$this->buscar}%")
                        ->orWhereHas('empresa', function ($empresaQuery) {
                            $empresaQuery->where('nombre_fiscal', 'like', "%{$this->buscar}%");
                        });
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.cliente.proyectos.proyectos-index' , compact('proyectos'));
    }


    public function mostrarDetallesProyectos(Proyecto $proyecto) {
        $this->proyecto = $proyecto;
        $this->mostrarProyectos = true;
    }

    public function aceptarProyecto() {
        $this->proyecto->update([
            'estado' => 'activo',
            'fecha_inicio' => now(),
        ]);

        $this->proyecto->refresh();
    }


    public function rechazarProyecto() {

        $this->proyecto->update(['estado' => 'rechazado']);

        $this->proyecto->refresh();
    }


     public function enviarMensaje(): void
    {
        $this->validate([
            'nuevoMensaje' => ['required', 'string', 'min:1', 'max:1000'],
        ]);

        MensajeProyecto::create([
            'proyecto_id' => $this->proyecto->id,
            'remitente_id' => Auth::id(),
            'mensaje' => $this->nuevoMensaje,
            'leido' => false,
        ]);

        $this->nuevoMensaje = '';
        $this->proyecto->refresh();
    }
}
