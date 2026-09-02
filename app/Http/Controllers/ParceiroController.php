<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParceiroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parceiros =parceiros::all();
        return view('parceiros.index', ['parceiros' => $parceiros
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        returmn view('parceiros.create');
        
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'descricao' => 'required|string',
            'telefone' => 'required|string',
            'email' => 'required|email',
            'beneficio_oferecido' => 'required|string',
            'ativo' => 'required|boolean',
        ]);

        Parceiro::create($request->all());

        return redirect()->route('parceiros.index')->with('success', 'Parceiro criado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parceiro $parceiro)
    {
        return view('parceiros.edit', ['parceiro' => $parceiro]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parceiro $parceiro)
    {
        $request->validate([
            'nome' => 'required|string',
            'descricao' => 'required|string',
            'telefone' => 'required|string',
            'email' => 'required|email',
            'beneficio_oferecido' => 'required|string',
            'ativo' => 'required|boolean',
        ]);

        $parceiro->update($request->all());

        return redirect()->route('parceiros.index')->with('success', 'Parceiro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parceiro $parceiro)
    {
        $parceiro->delete();

        return redirect()->route('parceiros.index')->with('success', 'Parceiro excluído com sucesso!');
    }
}
