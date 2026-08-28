<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{


public function index()
{
    $usuarios = Usuario::all();
    return view('usuarios.index', ['usuarios' => $usuarios]);
}

public function create()
{
    return view('usuarios.create');
}

public function store(Request $request)
{
    $request->validate([
        'nome' => 'required|string',
        'email' => 'required|email|unique:usuarios,email',
        'cpf' => 'required|unique:usuarios,cpf',
        'senha' => 'required|min:6',
    ]);

    Usuario::create([
        'nome' => $request->nome,
        'email' => $request->email,
        'cpf' => $request->cpf,
        'senha' => Hash::make($request->senha),
        'aceite_termos' => $request->has('aceite_termos'),
    ]);

    return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso!');
}
}
