<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aula;
use App\Models\Professor;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aulas = Aula::with('professor')->get();
        return view('aulas.index', ['aulas' => $aulas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $professores = Professor::orderBy('nome')->get();
        return view('aulas.create', ['professores' => $professores]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'professor_id' => 'required|exists:professores,id',
            'dia_da_semana' => 'required|string|max:255',
            'horario_de_inicio' => 'required|date_format:H:i',
            'horario_de_termino' => 'required|date_format:H:i',
            'capacidade' => 'required|integer|min:1',
            'ativo' => 'boolean',
        ]);

        Aula::create($dados);

        return redirect()->route('aulas.index')->with('success', 'Aula criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aula = Aula::findOrFail($id);
        $professores = Professor::orderBy('nome')->get();
        return view('aulas.edit', ['aula' => $aula, 'professores' => $professores]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'professor_id' => 'required|exists:professores,id',
            'dia_da_semana' => 'required|string|max:255',
            'horario_de_inicio' => 'required|date_format:H:i',
            'horario_de_termino' => 'required|date_format:H:i',
            'capacidade' => 'required|integer|min:1',
            'ativo' => 'boolean',
        ]);

        $aula = Aula::findOrFail($id);
        $aula->update($dados);

        return redirect()->route('aulas.index')->with('success', 'Aula atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aula = Aula::findOrFail($id);
        $aula->delete();

        return redirect()->route('aulas.index')->with('success', 'Aula excluída com sucesso.');
    }
}
