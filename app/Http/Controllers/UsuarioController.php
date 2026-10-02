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
            'evolucao' => $this->dadosEvolucao($usuario),
        ]);
    }

    /**
     * Monta as séries e estatísticas usadas pelos gráficos de evolução do aluno.
     */
    private function dadosEvolucao(Usuario $usuario): ?array
    {
        $avaliacoes = $usuario->avaliacoes;

        if ($avaliacoes->count() < 2) {
            return null;
        }

        $imc = fn ($a) => $a->altura ? round($a->peso / ($a->altura ** 2), 1) : null;

        $primeira = $avaliacoes->first();
        $ultima = $avaliacoes->last();

        $medidas = [
            'biceps_direito' => 'Bíceps D',
            'biceps_esquerdo' => 'Bíceps E',
            'antebraco_direito' => 'Antebraço D',
            'antebraco_esquerdo' => 'Antebraço E',
            'coxa_direita' => 'Coxa D',
            'coxa_esquerda' => 'Coxa E',
            'panturrilha_direita' => 'Panturrilha D',
            'panturrilha_esquerda' => 'Panturrilha E',
            'cintura' => 'Cintura',
        ];

        return [
            'series' => [
                'labels' => $avaliacoes->map(fn ($a) => optional($a->data_avaliacao)->format('d/m/Y'))->values(),
                'peso' => $avaliacoes->map(fn ($a) => $a->peso)->values(),
                'imc' => $avaliacoes->map($imc)->values(),
                'cintura' => $avaliacoes->map(fn ($a) => $a->cintura)->values(),
                'biceps_direito' => $avaliacoes->map(fn ($a) => $a->biceps_direito)->values(),
                'biceps_esquerdo' => $avaliacoes->map(fn ($a) => $a->biceps_esquerdo)->values(),
                'antebraco_direito' => $avaliacoes->map(fn ($a) => $a->antebraco_direito)->values(),
                'antebraco_esquerdo' => $avaliacoes->map(fn ($a) => $a->antebraco_esquerdo)->values(),
                'coxa_direita' => $avaliacoes->map(fn ($a) => $a->coxa_direita)->values(),
                'coxa_esquerda' => $avaliacoes->map(fn ($a) => $a->coxa_esquerda)->values(),
                'panturrilha_direita' => $avaliacoes->map(fn ($a) => $a->panturrilha_direita)->values(),
                'panturrilha_esquerda' => $avaliacoes->map(fn ($a) => $a->panturrilha_esquerda)->values(),
            ],
            'comparativo' => [
                'labels' => array_values($medidas),
                'primeira' => array_map(fn ($campo) => $primeira->{$campo}, array_keys($medidas)),
                'ultima' => array_map(fn ($campo) => $ultima->{$campo}, array_keys($medidas)),
            ],
            'stats' => [
                'total' => $avaliacoes->count(),
                'periodo_inicio' => optional($primeira->data_avaliacao)->format('d/m/Y'),
                'periodo_fim' => optional($ultima->data_avaliacao)->format('d/m/Y'),
                'peso_atual' => $ultima->peso,
                'peso_delta' => round($ultima->peso - $primeira->peso, 1),
                'imc_atual' => $imc($ultima),
                'imc_delta' => $imc($ultima) !== null && $imc($primeira) !== null ? round($imc($ultima) - $imc($primeira), 1) : null,
                'cintura_atual' => $ultima->cintura,
                'cintura_delta' => ($ultima->cintura !== null && $primeira->cintura !== null) ? round($ultima->cintura - $primeira->cintura, 1) : null,
            ],
        ];
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
