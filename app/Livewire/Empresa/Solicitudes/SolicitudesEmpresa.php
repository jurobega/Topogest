<?php

namespace App\Livewire\Empresa\Solicitudes;

use App\Models\MensajeSolicitud;
use App\Models\PerfilEmpresa;
use App\Models\Servicio;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class SolicitudesEmpresa extends Component
{
    use WithPagination;

    public string $buscar = '';

    public string $estado = '';

    public ?int $servicio_id = null;

    public ?Solicitud $solicitud = null;

    public bool $mostrarSolicitudes = false;

    public string $nuevoMensaje = '';

    #[On('solicitudConvertida')]
    public function render()
    {

        $servicios = Servicio::all();
        $estados = Solicitud::select('estado')->distinct()->pluck('estado');
        $empresa = PerfilEmpresa::where('user_id', Auth::id())->firstOrFail();
        $solicitudes = Solicitud::with(['cliente', 'servicio'])->where('empresa_id', $empresa->id)->
            when($this->buscar, function ($q) {
                $q->where(function ($query) {
                    $query->where('asunto', 'like', "%{$this->buscar}%")
                        ->orWhereHas('cliente', function ($clienteQuery) {
                            $clienteQuery->where('nombre_completo', 'like', "%{$this->buscar}%");
                        });
                });
            })
            ->when($this->estado, function ($q) {
                $q->where('estado', $this->estado);
            })
            ->when($this->servicio_id, function ($q) {
                $q->where('servicio_id', $this->servicio_id);
            })->orderByRaw("
                CASE
                    WHEN estado = 'pendiente' THEN 1
                    WHEN estado = 'vista' THEN 2
                    WHEN estado = 'en_negociacion' THEN 3
                    WHEN estado = 'convertida' THEN 4
                    ELSE 5
                END
            ")
            ->latest()
            ->paginate(10);

        $numeroSolicitudes = $empresa->solicitudes()->count();

        return view('livewire.empresa.solicitudes.solicitudes-empresa', compact('estados', 'servicios', 'solicitudes' , 'numeroSolicitudes'));
    }

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function mostrarDetallesSolicitudes(int $id)
    {
        $this->solicitud = Solicitud::where('id', $id)->first();
        if ($this->solicitud->estado == 'pendiente') {
            $this->solicitud->update(['estado' => 'vista']);
        }
        $this->mostrarSolicitudes = true;
    }

    public function enviarMensaje(): void
    {
        $this->validate([
            'nuevoMensaje' => ['required', 'string', 'min:1', 'max:1000'],
        ]);

        MensajeSolicitud::create([
            'solicitud_id' => $this->solicitud->id,
            'remitente_id' => Auth::id(),
            'mensaje' => $this->nuevoMensaje,
            'leido' => false,
        ]);

        $this->nuevoMensaje = '';
        $this->solicitud->refresh();
    }

    public function abrirConvertir(int $solicitudId) {
        $this->dispatch('abrirConvertir' , solicitudId : $solicitudId );
    }


    public function marcarEnNegociacion()
    {
        $this->solicitud->update(['estado' => 'en_negociacion']);
    }


    public function mostrarConfirmacion()
    {
        $this->dispatch('evtRechazarSolicitud', destino: 'empresa.solicitudes.solicitudes-empresa');
    }

    #[On('evtRechazarOk')]
    public function marcarRechazada()
    {
        $this->solicitud->update(['estado' => 'rechazada']);
        $this->dispatch('mensaje', 'La solicitud a sido rechazada');
    }


}
