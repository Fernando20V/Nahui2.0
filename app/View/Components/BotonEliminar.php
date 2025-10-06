<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BotonEliminar extends Component
{
    public $id; // <-- declarar el parámetro

    public function __construct($id)
    {
        $this->id = $id; // <-- asignar el parámetro
    }

    public function render()
    {
        return view('components.boton-eliminar');
    }
}
