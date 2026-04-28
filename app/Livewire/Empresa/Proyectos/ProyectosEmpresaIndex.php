<?php

namespace App\Livewire\Empresa\Proyectos;

use App\Models\PerfilEmpresa;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ProyectosEmpresaIndex extends Component
{
    use WithPagination;

    public string $buscar = "";

    public string $estado = "";

    public string $orden = "reciente";

    public string $estadoPendiente = "";
    public ?Proyecto $proyecto = null;


    public function render()
    {
        $empresa = PerfilEmpresa::where('user_id', Auth::id())->firstOrFail();
        $estados = Proyecto::select('estado')->distinct()->pluck('estado');

        $proyectos = $empresa->proyectos()
            ->with(['cliente', 'documentos'])
            ->when($this->buscar, function ($q) {
                $q->where(function ($query) {
                    $query->where('nombre', 'like', "%{$this->buscar}%")
                        ->orWhereHas('cliente', function ($clienteQuery) {
                            $clienteQuery->where('nombre_completo', 'like', "%{$this->buscar}%");
                        });
                });
            })
            ->when($this->estado, fn($q) => $q->where('estado', $this->estado))
            ->when($this->orden === 'antiguo', fn($q) => $q->oldest())
            ->when($this->orden === 'nombre', fn($q) => $q->orderBy('nombre'))
            ->when(!$this->orden || $this->orden === 'reciente', fn($q) => $q->latest())
            ->paginate(10);

        $numeroProyectos = $empresa->proyectos()->count();


        return view('livewire.empresa.proyectos.proyectos-empresa-index', compact('proyectos', 'estados' , 'numeroProyectos'));
    }


    public function solicitarCambioEstado(int $proyectoId, string $nuevoEstado): void
    {
        $this->proyecto = Proyecto::findOrFail($proyectoId);
        $this->estadoPendiente = $nuevoEstado;
        $this->dispatch('evtConfirmarCambioEstado' , destino:'empresa.proyectos.proyectos-empresa-index');
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

        $this->proyecto->update([
            'estado' => $this->estadoPendiente,
            'fecha_fin_prevista' => now(),
            ]);
    }

    public function limpiarSeleccion() {
        $this->reset('buscar' , 'orden' , 'estado');
    }
}
