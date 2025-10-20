<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Listar()
    {
        return ['Message' => 'Listando os eventos do sistema'];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function criar(Request $request)
    {
        return ['Message' => 'Criando um novo evento no sistema'];
    }

    /**
     * Display the specified resource.
     */
    public function remover(string $id)
    {
        return ['Message' => 'Removendo o evento com ID: ' . $id];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
