<?php

namespace App\Livewire\Empresa\Solicitudes;

use App\Livewire\Forms\Empresa\Solicitudes\ConvertirSolicitudForm;
use App\Models\Solicitud;
use Livewire\Attributes\On;
use Livewire\Component;

class ConvertirSolicitud extends Component
{

    public ?Solicitud $solicitud = null;
    public bool $openCrear = false;

    public ConvertirSolicitudForm $cform;

    public function render()
    {
        return view('livewire.empresa.solicitudes.convertir-solicitud');
    }

    #[On('abrirConvertir')]
    public function abrir(int $solicitudId)
    {
        $this->solicitud = Solicitud::findOrFail($solicitudId);
        $this->openCrear = true;
    }

    public function crear()
    {
        $proyecto = $this->cform->crearProyectoForm($this->solicitud);

        foreach ($this->solicitud->documentos as $documento) {
            $proyecto->documentos()->create([
                'nombre_archivo' => $documento->nombre_archivo,
                'path' => $documento->path,
                'mime_type' => $documento->mime_type,
                'size_bytes' => $documento->size_bytes,
                'subido_por' => $this->solicitud->cliente->user_id,
                'tipo' => 'documento',
            ]);
        }

        $this->solicitud->update(['estado' => 'convertida']);
        $this->dispatch('solicitudConvertida');
        $this->cancelar();
    }

    public function cancelar()
    {
        $this->cform->cancelarForm();
        $this->openCrear = false;
    }
}
