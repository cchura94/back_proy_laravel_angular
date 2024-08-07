<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1/auth')->group(function(){

    Route::post('login', [AuthController::class, 'funLogin']);
    Route::post('register', [AuthController::class, 'funRegister']);

    Route::middleware(['auth:sanctum'])->group(function(){

        Route::get('profile', [AuthController::class, 'funProfile']);
        Route::post('logout', [AuthController::class, 'funLogout']);
        
    });

});

// CRUD API REST


Route::get("/pedido/generar-pedido-pdf", [PedidoController::class, "generarReportePDF"]);

Route::middleware(['auth:sanctum'])->group(function(){

    Route::get("cliente/buscar", [ClienteController::class, "indexSearch"]);
    // subida de imagenes
    Route::post("producto/{id}/actualizar-imagen", [ProductoController::class, "actualizarImagen"]); 

    Route::apiResource("usuario", UsuarioController::class);
    Route::apiResource("persona", PersonaController::class);
    Route::apiResource('categoria', CategoriaController::class);
    Route::apiResource('producto', ProductoController::class);

    Route::apiResource('pedido', PedidoController::class);
    Route::apiResource('cliente', ClienteController::class);
    
    
});


Route::get("/no-permitido", function(){
    return response()->json(["mensaje" => "No esta permitido ver esta pagina"], 401);
})->name("login");

