<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aula;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aulas = Aula::all();
        return view('aulas.index', ['aulas' => $aulas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aulas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'professor' => 'required|string|max:255',
            'dia_semana' => 'required|string|max:255',
            'horario_inicio' => 'required|date_format:H:i',
            'horario_fim' => 'required|date_format:H:i',
            'capacidade' => 'required|integer|min:1',
            'status' => 'boolean'
        ]);

        Aula::create($request->all());

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
        return view('aulas.edit', ['aula' => $aula]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'professor' => 'required|string|max:255',
            'dia_semana' => 'required|string|max:255',
            'horario_inicio' => 'required|date_format:H:i',
            'horario_fim' => 'required|date_format:H:i',
            'capacidade' => 'required|integer|min:1',
            'status' => 'boolean'
        ]);

        $aula = Aula::findOrFail($id);
        $aula->update($request->all());

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
