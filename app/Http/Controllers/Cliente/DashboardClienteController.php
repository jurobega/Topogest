<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\PerfilCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cliente = PerfilCliente::where('user_id' ,Auth::id())->first();

        $solicitudes = $cliente->solicitudes()->with('empresa' , 'servicio')->latest()->take(5)->get();

        $proyectos = $cliente->proyectos()->with('empresa')->latest()->take(4)->get();

        $totalSolicitudes = $cliente->solicitudes()->count();

        $proyectosActivos = $cliente->proyectos()->where('estado', 'activo')->count();

        $entregablesListos = $cliente->proyectos()->whereHas('documentos', function ($q) {
                $q->where('tipo', 'entregable');
        })->count();

        return view("cliente.dashboard" , compact('cliente' , 'solicitudes' , 'proyectos' , 'totalSolicitudes' , 'proyectosActivos' , 'entregablesListos'));
    }
    

    
}
