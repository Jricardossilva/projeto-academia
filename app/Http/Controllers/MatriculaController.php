<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Usuario::all();
        return view('usuarios.index', ['usuarios' => $clientes]);
    }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'nome' => 'required|string',
            'email' => 'required|email|unique:usuarios,email',
            'cpf' => 'required|unique:usuarios,cpf',
            'senha' => 'required|min:6',
        ]);

        Cliente::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'senha' => Hash::make($request->senha),
            'aceite_termos' => $request->has('aceite_termos'),
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        public function edit(Cliente $cliente)
    return view('clientes.edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'nome' => 'required|string',
        'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
        'cpf' => 'required|unique:usuarios,cpf,' . $usuario->id,
    ]);

    $dados = [
        'nome' => $request->nome,
        'email' => $request->email,
        'cpf' => $request->cpf,
    ];

    if ($request->filled('senha')) {
        $dados['senha'] = Hash::make($request->senha);
    }

    $cliente->update($dados);

    return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente->delete();
    return redirect()->route('clientes.index')->with('success', 'Cliente removido com sucesso!');
}

