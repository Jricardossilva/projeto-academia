<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Profissional;


class UsuarioController extends Controller
{

    public function index()
    {
        $usuarios = Usuario::all();
        $profissionais = Profissional::orderBy('nome')->get();
        return view('usuarios.index', ['usuarios' => $usuarios, 'profissionais' => $profissionais]);
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
            'tipo' => 'nullable|in:aluno,professor,admin',
        ]);

        Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'senha' => Hash::make($request->senha),
            'aceite_termos' => $request->has('aceite_termos'),
            'tipo' => $request->user()->isAdmin() ? ($request->tipo ?? 'aluno') : 'aluno',
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function show(Request $request, Usuario $usuario)
    {
        $logado = $request->user();

        if ($logado->isAluno() && $logado->id !== $usuario->id) {
            abort(403, 'Você só pode visualizar sua própria página.');
        }

        $usuario->load(['fichaEsportiva', 'avaliacoes', 'matriculas.plano']);
        $treinoAtual = $usuario->treinos()->with('exercicios')->latest()->first();

        return view('usuarios.show', [
            'usuario' => $usuario,
            'treinoAtual' => $treinoAtual,
            'matriculaAtiva' => $usuario->matriculas->firstWhere('status', 'ativa') ?? $usuario->matriculas->last(),
            'profissionais' => Profissional::orderBy('nome')->get(),
        ]);
    }

    public function edit(Usuario $usuario)
{
    return view('usuarios.edit', ['usuario' => $usuario]);
}

public function update(Request $request, Usuario $usuario)
{
    $request->validate([
        'nome' => 'required|string',
        'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
        'cpf' => 'required|unique:usuarios,cpf,' . $usuario->id,
        'tipo' => 'nullable|in:aluno,professor,admin',
    ]);

    $dados = [
        'nome' => $request->nome,
        'email' => $request->email,
        'cpf' => $request->cpf,
    ];

    if ($request->user()->isAdmin() && $request->filled('tipo')) {
        $dados['tipo'] = $request->tipo;
    }

    if ($request->filled('senha')) {
        $dados['senha'] = Hash::make($request->senha);
    }

    $usuario->update($dados);

    return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
}

public function destroy(Usuario $usuario)
{
    $usuario->delete();
    return redirect()->route('usuarios.index')->with('success', 'Usuário removido com sucesso!');
}
    
}
