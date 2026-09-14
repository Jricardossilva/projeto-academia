<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index()
    {
            return view('matriculas.index', [               
            'matriculas' => Matricula::all(),
        ]);
    }

    public function create()
    {
        return view('matriculas.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'usuario_id' => 'required',
            'plano_id' => 'required',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'status' => 'required|string',
        ]);

        Matricula::create($dados);

        return redirect()->route('matriculas.index');
    }

    public function show(Matricula $matricula)
    {
        return view('matriculas.show', compact('matricula'));
    }

    public function edit(Matricula $matricula)
    {
        return view('matriculas.edit', compact('matricula'));
    }

    public function update(Request $request, Matricula $matricula)
    {
        $dados = $request->validate([
            'usuario_id' => 'required',
            'plano_id' => 'required',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'status' => 'required|string',
        ]);

        $matricula->update($dados);

        return redirect()->route('matriculas.index');
    }

    public function destroy(Matricula $matricula)
    {
        $matricula->delete();

        return redirect()->route('matriculas.index');
    }
}

