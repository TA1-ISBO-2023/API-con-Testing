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

    public function Eliminar(Request $request,$idPersona){
        $p = Persona::findOrFail($idPersona);
        $p -> delete();
        return [ 'message' => 'Persona eliminada' ];
        

    }

    public function Modificar(Request $request, $idPersona){
        $p = Persona::findOrFail($idPersona);
        $p -> nombre = $request -> post("nombre");
        $p -> apellido = $request -> post("apellido");
        $p -> save();

        return $p;
    }

    public function Crear(Request $request){
        try {
            $p = new Persona;
            $p -> nombre = $request -> post("nombre");
            $p -> apellido = $request -> post("apellido");
            $p -> save();
    
            return $p;
        } 
        catch (\Illuminate\Database\QueryException $e) {
            $error = [
                "result" => "Duplicated key",
                "message" => $e -> getMessage()
            ];
            
            error_log($e -> getException());
            return response($error, 403);
        }
        catch (\PDOException $e) {
            $error = [
                "result" => "Connection refused",
                "message" => $e -> getMessage()
            ];
            error_log($e -> getException());

            return response($error, 403);
        }


    }

}
