<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listar(Request $request)
    {
        $filtro = $request->get('filtro');
     $consulta = Model::where('id', '=', $filtro)->get();

        $consulta = Evento::query();

        $consulta->where('id', 'like', '%' . $filtro . '%');

        $eventos = $consulta->get();

        dd($eventos);

        return ['Message' => 'Listando os eventos do sistema', 'eventos' => $eventos->toArray()];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function criar(Request $request)
    {
        $validado = $request->validate([
            'nome' => [['required', 'string', 'min:3']],
            'data_inicio' => [
                'required', 
                Rule::date()->format('Y-m-d H:i:s')
            ],
            'data_fim' => [
                'required', 
                Rule::date()->after('data_inicio')->format('Y-m-d H:i:s'),
                'after:data_inicio'
            ],
        ]);

        $evento = new Evento();
        $evento->nome = $validado['nome'];
        $evento->data_inicio = $validado['data_inicio'];
        $evento->data_fim = $validado['data_fim'];
        $evento->save();

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
    

    public function buscar(string $id) 
    {
        $evento = Evento::findOrFail($id);

    return ['Message' => 'Evento encontrado com ID: ' . $id, 'evento' => $evento->toArray()];   
    }

    function buscarTodos()
    {
        $eventos = Evento::all();

        return ['Message' => 'Listando todos os eventos', 'eventos' => $eventos->toArray()];   
    }

    function deletar(string $id)
    {
        $evento = Evento::findOrFail($id);
        $evento->delete();

        return ['Message' => 'Evento deletado com ID: ' . $id];   
    }

    function atualizar(Request $request, string $id)
    {
        $validado = $request->validate([
            'nome' => [['sometimes', 'required', 'string', 'min:3']],
            'data_inicio' => [
                'sometimes',
                'required', 
                Rule::date()->format('Y-m-d H:i:s')
            ],
            'data_fim' => [
                'sometimes',
                'required', 
                Rule::date()->after('data_inicio')->format('Y-m-d H:i:s'),
                'after:data_inicio'
            ],
        ]);

        $evento = Evento::findOrFail($id);

        if (isset($validado['nome'])) {
            $evento->nome = $validado['nome'];
        }
        if (isset($validado['data_inicio'])) {
            $evento->data_inicio = $validado['data_inicio'];
        }
        if (isset($validado['data_fim'])) {
            $evento->data_fim = $validado['data_fim'];
        }

        $evento->save();

        return ['Message' => 'Evento atualizado com ID: ' . $id];   
    }

    
}

