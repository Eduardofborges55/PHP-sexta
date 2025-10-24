<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\IngressosController;

// 🔹 Rota simples para teste
Route::get('/user', function (Request $request) {
    return response()->json(['Message' => 'Minha API Laravel']);
});


// =======================
// 🎟️ ROTAS DE EVENTOS
// =======================
Route::prefix('eventos')->group(function () {
    Route::get('', [EventoController::class, 'Listar']);          // Listar todos os eventos
    Route::get('{id}', [EventoController::class, 'Buscar']);       // Buscar evento por ID
    Route::post('', [EventoController::class, 'criar']);           // Criar evento
    Route::put('{id}', [EventoController::class, 'update']);       // Atualizar evento
    Route::delete('{id}', [EventoController::class, 'remover']);   // Remover evento
});


// =======================
// 🎫 ROTAS DE INGRESSOS
// =======================
Route::prefix('ingressos')->group(function () {
    Route::get('', [IngressosController::class, 'listarTodosIngressos']);     // Todos os ingressos
    Route::get('evento/{evento_id}', [IngressosController::class, 'listarIngressosPorEvento']); // Ingressos por evento
    Route::get('{id}', [IngressosController::class, 'buscarIngressoPorId']);  // Ingresso por ID
    Route::post('', [IngressosController::class, 'criarIngressos']);          // Criar ingresso
    Route::put('{id}', [IngressosController::class, 'atualizarIngressos']);   // Atualizar ingresso
    Route::delete('{id}', [IngressosController::class, 'deletarIngressos']);  // Deletar ingresso
});
