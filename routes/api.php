<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function(){
    Route::get("/persona",[PersonaController::class,"Listar"]);
    Route::get("/persona/{d}",[PersonaController::class,"Buscar"]);
    Route::post("/persona",[PersonaController::class,"Crear"]);
    Route::put("/persona/{d}",[PersonaController::class,"Modificar"]);
    Route::delete("/persona/{d}",[PersonaController::class,"Eliminar"]);

});
