<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Cliente\DashboardClienteController;
use App\Http\Controllers\Empresa\DashboardEmpresaController;
use App\Http\Controllers\EmpresaPerfilController;
use App\Http\Controllers\ServicioController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ClienteMiddleware;
use App\Http\Middleware\EmpresaMiddleware;
use App\Livewire\Admin\ListaClientes;
use App\Livewire\Admin\ListaEmpresas;
use App\Livewire\Cliente\Proyectos\ProyectosIndex;
use App\Livewire\Cliente\SolicitarServicio;
use App\Livewire\Cliente\Solicitudes\SolicitudesIndex;

use App\Livewire\Empresa\Proyectos\DetallesProyectos;
use App\Livewire\Empresa\Proyectos\ProyectosEmpresaIndex;
use App\Livewire\Empresa\Solicitudes\SolicitudesEmpresa;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('inicio');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    // Panel Admin
    Route::prefix('admin')->name('admin.')->middleware(AdminMiddleware::class)->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('servicios', ServicioController::class);
        Route::get('/listaEmpresas' , ListaEmpresas::class)->name('listaempresa');
        Route::get('/listaClientes' , ListaClientes::class)->name('listaClientes');
    });

    // Panel Empresa
    Route::prefix('empresa')->name('empresa.')->middleware(EmpresaMiddleware::class)->group(function () {
        Route::get('/dashboard' , [DashboardEmpresaController::class , 'index'])->name('dashboard');
        Route::get('/solicitudes' , SolicitudesEmpresa::class)->name('solicitudes.index');
        Route::get('/proyectos' , ProyectosEmpresaIndex::class)->name('proyectos.index');
        Route::get('/proyectos/{proyecto}' , DetallesProyectos::class)->name('proyectos.detalle');
    });

    // Panel Cliente
    Route::prefix('cliente')->name('cliente.')->middleware(ClienteMiddleware::class)->group(function () {
        Route::get('/dashboard', [DashboardClienteController::class, 'index'])->name('dashboard');
        Route::get('solicitar-servicio/{empresa_id}', SolicitarServicio::class)->name('solicitar-servicio');
        Route::get('/solicitudes' , SolicitudesIndex::class)->name('solicitudes.index');
        Route::get('/proyectos' , ProyectosIndex::class)->name('proyectos.index');
    });
 
});

Route::get('/empresa/{perfil}', [EmpresaPerfilController::class, 'show'])->name('empresa.perfil');
