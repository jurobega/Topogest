<?php

namespace App\Livewire\Cliente;

use App\Livewire\Forms\Cliente\CrearSolicitudForm;
use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithFileUploads;

class SolicitarServicio extends Component
{
    use WithFileUploads;

    public int $empresa_id;
    public array $documentos_solicitud = [];
    public array $todos_los_documentos = [];

    public CrearSolicitudForm $cform;

    public function mount(int $empresa_id)
    {
        $this->empresa_id = $empresa_id;
    }

    public function render()
    {
        $servicios = Servicio::all();
        return view('livewire.cliente.solicitar-servicio', compact('servicios'));
    }

    public function updatedDocumentosSolicitud(): void
    {
        $this->todos_los_documentos = array_merge(
            array_filter($this->todos_los_documentos),
            array_filter($this->documentos_solicitud)
        );
        $this->documentos_solicitud = [];
    }

    public function eliminarDocumento(int $index): void
    {
        array_splice($this->documentos_solicitud, $index, 1);
    }


    public function crearSolicitud(): void
    {
        $this->cform->crearSolicitudForm($this->empresa_id, $this->todos_los_documentos);
        $this->todos_los_documentos = [];
        $this->cancelar();
        $this->dispatch('mensaje', 'Solicitud Enviada Correctamente');
    }

    public function cancelar()
    {
        redirect('/');
        $this->cform->cancelarForm();
    }
}
