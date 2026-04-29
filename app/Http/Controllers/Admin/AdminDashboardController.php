<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerfilCliente;
use App\Models\PerfilEmpresa;
use App\Models\Proyecto;
use App\Models\Solicitud;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalEmpresas = PerfilEmpresa::count();
        $totalClientes = PerfilCliente::count();
        $proyectosActivos = Proyecto::where('estado' , 'activo')->count();
        $solicitudesPendientes = Solicitud::where('estado' , 'pendiente')->count();
        $empresasRecientes = PerfilEmpresa::latest()->take(5)->get();
        $clientesRecientes = PerfilCliente::latest()->take(5)->get();

        return view('admin.dashboard' , compact('totalEmpresas' , 'totalClientes' , 'proyectosActivos' , 'solicitudesPendientes' , 'empresasRecientes' , 'clientesRecientes'));
    }
}
