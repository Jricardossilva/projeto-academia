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

public function store(Request $request)
{
    // Pega tudo que veio do formulário e cria um novo exercício
    Exercicio::create($request->only(['nome', 'grupo_muscular', 'descricao']));

    // Depois de salvar, volta pra listagem
    return redirect('/exercicios');
}
}
