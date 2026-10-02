<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planos;

class PlanoController extends Controller
{
    public function index()
    {
        $planos = Planos::all();
        return view('planos.index', ['planos' => $planos]);
    }

    public function create()
    {
        return view('planos.create');
    }

    public function store(Request $request)
    {
        $this->normalizarValor($request);

        $dados = $request->validate($this->regras());

        Planos::create($dados);

        return redirect()->route('planos.index')->with('success', 'Plano criado com sucesso!');
    }

    public function edit(Planos $plano)
    {
        return view('planos.edit', ['plano' => $plano]);
    }

    public function update(Request $request, Planos $plano)
    {
        $this->normalizarValor($request);

        $dados = $request->validate($this->regras());

        $plano->update($dados);

        return redirect()->route('planos.index')->with('success', 'Plano atualizado com sucesso!');
    }

    public function destroy(Planos $plano)
    {
        $plano->delete();
        return redirect()->route('planos.index')->with('success', 'Plano removido com sucesso!');
    }

    private function regras(): array
    {
        return [
            'nome' => 'required|string',
            'descricao' => 'required|string',
            'valor' => 'required|numeric|min:0.01',
            'duracao' => 'required|integer',
            'beneficios' => 'required|string',
        ];
    }

    /**
     * Converte "R$ 1.234,56" em "1234.56" antes da validação.
     */
    private function normalizarValor(Request $request): void
    {
        $valor = preg_replace('/[^\d,]/', '', (string) $request->valor); // "1234,56"
        $valor = str_replace(',', '.', $valor);                          // "1234.56"

        $request->merge(['valor' => $valor !== '' ? $valor : null]);
    }
}