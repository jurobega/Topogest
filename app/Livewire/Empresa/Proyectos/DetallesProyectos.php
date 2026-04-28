<?php

namespace App\Livewire\Empresa\Proyectos;

use App\Models\DocumentoProyecto;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class DetallesProyectos extends Component
{

    use WithFileUploads;

    public Proyecto $proyecto;
    public string $nuevoMensaje = "";
    public string $tipoSubida = "documento";
    public array $archivos = [];
    public array $todosLosArchivos = [];
    public string $descripcionEditar = "";
    public bool $editando = false;
    public ?string $fechaFinEditar = null;
    public string $estadoPendiente = '';



    public function render()
    {
        return view('livewire.empresa.proyectos.detalles-proyectos');
    }


    public function updatedArchivos(): void
    {
        $this->todosLosArchivos = array_merge(
            array_filter($this->todosLosArchivos),
            array_filter($this->archivos)
        );
        $this->archivos = [];
    }

    public function quitarArchivo(int $index): void
    {
        array_splice($this->todosLosArchivos, $index, 1);
    }

    public function subirDocumentos(): void
    {
        if (empty($this->todosLosArchivos))
            return;

        $this->proyecto->documentos()->createMany(
            collect($this->todosLosArchivos)
                ->filter()
                ->map(function ($archivo) {
                    return [
                        'nombre_archivo' => $archivo->getClientOriginalName(),
                        'path' => $archivo->store('documentos/proyectos', 'public'),
                        'mime_type' => $archivo->getMimeType(),
                        'size_bytes' => $archivo->getSize(),
                        'tipo' => $this->tipoSubida,
                        'subido_por' => auth()->id(),
                    ];
                })->toArray()
        );

        $this->todosLosArchivos = [];
        $this->proyecto->refresh();
    }


    public function mount(Proyecto $proyecto): void
    {
        $this->proyecto = $proyecto->load(['cliente', 'documentos', 'mensajes.remitente']);
        $this->descripcionEditar = $proyecto->descripcion ?? '';
        $this->fechaFinEditar = $proyecto->fecha_fin_prevista?->format('Y-m-d');
    }

    public function refrescarMensajes(): void
    {
        $this->proyecto->load('mensajes.remitente');
    }


    public function solicitarCambioEstado(string $nuevoEstado): void
    {
        $this->estadoPendiente = $nuevoEstado;
        $this->dispatch('evtConfirmarCambioEstado', destino:'empresa.proyectos.detalles-proyectos');
    }

    #[On('evtCambioEstadoOk')]
    public function cambiarEstado(): void
    {
        $transicionesValidas = [
            'activo' => 'entregado',
            'entregado' => 'cerrado',
        ];

        abort_if(
            !isset($transicionesValidas[$this->proyecto->estado]) ||
            $transicionesValidas[$this->proyecto->estado] !== $this->estadoPendiente,
            422
        );

        $this->proyecto->update(['estado' => $this->estadoPendiente]);
        $this->estadoPendiente = '';
        $this->proyecto->refresh();
    }

    public function eliminarDocumento(int $documentoId): void
    {
        $documento = DocumentoProyecto::findOrFail($documentoId);

        abort_if($documento->proyecto_id !== $this->proyecto->id, 403);

        Storage::disk('public')->delete($documento->path);

        $documento->delete();

        $this->proyecto->refresh();
    }

    public function enviarMensaje(): void
    {
        $this->validate([
            'nuevoMensaje' => 'required|string|min:1|max:1000'
        ]);

        $this->proyecto->mensajes()->create([
            'remitente_id' => auth()->id(),
            'mensaje' => $this->nuevoMensaje,
            'leido' => false,
        ]);

        $this->nuevoMensaje = '';
        $this->proyecto->refresh();
    }

    public function guardarCambios(): void
    {
        $this->validate([
            'descripcionEditar' => 'nullable|string|max:2000',
            'fechaFinEditar' => 'nullable|date|after_or_equal:today',
        ]);

        $this->proyecto->update([
            'descripcion' => $this->descripcionEditar,
            'fecha_fin_prevista' => $this->fechaFinEditar,
        ]);

        $this->editando = false;
        $this->proyecto->refresh();
    }
}
