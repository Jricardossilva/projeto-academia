<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Planos;

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
        return view('matriculas.create', [
            'usuarios' => Usuario::all(),
            'planos' => Planos::all(),
        ]);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'usuario_id' => 'required',
            'plano_id' => 'required',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio'
        ]);

        Matricula::create($dados);

        return redirect()->route('matriculas.index');
    }

    public function edit(Matricula $matricula)
    {
        return view('matriculas.edit', [ 'usuarios' => Usuario::all() 
        ]);
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

