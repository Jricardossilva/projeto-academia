<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function index()
    {
        $avaliacoes = Avaliacao::with(['usuario', 'profissional'])
            ->orderByDesc('data_avaliacao')
            ->get();

        return view('avaliacoes.index', ['avaliacoes' => $avaliacoes]);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'usuario_id'            => 'required|exists:usuarios,id',
            'profissional_id'       => 'nullable|exists:profissionais,id',
            'data_avaliacao'        => 'nullable|date',
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

        $dados['data_avaliacao'] = $dados['data_avaliacao'] ?? now()->toDateString();

        $avaliacao = Avaliacao::create($dados);

        // Primeira avaliação do aluno: libera a criação de um treino específico
        // (até aqui ele só tinha acesso ao treino genérico).
        $primeiraAvaliacao = Avaliacao::where('usuario_id', $dados['usuario_id'])->count() === 1;

        return redirect()
            ->route('usuarios.show', $dados['usuario_id'])
            ->with('success', $primeiraAvaliacao
                ? 'Avaliação registrada! O aluno já pode receber um treino específico.'
                : 'Avaliação registrada com sucesso!');
    }

    public function show(Avaliacao $avaliacao)
    {
        return redirect()->route('usuarios.show', $avaliacao->usuario_id);
    }

    public function destroy(Avaliacao $avaliacao)
    {
        $usuarioId = $avaliacao->usuario_id;
        $avaliacao->delete();

        return redirect()->route('usuarios.show', $usuarioId)->with('success', 'Avaliação removida.');
    }
}
