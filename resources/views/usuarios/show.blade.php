@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <div>
      <h2 class="h5 mb-1 section-title"><i class="bi bi-person-circle" aria-hidden="true"></i><span>{{ $usuario->nome }}</span></h2>
      <small class="text-muted">{{ $usuario->email }}</small>
    </div>
    @if (in_array(auth()->user()->tipo, ['admin', 'professor']))
      <a class="btn btn-light btn-sm" href="{{ route('usuarios.index') }}">Voltar</a>
    @endif
  </div>

  <div class="row g-3 p-3">
    <div class="col-md-4">
      <div class="border rounded p-3 h-100">
        <h6 class="text-uppercase text-muted small fw-bold">Ficha esportiva</h6>
        @if ($usuario->fichaEsportiva)
          <p class="mb-1"><strong>Modalidades:</strong> {{ $usuario->fichaEsportiva->modalidades }}</p>
          <p class="mb-1"><strong>Nível:</strong> {{ $usuario->fichaEsportiva->nivel_experiencia }}</p>
          <p class="mb-0"><strong>Objetivos:</strong> {{ $usuario->fichaEsportiva->objetivos }}</p>
        @else
          <p class="text-muted mb-0">Ainda não preenchida.</p>
        @endif
      </div>
    </div>

    <div class="col-md-4">
      <div class="border rounded p-3 h-100">
        <h6 class="text-uppercase text-muted small fw-bold">Matrícula</h6>
        @if ($matriculaAtiva)
          <p class="mb-1"><strong>Plano:</strong> {{ $matriculaAtiva->plano->nome ?? '—' }}</p>
          <p class="mb-1"><strong>Status:</strong> {{ $matriculaAtiva->status }}</p>
          <p class="mb-0"><strong>Início:</strong> {{ optional($matriculaAtiva->data_inicio)->format('d/m/Y') }}</p>
        @else
          <p class="text-muted mb-0">Sem matrícula registrada.</p>
        @endif
      </div>
    </div>

    <div class="col-md-4">
      <div class="border rounded p-3 h-100">
        <h6 class="text-uppercase text-muted small fw-bold">Treino atual</h6>
        @if ($treinoAtual)
          <p class="mb-1">
            <strong>{{ $treinoAtual->nome }}</strong>
            <span class="badge {{ $treinoAtual->tipo === 'especifico' ? 'text-bg-success' : 'text-bg-secondary' }}">
              {{ $treinoAtual->tipo === 'especifico' ? 'Específico' : 'Genérico' }}
            </span>
          </p>
          @forelse ($treinoAtual->exercicios as $exercicio)
            <div class="small text-muted">
              {{ $exercicio->nome }} — {{ $exercicio->pivot->series }}x{{ $exercicio->pivot->repeticoes }}
              @if ($exercicio->pivot->carga_kg) ({{ $exercicio->pivot->carga_kg }} kg) @endif
            </div>
          @empty
            <p class="text-muted small mb-0">Sem exercícios cadastrados neste treino.</p>
          @endforelse
          @if (in_array(auth()->user()->tipo, ['admin', 'professor']))
            <a class="btn btn-light btn-sm mt-2" href="{{ route('treinos.edit', $treinoAtual) }}">Gerenciar treino</a>
          @endif
        @else
          <p class="text-muted mb-0">Nenhum treino atribuído ainda.</p>
        @endif
      </div>
    </div>
  </div>
</section>

<section class="panel mt-3">
  <div class="panel-header">
    <div>
      <h2 class="h5 mb-1 section-title"><i class="bi bi-clipboard2-pulse" aria-hidden="true"></i><span>Histórico de avaliações</span></h2>
    </div>
    @if (in_array(auth()->user()->tipo, ['admin', 'professor']))
      <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#avaliacaoModal" data-usuario-id="{{ $usuario->id }}" data-usuario-nome="{{ $usuario->nome }}">
        <i class="bi bi-plus-lg" aria-hidden="true"></i> Nova Avaliação
      </button>
    @endif
  </div>

  @if ($usuario->avaliacoes->count() >= 2)
    <div class="p-3">
      <canvas id="evolucaoPeso" height="80"></canvas>
    </div>
  @endif

  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th>Data</th>
          <th>Peso (kg)</th>
          <th>Altura (m)</th>
          <th>Cintura (cm)</th>
          <th>Profissional</th>
          @if (in_array(auth()->user()->tipo, ['admin', 'professor']))
            <th class="text-end">Ações</th>
          @endif
        </tr>
      </thead>
      <tbody>
        @forelse ($usuario->avaliacoes as $avaliacao)
          <tr>
            <td>{{ optional($avaliacao->data_avaliacao)->format('d/m/Y') ?? '—' }}</td>
            <td>{{ $avaliacao->peso }}</td>
            <td>{{ $avaliacao->altura }}</td>
            <td>{{ $avaliacao->cintura ?? '—' }}</td>
            <td>{{ $avaliacao->profissional->nome ?? 'Não informado' }}</td>
            @if (in_array(auth()->user()->tipo, ['admin', 'professor']))
              <td class="text-end">
                <form action="{{ route('avaliacoes.destroy', $avaliacao) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-outline-secondary btn-sm" onclick="return confirm('Excluir esta avaliação?')">Excluir</button>
                </form>
              </td>
            @endif
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center text-muted py-4">Nenhuma avaliação registrada ainda — este aluno está no treino genérico.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>

@if (in_array(auth()->user()->tipo, ['admin', 'professor']))
<div class="modal fade" id="avaliacaoModal" tabindex="-1" aria-labelledby="avaliacaoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <form method="POST" action="{{ route('avaliacoes.store') }}">
        @csrf
        <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">

        <div class="modal-header">
          <h5 class="modal-title" id="avaliacaoModalLabel">Nova ficha de avaliação — {{ $usuario->nome }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>

        <div class="modal-body">
          <div class="row g-3 mb-3">
            <div class="col-6">
              <label class="form-label">Data da avaliação</label>
              <input type="date" class="form-control" name="data_avaliacao" value="{{ now()->toDateString() }}">
            </div>
            <div class="col-6">
              <label class="form-label">Profissional responsável</label>
              <select class="form-select" name="profissional_id">
                <option value="">Não informado</option>
                @foreach ($profissionais as $profissional)
                  <option value="{{ $profissional->id }}">{{ $profissional->nome }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-6">
              <label class="form-label">Peso (kg)</label>
              <input type="number" step="0.1" min="0" class="form-control" name="peso" required>
            </div>
            <div class="col-6">
              <label class="form-label">Altura (m)</label>
              <input type="number" step="0.1" min="0" class="form-control" name="altura" required>
            </div>
            <div class="col-6">
              <label class="form-label">Cintura (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" name="cintura">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endif

@if ($usuario->avaliacoes->count() >= 2)
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
<script>
  const avaliacoes = @json($usuario->avaliacoes->map(fn($a) => [
      'data' => optional($a->data_avaliacao)->format('d/m/Y'),
      'peso' => $a->peso,
  ]));

  new Chart(document.getElementById('evolucaoPeso'), {
    type: 'line',
    data: {
      labels: avaliacoes.map(a => a.data),
      datasets: [{
        label: 'Peso (kg)',
        data: avaliacoes.map(a => a.peso),
        borderColor: '#0d6efd',
        tension: 0.2,
      }],
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
    },
  });
</script>
@endpush
@endif
@endsection
