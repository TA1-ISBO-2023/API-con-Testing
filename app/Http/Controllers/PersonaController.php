<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonaController extends Controller
{
    public function Listar(Request $request){
        return Persona::all();
    }

    public function Buscar(Request $request,$idPersona){
        return Persona::findOrFail($idPersona);
    }
    public function Crear(Request $request){
        $p = new Persona;
        $p -> nombre = $request -> post("nombre");
        $p -> apellido = $request -> post("apellido");
        $p -> save();

        return $p;

    }

}
