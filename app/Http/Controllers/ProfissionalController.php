<?php

namespace App\Http\Controllers;

use App\Models\Profissional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 

class ProfissionalController extends Controller
{
    public function index()
    {
        $profissionais = Profissional::all();
        return view('profissionais.index', ['profissionais' => $profissionais]);
    }

    public function create()
    {
        return view('profissionais.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'celular' => 'required|string',
            'curriculo' => 'required|string',
            'numero_registro' => 'required|string',
            'especializacao' => 'required|string',
            'localizacao' => 'required|string',           
        ]);

        Profissional::create([
            'nome' => $request->nome,
            'celular' => $request->celular,
            'numero_registro' => $request->numero_registro,
            'curriculo' => $request->curriculo,
            'especializacao' => $request->especializacao,
            'localizacao' => $request->localizacao,
            'aceite_termos' => $request->has('aceite_termos')
        ]);
        return redirect()->route('profissionais.index')->with('success', 'Profissional cadastrado com sucesso!');
    }
        
    public function edit(Profissional $profissional)
    {
        return view('profissionais.edit', ['profissional' => $profissional]);
    }

    public function update(Request $request, Profissional $profissional)
    {
        
        $profissional->update($request->except(['senha', '_token', '_method']));

        return redirect()->route('profissionais.index')->with('success', 'Profissional atualizado com sucesso!');
    }

    public function destroy(Profissional $profissional)
    {
        $profissional->delete();
        return redirect()->route('profissionais.index')->with('success', 'Profissional removido com sucesso!');
    }
}

