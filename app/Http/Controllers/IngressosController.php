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
    public function removerIngressos(string $evento_id)
    {
        return ['Message' => 'Removendo o ingresso com ID: ' . $evento_id];
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateIngressos(Request $request, string $evento_id)
    {
        //
    }

    public function BuscarIngressos(string $evento_id)
    {
    // $consulta = Evento::query();

    // $consulta->where('id', $id);
    // $consulta->where('id', '>', 1);
    
    // $evento = $consulta->get()->first();

    // $evento = Evento::find($id);

    // $evento = Evento::findOrFail($id);

    // $evento = Evemto::torawsql

    $ingresso = Ingressos::findOrFail($evento_id);

    return ['Message' => 'Ingresso encontrado com ID: ' . $evento_id, 'evento' => $ingresso->toArray()];   
    }
}

