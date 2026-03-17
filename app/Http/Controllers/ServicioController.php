<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicios = Servicio::orderBy('id' , 'desc')->get();
        return view("servicios.inicio" , compact("servicios"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("servicios.nuevo");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(self::rules());
        Servicio::create($request->all());
        return redirect()->route('servicios.index')->with('mensaje' , 'El Servicio se ha creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Servicio $servicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $servicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servicio $servicio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servicio $servicio)
    {
        //
    }


    private static function rules(?int $id = null): array {
        return [
            'nombre' => ['required' , 'string' , 'min:3' , 'max:150' , 'unique:servicios,nombre,'.$id],
            'descripcion' => ['required', 'string','min:3','max:151'],
        ];
    }
}
