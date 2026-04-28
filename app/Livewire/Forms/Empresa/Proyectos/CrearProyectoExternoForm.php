<?php

namespace App\Livewire\Forms\Empresa\Proyectos;

use App\Models\PerfilEmpresa;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearProyectoExternoForm extends Form
{
    #[Validate(['required', 'string', 'min:3', 'max:150'])]
    public string $nombre = '';

    #[Validate(['nullable', 'string', 'max:2000'])]
    public string $descripcion = '';

    #[Validate(['nullable', 'date', 'after_or_equal:today'])]
    public ?string $fecha_fin_prevista = null;

    #[Validate(['required', 'string', 'max:150'])]
    public string $cliente_externo_nombre = '';

    #[Validate(['nullable', 'string', 'max:20'])]
    public string $cliente_externo_telefono = '';

    #[Validate(['nullable', 'email', 'max:150'])]
    public string $cliente_externo_email = '';



    public function crearProyectoExternoForm()
    {
        $datos = $this->validate();

        $empresa = PerfilEmpresa::where('user_id', Auth::id())->firstOrFail();

        return Proyecto::create([
            'empresa_id'               => $empresa->id,
            'tipo'                     => 'externo',
            'estado'                   => 'activo',
            'nombre'                   => $datos['nombre'],
            'descripcion'              => $datos['descripcion'],
            'fecha_fin_prevista'       => $datos['fecha_fin_prevista'],
            'fecha_inicio'             => now(),
            'cliente_externo_nombre'   => $datos['cliente_externo_nombre'],
            'cliente_externo_telefono' => $datos['cliente_externo_telefono'],
            'cliente_externo_email'    => $datos['cliente_externo_email'],
            'cliente_id'               => null,
        ]);
    }

    public function cancelarForm(): void
    {
        $this->resetValidation();
        $this->reset();
    }
}
