<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function store(Request $request)
    {
        $dados = $request->validate([
            'usuario_id'            => 'required|exists:usuarios,id',
            'peso'                  => 'required|numeric|min:0',
            'altura'                => 'required|numeric|min:0',
            'biceps_direito'        => 'nullable|numeric|min:0',
            'biceps_esquerdo'       => 'nullable|numeric|min:0',
            'antebraco_direito'     => 'nullable|numeric|min:0',
            'antebraco_esquerdo'    => 'nullable|numeric|min:0',
            'coxa_direita'          => 'nullable|numeric|min:0',
            'coxa_esquerda'         => 'nullable|numeric|min:0',
            'panturrilha_direita'   => 'nullable|numeric|min:0',
            'panturrilha_esquerda'  => 'nullable|numeric|min:0',
            'cintura'               => 'nullable|numeric|min:0',
        ]);
        
        Avaliacao::create($dados);



        return redirect()->route('usuarios.index')->with('success', 'Avaliação registrada com sucesso!');
    }
}
