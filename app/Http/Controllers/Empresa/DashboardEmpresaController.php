<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardEmpresaController extends Controller
{
    

    public function index() {
        dd('entro');
        return view('empresa.dashboard');
    }
}
