@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <div>
      <h2 class="h5 mb-1 section-title"><i class="bi bi-clipboard2-pulse" aria-hidden="true"></i><span>Avaliações</span></h2>
      <small class="text-muted">Para registrar uma nova avaliação ou ver o gráfico de evolução de um aluno, use "Ver histórico" na linha dele, ou o botão "Nova Avaliação" na página do aluno em Usuários.</small>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th>Data</th>
          <th>Aluno</th>
          <th>Profissional</th>
          <th>Peso (kg)</th>
          <th>Altura (m)</th>
          <th class="text-end">Ações</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($avaliacoes as $avaliacao)
          <tr>
            <td>{{ optional($avaliacao->data_avaliacao)->format('d/m/Y') ?? '—' }}</td>
            <td>{{ $avaliacao->usuario->nome ?? '—' }}</td>
            <td>{{ $avaliacao->profissional->nome ?? 'Não informado' }}</td>
            <td>{{ $avaliacao->peso }}</td>
            <td>{{ $avaliacao->altura }}</td>
            <td class="text-end">
              @if ($avaliacao->usuario)
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('usuarios.show', $avaliacao->usuario) }}">Ver histórico</a>
              @endif
              <form action="{{ route('avaliacoes.destroy', $avaliacao) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-secondary btn-sm" onclick="return confirm('Excluir esta avaliação?')">Excluir</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center text-muted py-4">Nenhuma avaliação registrada ainda.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>
@endsection
