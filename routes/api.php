<?php 

use App\Http\Controllers\EventoController;
use App\Http\Controllers\IngressosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return json_encode(['Message' => 'Minha API Laravel']);
});


Route::get('/eventos', [EventoController::class, 'Listar']);
Route::post('/eventos', [EventoController::class, 'criar']);
Route::delete('/eventos/{id}', [EventoController::class, 'remover']);
Route::put('/eventos/{id}', [EventoController::class, 'update']);

Route::prefix('eventos')->group(function () {
    Route::get('', [EventoController::class, 'Listar']);
    Route::get('{id}', [EventoController::class, 'Buscar']);
    Route::post('', [EventoController::class, 'criar']);
    Route::delete('/ingressos/{id}', [EventoController::class, 'remover']);
    Route::put('{id}', [EventoController::class, 'update']);
});


    Route::get('/ingressos', [IngressosController::class, 'listarIngressos']);

    Route::post('/ingressos', [IngressosController::class, 'criarIngressos']);

    Route::get('/ingressos/{evento_id}', [IngressosController::class, 'BuscarIngressos']);

    Route::delete('/ingressos/{evento_id}', [IngressosController::class, 'removerIngressos']);
    Route::put('/ingressos/{evento_id}', [IngressosController::class, 'updateIngressos']);

    Route::prefix('ingressos')->group(function () {
        Route::get('', [IngressosController::class, 'listarIngressos']);
        Route::get('{evento_id}', [IngressosController::class, 'BuscarIngressos']);
        Route::post('', [IngressosController::class, 'criarIngressos']);
        Route::delete('{evento_id}', [IngressosController::class, 'removerIngressos']);
        Route::put('{evento_id}', [IngressosController::class, 'updateIngressos']);
        Route::get('todos', [IngressosController::class, 'listarTodosIngressos']);
    });
?>

