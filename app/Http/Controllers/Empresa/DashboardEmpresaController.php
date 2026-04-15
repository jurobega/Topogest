<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\PerfilEmpresa;
use Auth;
use Illuminate\Http\Request;

class DashboardEmpresaController extends Controller
{
    

 public function index()
    {
        $empresa = PerfilEmpresa::where('user_id', Auth::id())->firstOrFail();

        $totalSolicitudes = $empresa->solicitudes()->count();

        $proyectosActivos = $empresa->proyectos()
            ->where('estado', 'activo')
            ->count();

        $entregadosMes = $empresa->proyectos()
            ->where('estado', 'entregado')
            ->whereMonth('updated_at', now()->month)
            ->whereYear('updated_at', now()->year)
            ->count();

        $totalClientes = $empresa->proyectos()
            ->whereNotNull('cliente_id')
            ->distinct('cliente_id')
            ->count('cliente_id');

        // Bandeja de entrada: últimas solicitudes
        $ultimasSolicitudes = $empresa->solicitudes()
            ->with(['cliente', 'servicio'])
            ->latest()
            ->take(5)
            ->get();

        // Esperando al cliente
        $esperandoCliente = $empresa->proyectos()
            ->with('cliente')
            ->where('estado', 'pendiente_aceptacion')
            ->latest()
            ->take(5)
            ->get();

        // Proyectos en curso
        $proyectosEnCurso = $empresa->proyectos()
            ->with('cliente')
            ->where('estado', 'activo')
            ->latest()
            ->take(2)
            ->get();

        // Historial de solicitudes
        $historialSolicitudes = $empresa->solicitudes()
            ->with(['cliente', 'servicio'])
            ->latest()
            ->take(10)
            ->get();

        return view('empresa.dashboard', compact(
            'empresa',
            'totalSolicitudes',
            'proyectosActivos',
            'entregadosMes',
            'totalClientes',
            'ultimasSolicitudes',
            'esperandoCliente',
            'proyectosEnCurso',
            'historialSolicitudes'
        ));
    }
}
