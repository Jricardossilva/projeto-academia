<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treino;
use App\Models\Usuario;
use App\Models\Profissional;
use App\Models\Avaliacao;
use App\Models\Exercicio;


class TreinoController extends Controller
{
    public function index()
    {
        $treinos = Treino::with(['usuario', 'profissional'])->get();
        return view('treinos.index', ['treinos' => $treinos]);
    }

    public function create()
    {
        $usuarios = Usuario::all();
        $profissionais = Profissional::all();

         return view('treinos.create', compact(
        'usuarios',
        'profissionais'
    ));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'profissional_id' => 'required|exists:profissionais,id',
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:generico,especifico',
        ]);

        if ($dados['tipo'] === 'especifico') {
            $temAvaliacao = Avaliacao::where('usuario_id', $dados['usuario_id'])->exists();
            if (! $temAvaliacao) {
                return back()->withInput()->withErrors([
                    'tipo' => 'Este aluno ainda não tem nenhuma avaliação registrada — só é possível criar um treino genérico.',
                ]);
            }
            $dados['avaliacao_id'] = Avaliacao::where('usuario_id', $dados['usuario_id'])->latest('data_avaliacao')->first()?->id;
        }

        Treino::create($dados);

        return redirect()->route('treinos.index')->with('success', 'Treino criado com sucesso!');
    }

    public function edit(Treino $treino)
    {
        $usuarios = Usuario::all();
        $profissionais = Profissional::all();
        $exercicios = Exercicio::orderBy('nome')->get();
        $treino->load('exercicios');

        return view('treinos.edit', compact('treino', 'usuarios', 'profissionais', 'exercicios'));
    }

    public function update(Request $request, Treino $treino)
    {
        $dados = $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'profissional_id' => 'required|exists:profissionais,id',
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:generico,especifico',
        ]);
        $treino->update($dados);

        return redirect()->route('treinos.index')->with('success', 'Treino atualizado com sucesso!');
    }

    public function destroy(Treino $treino)
    {
        $treino->delete();
        return redirect()->route('treinos.index')->with('success', 'Treino deletado com sucesso!');
    }

    public function attachExercicio(Request $request, Treino $treino)
    {
        $dados = $request->validate([
            'exercicio_id' => 'required|exists:execicios,id',
            'series' => 'required|integer|min:1',
            'repeticoes' => 'required|integer|min:1',
            'carga_kg' => 'nullable|numeric|min:0',
            'dia_semana' => 'required|string|max:255',
        ]);

        $treino->exercicios()->attach($dados['exercicio_id'], [
            'series' => $dados['series'],
            'repeticoes' => $dados['repeticoes'],
            'carga_kg' => $dados['carga_kg'] ?? null,
            'dia_semana' => $dados['dia_semana'],
        ]);

        return redirect()->route('treinos.edit', $treino)->with('success', 'Exercício adicionado ao treino.');
    }

    public function detachExercicio(Treino $treino, Exercicio $exercicio)
    {
        $treino->exercicios()->detach($exercicio->id);

        return redirect()->route('treinos.edit', $treino)->with('success', 'Exercício removido do treino.');
    }
}
