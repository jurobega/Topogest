<?php

namespace App\Livewire\Forms\Cliente;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearSolicitudForm extends Form
{
    
    

     #[Validate(['required' , 'exists:servicios'])]
     public int $servicio_id = 0;

     #[Validate(['strign' , 'min:3'  , 'max:150'])]
     public string $asunto = "";

      #[Validate(['strign' , 'min:3'  , 'max:150'])]
     public string $descripcion = "";

     

     public function crearSolicitudForm() {
        $datos = Validate::all();
     }
}
