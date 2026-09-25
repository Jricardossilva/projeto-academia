<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planos;

class PlanoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planos = Planos::all();
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
            'valor' => 'required|min:5',
            'duracao' => 'required|integer',
            'beneficios' => 'required|string'
        ]);

        Planos::create($request->all());

        return redirect()->route('planos.index')->with('success', 'Plano criado com sucesso!');
    }

    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Planos $plano)
    {
        return view('planos.edit', ['plano' => $plano]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Planos $plano)
    {
        $request->validate([
            'nome' => 'required|string',
            'descricao' => 'required|string',
            'valor' => 'required|min:5',
            'duracao' => 'required|integer',
            'beneficios' => 'required|string'
        ]);

        $plano->update($request->all());

        return redirect()->route('planos.index')->with('success', 'Plano atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Planos $plano)
    {
        $plano->delete();
        return redirect()->route('planos.index')->with('success', 'Plano removido com sucesso!');
    }
}

