<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use Illuminate\Support\Facades\Log;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professores = Professor::all();
        return view('professores.index', ['professores' => $professores]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('professores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('teste');
        $request->validate([
            'nome' => 'required|string',
            'email' => 'required|email|unique:professores,email',
            'telefone' => 'required|string',
            'especialidade' => 'required|string',
            'data_de_contratacao' => 'required|date'
        ]);
        

        Professor::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'especialidade' => $request->especialidade,
            'data_de_contratacao' => $request->data_de_contratacao
        ]);

        return redirect()->route('professores.index')->with('success', 'Professor criado com sucesso!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professor $professor)
    {
        return view('professores.edit', ['professor' => $professor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Professor $professor)
    {
        $request->validate([
            'nome' => 'required|string',
            'email' => 'required|email|unique:professores,email,' . $professor->id,
            'telefone' => 'required|string',
            'especialidade' => 'required|string',
            'data_de_contratacao' => 'required|date'
        ]);

        $dados = [
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'especialidade' => $request->especialidade,
            'data_de_contratacao' => $request->data_de_contratacao
        ];

        $professor->update($dados);

        return redirect()->route('professores.index')->with('success', 'Professor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professor $professor)
    {
        $professor->delete();
        return redirect()->route('professores.index')->with('success', 'Professor deletado com sucesso!');
    }

    
}
