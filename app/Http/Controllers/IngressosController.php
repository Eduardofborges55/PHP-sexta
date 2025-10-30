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
    /**
     * Listar todos os ingressos do sistema
     */
    public function listarTodosIngressos()
    {
        $ingressos = Ingressos::all();

        return response()->json([
            'message' => 'Listando todos os ingressos do sistema',
            'ingressos' => $ingressos
        ], 200);
    }

    /**
     * Listar ingressos de um evento específico
     */
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

    /**
     * Buscar um ingresso por ID
     */
    public function buscarIngressoPorId($id)
    {
        $ingresso = Ingressos::find($id);

        if (!$ingresso) {
            return response()->json(['message' => 'Ingresso não encontrado.'], 404);
        }

        return response()->json([
            'message' => 'Ingresso encontrado com ID: ' . $id,
            'ingresso' => $ingresso
        ], 200);
    }

    /**
     * Criar um novo ingresso
     */
    public function criarIngressos(Request $request)
    {
        $validado = $request->validate([
            'evento_id' => ['required', 'integer', 'exists:eventos,id'],
            'tipo' => ['required', Rule::in(['inteiro', 'meia'])],
            'valor' => ['required', 'numeric', 'min:0'],
        ]);


        $ingresso = new Ingressos();
        $ingresso->evento_id = $validado['evento_id'];
        $ingresso->tipo = $validado['tipo'];
        $ingresso->valor = $validado['valor'];
        $ingresso->save();

        return ['Message' => 'Ingresso criado com sucesso!'];
    }      
    

    /**
     * Atualizar um ingresso existente
     */
    public function atualizarIngressos(Request $request, $id)
    {
        $ingresso = Ingressos::findOrFail($id);

        $validado = $request->validate([
            'evento_id' => ['sometimes', 'required', 'integer', 'exists:eventos,id'],
            'tipo' => ['sometimes', 'required', Rule::in(['inteiro', 'meia'])],
            'valor' => ['nullable', 'numeric', 'min:0'],
        ]);

       $ingresso = new Ingressos();
        if (isset($validado['evento_id'])) {
            $ingresso->evento_id = $validado['evento_id'];
        }
        if (isset($validado['tipo'])) {
            $ingresso->tipo = $validado['tipo'];
        }
        if (isset($validado['valor'])) {
            $ingresso->valor = $validado['valor'];
        }
        $ingresso->save();

        return ['Message' => 'Ingresso atualizado com sucesso!'];
    }

    /**
     * Deletar um ingresso
     */
    public function deletarIngressos($id)
    {
        $ingresso = Ingressos::findOrFail($id);
        $ingresso->delete();

        return response()->json(['message' => 'Ingresso deletado com sucesso.'], 200);
    }
}

?>