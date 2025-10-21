<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Database\Eloquent\Model;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Listar(Request $request)
    {
        $filtro = $request->get('filtro');
     $consutar = Model::where('nome', '=', $filtro)->get();

        $consulta = Evento::query();

        $consulta->where('nome', 'like', '%' . $filtro . '%');

        $eventos = $consulta->get();

        dd($eventos);

        return ['Message' => 'Listando os eventos do sistema', 'eventos' => $eventos->toArray()];
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

    public function Buscar(string $id)
    {
    // $consulta = Evento::query();

    // $consulta->where('id', $id);
    // $consulta->where('id', '>', 1);
    
    // $evento = $consulta->get()->first();

    // $evento = Evento::find($id);

    // $evento = Evento::findOrFail($id);

    // $evento = Evemto::torawsql

    $evento = Evento::findOrFail($id);

    return ['Message' => 'Evento encontrado com ID: ' . $id, 'evento' => $evento->toArray()];   
    }
}