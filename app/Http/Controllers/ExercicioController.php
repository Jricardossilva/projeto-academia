<?php

namespace App\Http\Controllers;
use App\Models\Exercicio;
use Illuminate\Http\Request;

class ExercicioController extends Controller
{
    public function index()
    {
        $exercicios = Exercicio::all();
        
        return view('exercicios.index', compact('exercicios'));
    }

   

public function create()
{
    // Só mostra o formulário, ainda não salva nada
    return view('exercicios.create');
}

{
  public function store(Request $request)
{
    // Valida os campos obrigatórios antes de salvar
    $dados = $request->validate([
        'nome' => 'required|string|max:255',
        'grupo_muscular' => 'required|string|max:255',
        'descricao' => 'nullable|string',
    ]);
    Exercicio::create($dados);
    // Depois de salvar, volta pra listagem
    return redirect('/exercicios');
}

public function edit(Exercicio $exercicio)
{
    // O Laravel já busca o exercício certo pelo id da URL
    return view('exercicios.edit', ['exercicio' => $exercicio]);
}

public function update(Request $request, Exercicio $exercicio)
{
    $dados = $request->validate([
        'nome' => 'required|string|max:255',
        'grupo_muscular' => 'required|string|max:255',
        'descricao' => 'nullable|string',
    ]);
    $exercicio->update($dados);
}// Volta pra listagem depois de salvar
    return redirect('/exercicios');
}

public function destroy(Exercicio $exercicio)
{
    // Deleta o exercício
    $exercicio->delete();

    // Volta pra listagem depois de deletar
    return redirect('/exercicios');

}

}
