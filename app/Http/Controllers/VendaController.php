<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendaRequest;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;
use App\Models\Venda;

class VendaController extends Controller
{
    public function criarVenda(VendaRequest $request)
    {
        $validado = $request->validated();
        
        $venda = new Venda();
        $venda->ingresso_id = $validado['ingresso_id'];
        $venda->evento_id = $validado['evento_id'];
        $venda->valor = $validado['valor'];
        $venda->documento_comprador = $validado['documento_comprador'];
        $venda->save();

        return ['Message' => 'Venda criada com sucesso!'];
    }
}
