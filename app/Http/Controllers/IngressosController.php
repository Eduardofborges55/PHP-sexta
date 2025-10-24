<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingressos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class IngressosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listarIngressos(Request $request)
    {
        $filtro = $request->get('filtro');
        $consulta = Ingressos::where('evento_id', '=', $filtro)->get();

        $consulta = Ingressos::query();

        $consulta->where('evento_id', 'like', '%' . $filtro . '%');

        $ingressos = $consulta->get();

        dd($ingressos);

        return ['Message' => 'Listando os ingressos do sistema', 'ingressos' => $ingressos->toArray()];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function criarIngressos(Request $request)
    {
        $validado = $request->validate([
            'evento_id' => [['required', 'integer', 'exists:eventos,id']],
            'tipo' => [['required', Rule::in(['inteiro'])]],
            'valor' => [['nullable', 'numeric', 'min:0']],
            ]);

        $ingressos = new Ingressos();
        $ingressos->evento_id = $validado['evento_id'];
        $ingressos->tipo = $validado['tipo'];
        $ingressos->valor = $validado['valor'] ?? 0;
        $ingressos->save();

        return ['Message' => 'Criando um novo ingresso no sistema'];
    }

    /**
     * Display the specified resource.
     */
    public function removerIngressos(string $id)
    {
        return ['Message' => 'Removendo o ingresso com ID: ' . $id];
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateIngressos(Request $request, string $id)
    {
        $validado = $request->validate([
            'evento_id' => [['required', 'integer', 'exists:eventos,id']],
            'tipo' => [['required', Rule::in(['inteiro', 'meia'])]],
            'valor' => [['nullable', 'numeric', 'min:0']],
            ]);

        $ingressos = Ingressos::findOrFail($id);
        $ingressos->evento_id = $validado['evento_id'];
        $ingressos->tipo = $validado['tipo'];
        $ingressos->valor = $validado['valor'] ?? 0;
        $ingressos->save();

        return ['Message' => 'Atualizando o ingresso com ID: ' . $id];
    }

    public function BuscarIngressos(string $id)
    {
    // $consulta = Evento::query();

    // $consulta->where('id', $id);
    // $consulta->where('id', '>', 1);
    
    // $evento = $consulta->get()->first();

    // $evento = Evento::find($id);

    // $evento = Evento::findOrFail($id);

    // $evento = Evemto::torawsql

    $ingresso = Ingressos::findOrFail($id);

    return ['Message' => 'Ingresso encontrado com ID: ' . $id, 'evento' => $ingresso->toArray()];   
    }
    public function deletarIngressos(string $id)
    {
        $ingresso = Ingressos::findOrFail($id);
        $ingresso->delete();

        return ['Message' => 'Ingresso deletado com ID: ' . $id];   
    }

        public function listarTodosIngressos(Request $request)
        {
            return ['Message' => 'Listando todos os ingressos do sistema', 'ingressos' => Ingressos::get()->toArray()];
        }
        
        public function listarIngressosPorEvento($eventoId)
        {
            $ingressos = Ingressos::where('evento_id', $eventoId)->get();

            if ($ingressos->isEmpty()) {
                return response()->json(['message' => 'Nenhum ingresso encontrado para este evento.'], 404);
            }

            return response()->json([
                'message' => 'Ingressos encontrados para o evento ' . $eventoId,
                'ingressos' => $ingressos
            ], 200);
        }

        public function BuscarIngressosPorId($id)
        {
                $ingresso = Ingressos::find($id);

                if(!$ingresso) {
                    return response()->json(['message' => 'Ingresso não encontrado.'], 404);
                }

                return response()->json([
                    'message' => 'Ingresso encontrado com ID: ' . $id,
                    'ingresso' => $ingresso
                ], 200);
        }

    public function atualizarIngressos(Request $request, string $id)
    {
        $validado = $request->validate([
            'evento_id' => [['sometimes', 'required', 'integer', 'exists:eventos,id']],
            'tipo' => [['sometimes', 'required', Rule::in(['inteiro', 'meia'])]],
            'valor' => [['nullable', 'numeric', 'min:0']],
            ]);

        $ingressos = Ingressos::findOrFail($id);
        if (isset($validado['evento_id'])) {
            $ingressos->evento_id = $validado['evento_id'];
        }
        if (isset($validado['tipo'])) {
            $ingressos->tipo = $validado['tipo'];
        }
        if (isset($validado['valor'])) {
            $ingressos->valor = $validado['valor'];
        }
        $ingressos->save();

        return ['Message' => 'Atualizando o ingresso com ID: ' . $id];
    }
}

