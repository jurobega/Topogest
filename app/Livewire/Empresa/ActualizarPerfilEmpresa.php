<?php

namespace App\Livewire\Empresa;

use App\Models\PerfilEmpresa;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ActualizarPerfilEmpresa extends Component
{
    use WithFileUploads;

    public string $nombre_fiscal = '';
    public string $nif_cif = '';
    public string $descripcion = '';
    public string $provincia = '';
    public string $telefono = '';
    public string $web = '';
    public string $horario_atencion = '';
    public string $zona_actuacion = '';
    public ?int $anios_experiencia = null;
    public ?int $numero_proyectos = null;
    public bool $visible_directorio = true;
    public array $serviciosSeleccionados = [];

    public $logo = null;
    public ?string $logoActual = null;

    public function mount(): void
    {
        $perfil = PerfilEmpresa::where('user_id', Auth::id())->firstOrFail();

        $this->nombre_fiscal     = $perfil->nombre_fiscal ?? '';
        $this->nif_cif           = $perfil->nif_cif ?? '';
        $this->descripcion       = $perfil->descripcion ?? '';
        $this->provincia         = $perfil->provincia ?? '';
        $this->telefono          = $perfil->telefono ?? '';
        $this->web               = $perfil->web ?? '';
        $this->horario_atencion  = $perfil->horario_atencion ?? '';
        $this->zona_actuacion    = $perfil->zona_actuacion ?? '';
        $this->anios_experiencia = $perfil->anios_experiencia;
        $this->numero_proyectos  = $perfil->numero_proyectos;
        $this->visible_directorio = $perfil->visible_directorio;
        $this->logoActual        = $perfil->logo_path;
        $this->serviciosSeleccionados = $perfil->servicios->pluck('id')->toArray();
    }

    public function guardar(): void
    {
        $this->validate([
            'nombre_fiscal'    => 'required|string|max:150',
            'nif_cif'          => 'required|string|max:20',
            'descripcion'      => 'nullable|string|max:2000',
            'provincia'        => 'required|string|max:100',
            'telefono'         => 'nullable|string|max:20',
            'web'              => 'nullable|string|max:255',
            'horario_atencion' => 'nullable|string|max:150',
            'zona_actuacion'   => 'nullable|string|max:1000',
            'anios_experiencia'=> 'nullable|integer|min:0|max:100',
            'numero_proyectos' => 'nullable|integer|min:0',
            'visible_directorio' => 'boolean',
            'logo'             => 'nullable|image|max:2048',
        ]);

        $perfil = PerfilEmpresa::where('user_id', Auth::id())->firstOrFail();

        $rutaLogo = $this->logoActual;
        if ($this->logo) {
            if ($this->logoActual) {
                Storage::disk('public')->delete($this->logoActual);
            }

            $rutaLogo = $this->logo->store('logos-empresa', 'public');

            Auth::user()->forceFill([
                'profile_photo_path' => $rutaLogo,
            ])->save();
        }

        $perfil->update([
            'nombre_fiscal'    => $this->nombre_fiscal,
            'nif_cif'          => $this->nif_cif,
            'descripcion'      => $this->descripcion,
            'provincia'        => $this->provincia,
            'telefono'         => $this->telefono,
            'web'              => $this->web,
            'horario_atencion' => $this->horario_atencion,
            'zona_actuacion'   => $this->zona_actuacion,
            'anios_experiencia'=> $this->anios_experiencia,
            'numero_proyectos' => $this->numero_proyectos,
            'visible_directorio' => $this->visible_directorio,
            'logo_path'        => $rutaLogo,
        ]);

        Auth::user()->forceFill([
            'name' => $this->nombre_fiscal,
        ])->save();

        $this->logoActual = $rutaLogo;
        $this->logo = null;

        $perfil->servicios()->sync($this->serviciosSeleccionados);

        $this->dispatch('guardado');
    }

    public function render()
    {
        $servicios = Servicio::all();
        return view('livewire.empresa.actualizar-perfil-empresa' , compact('servicios'));
    }
}
