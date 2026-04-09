<?php

use App\Http\Controllers\Cliente\DashboardClienteController;
use App\Http\Controllers\EmpresaPerfilController;
use App\Http\Controllers\ServicioController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ClienteMiddleware;
use App\Http\Middleware\EmpresaMiddleware;
use App\Livewire\Cliente\Proyectos\ProyectosIndex;
use App\Livewire\Cliente\SolicitarServicio;
use App\Livewire\Cliente\Solicitudes\SolicitudesIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('inicio');
Route::get('/empresa/{perfil}', [EmpresaPerfilController::class, 'show'])->name('empresa.perfil');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    // Panel Admin
    Route::prefix('admin')->name('admin.')->middleware(AdminMiddleware::class)->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::resource('servicios', ServicioController::class);
    });

    // Panel Empresa
    Route::prefix('empresa')->name('empresa.')->middleware(EmpresaMiddleware::class)->group(function () {
        Route::get('/dashboard', function () {
            return view('empresa.dashboard');
        })->name('dashboard');
    });

    // Panel Cliente
    Route::prefix('cliente')->name('cliente.')->middleware(ClienteMiddleware::class)->group(function () {
        Route::get('/dashboard', [DashboardClienteController::class, 'index'])->name('dashboard');
        Route::get('solicitar-servicio/{empresa_id}', SolicitarServicio::class)->name('solicitar-servicio');
        Route::get('/solicitudes' , SolicitudesIndex::class)->name('solicitudes.index');
        Route::get('/proyectos' , ProyectosIndex::class)->name('proyectos.index');
    });
 
});
