<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\IngressosController;
use App\Http\Controllers\VendaController;

// 🔹 Rota simples para teste
Route::get('/user', function (Request $request) {
    return response()->json(['Message' => 'Minha API Laravel']);
});


// =======================
// 🎟️ ROTAS DE EVENTOS
// =======================
Route::prefix('eventos')->group(function () {
    Route::get('', [EventoController::class, 'listar']);          // Listar todos os eventos
    Route::get('{id}', [EventoController::class, 'buscar']);       // Buscar evento por ID
    Route::post('', [EventoController::class, 'criar']);           // Criar evento
    Route::put('{id}', [EventoController::class, 'atualizar']);       // Atualizar evento
    Route::delete('{id}', [EventoController::class, 'deletar']);   // Remover evento
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

// =======================
// 🛒 ROTAS DE VENDAS
// =======================

    Route::prefix('vendas')->group(function () {
        Route::post('', [VendaController::class, 'criarVenda']);    
    }); 