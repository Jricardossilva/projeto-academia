<?php

namespace App\Http\Controllers;

use App\Models\Profissional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\hash;

class Profissionalcontroller extends Controller
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
            'email' => 'required|email|unique:profissionais,email',
            'cpf' => 'required|unique:profissionais,cpf',
            'senha' => 'required|min:6',
            'celular' => 'required|string',
            'numero_registro' => 'required|string',
            'especializacao' => 'required|string',
            'localizacao' => 'required|string',
        ]);
        Profissional::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'senha' => Hash::make($request->senha),
            'celular' => $request->celular,
            'numero_registro' => $request->numero_registro,
            'curriculo' => $request->curriculo,
            'especializacao' => $request->especializacao,
            'localizacao' => $request->localizacao,
            'aceite_termos' => $request->has('aceite_termos'),
        ]);
        return redirect()->route('profissionais.index')->with('success', 'Profissional cadastrado com sucesso!');
    }
}

