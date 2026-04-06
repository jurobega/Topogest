<?php

namespace App\Livewire\Forms\Cliente;


use App\Models\Solicitud;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearSolicitudForm extends Form
{



    #[Validate(['required', 'exists:servicios,id'])]
    public ?int $servicio_id = null;

    #[Validate(['required', 'string', 'min:3', 'max:150'])]
    public string $asunto = "";

    #[Validate(['nullable', 'string', 'min:3', 'max:150'])]
    public ?string $descripcion = null;



    public function crearSolicitudForm(int $empresa_id, array $documentos = [])
    {
        $datos = $this->validate();
        $datos['cliente_id'] = Auth::user()->perfilCliente->id;
        $datos['empresa_id'] = $empresa_id;
        $datos['estado'] = 'pendiente';
        $solicitud = Solicitud::create($datos);

        if (!empty($documentos)) {
            $solicitud->documentos()->createMany(
                collect($documentos)
                    ->filter()
                    ->map(function ($archivo) {
                        return [
                            'nombre_archivo' => $archivo->getClientOriginalName(),
                            'path' => $archivo->store('documentos/solicitudes', 'public'),
                            'mime_type' => $archivo->getMimeType(),
                            'size_bytes' => $archivo->getSize(),
                        ];
                    })->toArray()
            );
        }
    }

    public function cancelarForm()
    {
        $this->resetValidation();
        $this->reset();
    }
}
