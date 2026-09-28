<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treino;
use App\Models\Usuario;
use App\Models\Profissional;


class TreinoController extends Controller
{
    public function index()
    {
        $treinos = Treino::all();
        return view('treinos.index', ['treinos' => $treinos]);
        // Lógica para listar todos os treinos
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
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'profissional_id' => 'required|exists:profissionais,id',
            'nome' => 'required|string|max:255'
            
        ]);

        Treino::create($request->all());

        return redirect()->route('treinos.index')->with('success', 'Treino criado com sucesso!');
    }

    public function edit(Treino $treino)
    {   
        $usuarios = Usuario::all();
        $profissionais = Profissional::all();

        return view('treinos.edit', compact('treino', 'usuarios', 'profissionais'));
    }   

    public function update(Request $request, Treino $treino)
    {   
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'profissional_id' => 'required|exists:profissionais,id',
            'nome' => 'required|string|max:255'
        ]);
        $treino->update($request->all());

        return redirect()->route('treinos.index')->with('success', 'Treino atualizado com sucesso!');
    }

    public function destroy(Treino $treino)
    {
        $treino->delete();
        return redirect()->route('treinos.index')->with('success', 'Treino deletado com sucesso!');
    }








}
