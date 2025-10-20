<?php 

use App\Http\Controllers\EventoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return json_encode(['Message' => 'Minha API Laravel']);
});


Route::get('/eventos', [EventoController::class, 'Listar']);
Route::post('/eventos', [EventoController::class, 'criar']);
Route::delete('/eventos/{id}', [EventoController::class, 'remover']);

Route::prefix('eventos')->group(function () {
    Route::get('', [EventoController::class, 'Listar']);
    Route::post('', [EventoController::class, 'criar']);
    Route::delete('{id}', [EventoController::class, 'remover']);
});

