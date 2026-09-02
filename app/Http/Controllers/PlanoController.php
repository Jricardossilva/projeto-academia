<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planos = Plano::all();
        return view('planos.index', ['planos' => $planos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('planos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'descricao' => 'required|string',
            'preco' => 'required|min:5',
            'duracao' => 'required|integer',
            'beneficios' => 'required|string'
        ]);

        Plano::create($request->all());

        return redirect()->route('planos.index')->with('success', 'Plano criado com sucesso!');
    }

    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plano $plano)
    {
        return view('plano.edit', ['plano' => $plano]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plano $plano)
    {
        $request->validate([
            'nome' => 'required|string',
            'descricao' => 'required|string',
            'preco' => 'required|min:5',
            'duracao' => 'required|integer',
            'beneficios' => 'required|string'
        ]);

        $plano->update($request->all());

        return redirect()->route('planos.index')->with('success', 'Plano atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plano $plano)
    {
        $plano->delete();
        return redirect()->route('planos.index')->with('success', 'Plano removido com sucesso!');
    }
}

