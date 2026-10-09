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

  @if ($evolucao)
    @php $s = $evolucao['stats']; @endphp
    <div class="row g-3 p-3 pb-0">
      <div class="col-6 col-lg-3">
        <div class="border rounded p-3 h-100">
          <div class="text-uppercase text-muted small fw-bold">Peso atual</div>
          <div class="fs-4 fw-semibold">{{ $s['peso_atual'] }} kg</div>
          <div class="small {{ $s['peso_delta'] > 0 ? 'text-danger' : ($s['peso_delta'] < 0 ? 'text-success' : 'text-muted') }}">
            {{ $s['peso_delta'] > 0 ? '▲' : ($s['peso_delta'] < 0 ? '▼' : '—') }} {{ abs($s['peso_delta']) }} kg desde a 1ª avaliação
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="border rounded p-3 h-100">
          <div class="text-uppercase text-muted small fw-bold">IMC atual</div>
          <div class="fs-4 fw-semibold">{{ $s['imc_atual'] ?? '—' }}</div>
          @if ($s['imc_delta'] !== null)
            <div class="small {{ $s['imc_delta'] > 0 ? 'text-danger' : ($s['imc_delta'] < 0 ? 'text-success' : 'text-muted') }}">
              {{ $s['imc_delta'] > 0 ? '▲' : ($s['imc_delta'] < 0 ? '▼' : '—') }} {{ abs($s['imc_delta']) }} desde a 1ª avaliação
            </div>
          @endif
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="border rounded p-3 h-100">
          <div class="text-uppercase text-muted small fw-bold">Cintura atual</div>
          <div class="fs-4 fw-semibold">{{ $s['cintura_atual'] ?? '—' }} cm</div>
          @if ($s['cintura_delta'] !== null)
            <div class="small {{ $s['cintura_delta'] > 0 ? 'text-danger' : ($s['cintura_delta'] < 0 ? 'text-success' : 'text-muted') }}">
              {{ $s['cintura_delta'] > 0 ? '▲' : ($s['cintura_delta'] < 0 ? '▼' : '—') }} {{ abs($s['cintura_delta']) }} cm desde a 1ª avaliação
            </div>
          @endif
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="border rounded p-3 h-100">
          <div class="text-uppercase text-muted small fw-bold">Período acompanhado</div>
          <div class="fs-5 fw-semibold">{{ $s['periodo_inicio'] }} — {{ $s['periodo_fim'] }}</div>
          <div class="small text-muted">{{ $s['total'] }} avaliações registradas</div>
        </div>
      </div>
    </div>

    <div class="row g-3 p-3">
      <div class="col-12">
        <div class="border rounded p-3 h-100">
          <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
            <h6 class="text-muted small fw-bold mb-0">Evolução — <span id="metricaLabel">Peso (kg)</span></h6>
            <select id="seletorMetrica" class="form-select form-select-sm" style="max-width: 220px;">
              <option value="peso">Peso (kg)</option>
              <option value="imc">IMC (kg/m²)</option>
              <option value="cintura">Cintura (cm)</option>
            </select>
          </div>
          <canvas id="chartMetrica" height="100"></canvas>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="border rounded p-3 h-100">
          <h6 class="text-muted small fw-bold mb-2">Bíceps (cm)</h6>
          <canvas id="chartBiceps" height="160"></canvas>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="border rounded p-3 h-100">
          <h6 class="text-muted small fw-bold mb-2">Antebraço (cm)</h6>
          <canvas id="chartAntebraco" height="160"></canvas>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="border rounded p-3 h-100">
          <h6 class="text-muted small fw-bold mb-2">Coxa (cm)</h6>
          <canvas id="chartCoxa" height="160"></canvas>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="border rounded p-3 h-100">
          <h6 class="text-muted small fw-bold mb-2">Panturrilha (cm)</h6>
          <canvas id="chartPanturrilha" height="160"></canvas>
        </div>
      </div>
      <div class="col-12">
        <div class="border rounded p-3 h-100">
          <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
            <h6 class="text-muted small fw-bold mb-0">Comparativo: 1ª avaliação x avaliação mais recente (cm)</h6>
            <select id="seletorComparativo" class="form-select form-select-sm" style="max-width: 220px;">
              <option value="todas">Todas as medidas</option>
              <option value="superiores">Membros superiores</option>
              <option value="inferiores">Membros inferiores</option>
              <option value="cintura">Cintura</option>
            </select>
          </div>
          <canvas id="chartComparativo" height="110"></canvas>
        </div>
      </div>
    </div>
  @elseif ($usuario->avaliacoes->count() === 1)
    <div class="px-3 pt-3">
      <div class="alert alert-info mb-0">
        Este aluno tem apenas 1 avaliação registrada. Os gráficos de evolução aparecem aqui assim que houver uma <strong>reavaliação</strong> (2ª avaliação ou mais).
      </div>
    </div>
  @endif

  <div class="table-responsive mt-3">
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th>Data</th>
          <th>Peso (kg)</th>
          <th>Altura (cm)</th>
          <th>Cintura (cm)</th>
          <th>Bíceps D/E</th>
          <th>Antebraço D/E</th>
          <th>Coxa D/E</th>
          <th>Panturrilha D/E</th>
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
            <td>{{ $avaliacao->biceps_direito ?? '—' }} / {{ $avaliacao->biceps_esquerdo ?? '—' }}</td>
            <td>{{ $avaliacao->antebraco_direito ?? '—' }} / {{ $avaliacao->antebraco_esquerdo ?? '—' }}</td>
            <td>{{ $avaliacao->coxa_direita ?? '—' }} / {{ $avaliacao->coxa_esquerda ?? '—' }}</td>
            <td>{{ $avaliacao->panturrilha_direita ?? '—' }} / {{ $avaliacao->panturrilha_esquerda ?? '—' }}</td>
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
            <td colspan="10" class="text-center text-muted py-4">Nenhuma avaliação registrada ainda — este aluno está no treino genérico.</td>
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
              <label class="form-label">Altura (cm)</label>
              <input type="number" step="0.01" min="0" class="form-control" name="altura" required>
            </div>
            <div class="col-6">
              <label class="form-label">Cintura (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" name="cintura">
            </div>
            <div class="col-6">
              <label class="form-label">Bíceps direito (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" name="biceps_direito">
            </div>
            <div class="col-6">
              <label class="form-label">Bíceps esquerdo (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" name="biceps_esquerdo">
            </div>
            <div class="col-6">
              <label class="form-label">Antebraço direito (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" name="antebraco_direito">
            </div>
            <div class="col-6">
              <label class="form-label">Antebraço esquerdo (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" name="antebraco_esquerdo">
            </div>
            <div class="col-6">
              <label class="form-label">Coxa direita (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" name="coxa_direita">
            </div>
            <div class="col-6">
              <label class="form-label">Coxa esquerda (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" name="coxa_esquerda">
            </div>
            <div class="col-6">
              <label class="form-label">Panturrilha direita (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" name="panturrilha_direita">
            </div>
            <div class="col-6">
              <label class="form-label">Panturrilha esquerda (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" name="panturrilha_esquerda">
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

@if ($evolucao)
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
<script>
  const serie = @json($evolucao['series']);
  const comparativo = @json($evolucao['comparativo']);

  // Paleta categórica (ordem fixa, validada para contraste e daltonismo)
  const COR = {
    azul: '#2a78d6',
    laranja: '#eb6834',
    aqua: '#1baf7a',
  };

  Chart.defaults.font.family = "system-ui, -apple-system, 'Segoe UI', sans-serif";
  Chart.defaults.plugins.tooltip.mode = 'index';
  Chart.defaults.plugins.tooltip.intersect = false;
  Chart.defaults.interaction = { mode: 'index', intersect: false };

  function linha(id, label, dados, cor) {
    new Chart(document.getElementById(id), {
      type: 'line',
      data: {
        labels: serie.labels,
        datasets: [{
          label,
          data: dados,
          borderColor: cor,
          backgroundColor: cor,
          pointRadius: 4,
          pointHoverRadius: 6,
          borderWidth: 2,
          tension: 0.25,
        }],
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: false } },
      },
    });
  }

  function linhaDuas(id, dadosDireito, dadosEsquerdo) {
    new Chart(document.getElementById(id), {
      type: 'line',
      data: {
        labels: serie.labels,
        datasets: [
          {
            label: 'Direito',
            data: dadosDireito,
            borderColor: COR.azul,
            backgroundColor: COR.azul,
            pointRadius: 4,
            pointHoverRadius: 6,
            borderWidth: 2,
            tension: 0.25,
          },
          {
            label: 'Esquerdo',
            data: dadosEsquerdo,
            borderColor: COR.laranja,
            backgroundColor: COR.laranja,
            pointRadius: 4,
            pointHoverRadius: 6,
            borderWidth: 2,
            borderDash: [6, 3],
            tension: 0.25,
          },
        ],
      },
      options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } },
        scales: { y: { beginAtZero: false } },
      },
    });
  }

  linhaDuas('chartBiceps', serie.biceps_direito, serie.biceps_esquerdo);
  linhaDuas('chartAntebraco', serie.antebraco_direito, serie.antebraco_esquerdo);
  linhaDuas('chartCoxa', serie.coxa_direita, serie.coxa_esquerda);
  linhaDuas('chartPanturrilha', serie.panturrilha_direita, serie.panturrilha_esquerda);

  // Gráfico único (Peso / IMC / Cintura) trocado via select
  const METRICAS = {
    peso: { label: 'Peso (kg)', dados: serie.peso, cor: COR.azul },
    imc: { label: 'IMC (kg/m²)', dados: serie.imc, cor: COR.laranja },
    cintura: { label: 'Cintura (cm)', dados: serie.cintura, cor: COR.aqua },
  };

  const seletorMetrica = document.getElementById('seletorMetrica');
  const metricaLabel = document.getElementById('metricaLabel');
  const metricaInicial = METRICAS[seletorMetrica.value];

  const chartMetrica = new Chart(document.getElementById('chartMetrica'), {
    type: 'line',
    data: {
      labels: serie.labels,
      datasets: [{
        label: metricaInicial.label,
        data: metricaInicial.dados,
        borderColor: metricaInicial.cor,
        backgroundColor: metricaInicial.cor,
        pointRadius: 4,
        pointHoverRadius: 6,
        borderWidth: 2,
        tension: 0.25,
      }],
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: false } },
    },
  });

  seletorMetrica.addEventListener('change', () => {
    const escolhida = METRICAS[seletorMetrica.value];
    chartMetrica.data.datasets[0].label = escolhida.label;
    chartMetrica.data.datasets[0].data = escolhida.dados;
    chartMetrica.data.datasets[0].borderColor = escolhida.cor;
    chartMetrica.data.datasets[0].backgroundColor = escolhida.cor;
    chartMetrica.update();
    metricaLabel.textContent = escolhida.label;
  });

  // Gráfico comparativo (1ª x última), filtrável por grupo de medidas
  const GRUPOS_COMPARATIVO = {
    todas: { from: 0, to: 9 },
    superiores: { from: 0, to: 4 },  // Bíceps D/E, Antebraço D/E
    inferiores: { from: 4, to: 8 },  // Coxa D/E, Panturrilha D/E
    cintura: { from: 8, to: 9 },     // Cintura
  };

  function fatiaComparativo(grupo) {
    const { from, to } = GRUPOS_COMPARATIVO[grupo];
    return {
      labels: comparativo.labels.slice(from, to),
      primeira: comparativo.primeira.slice(from, to),
      ultima: comparativo.ultima.slice(from, to),
    };
  }

  const seletorComparativo = document.getElementById('seletorComparativo');
  const dadosComparativoIniciais = fatiaComparativo(seletorComparativo.value);

  const chartComparativo = new Chart(document.getElementById('chartComparativo'), {
    type: 'bar',
    data: {
      labels: dadosComparativoIniciais.labels,
      datasets: [
        { label: '1ª avaliação', data: dadosComparativoIniciais.primeira, backgroundColor: COR.azul, borderRadius: 4 },
        { label: 'Mais recente', data: dadosComparativoIniciais.ultima, backgroundColor: COR.laranja, borderRadius: 4 },
      ],
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'bottom' } },
      scales: { y: { beginAtZero: true } },
    },
  });

  seletorComparativo.addEventListener('change', () => {
    const dados = fatiaComparativo(seletorComparativo.value);
    chartComparativo.data.labels = dados.labels;
    chartComparativo.data.datasets[0].data = dados.primeira;
    chartComparativo.data.datasets[1].data = dados.ultima;
    chartComparativo.update();
  });
</script>
@endpush
@endif
@endsection
