@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <div>
      <h2 class="h5 mb-1 section-title"><i class="bi bi-people" aria-hidden="true"></i><span>Usuários</span></h2>
    </div>
    <a class="btn btn-primary btn-sm" href="{{ route('usuarios.create') }}">Novo Usuário</a>
  </div>
  <div class="table-responsive">
    <table class="table align-middle text-center mb-0">
      <thead>
        <tr>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Tipo</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($usuarios as $usuario)
          <tr>
            <td>{{ $usuario->nome }}</td>
            <td>{{ $usuario->email }}</td>
            <td>
              @if ($usuario->tipo === 'admin')
                <span class="badge bg-primary">Administrador</span>
              @elseif ($usuario->tipo === 'professor')
                <span class="badge bg-success">Professor</span>
              @elseif ($usuario->tipo === 'aluno')
                <span class="badge bg-info">Aluno</span>
              @else
                <span class="badge bg-secondary">{{ ucfirst($usuario->tipo) }}</span>
              @endif
            </td>
            <td class="text-end">
              <a class="btn btn-outline-secondary btn-sm" href="{{ route('usuarios.show', $usuario) }}">Ver</a>
              <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#avaliacaoModal" data-usuario-id="{{ $usuario->id }}" data-usuario-nome="{{ $usuario->nome }}">
                <i class="bi bi-clipboard2-pulse" aria-hidden="true"></i> Nova Avaliação
              </button>
              <a class="btn btn-light btn-sm" href="{{ route('usuarios.edit', $usuario) }}">Editar</a>
              <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-secondary btn-sm" onclick="return confirm('Excluir este usuário?')">Excluir</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</section>

<div class="modal fade" id="avaliacaoModal" tabindex="-1" aria-labelledby="avaliacaoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <form id="avaliacaoForm" method="POST" action="{{ route('avaliacoes.store') }}">
        @csrf
        <input type="hidden" name="usuario_id" id="avaliacaoUsuarioId">

        <div class="modal-header">
          <h5 class="modal-title" id="avaliacaoModalLabel">
            <i class="bi bi-clipboard2-pulse" aria-hidden="true"></i>
            Nova ficha de avaliação — <span id="avaliacaoUsuarioNome" class="text-primary"></span>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>

        <div class="modal-body">

          <h6 class="text-uppercase text-muted small fw-bold mb-3">Dados gerais</h6>
          <div class="row g-3 mb-4">
            <div class="col-6">
              <label for="data_avaliacao" class="form-label">Data da avaliação</label>
              <input type="date" class="form-control" id="data_avaliacao" name="data_avaliacao" value="{{ now()->toDateString() }}">
            </div>
            <div class="col-6">
              <label for="profissional_id" class="form-label">Profissional responsável</label>
              <select class="form-select" id="profissional_id" name="profissional_id">
                <option value="">Não informado</option>
                @foreach ($profissionais as $profissional)
                  <option value="{{ $profissional->id }}">{{ $profissional->nome }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-6">
              <label for="peso" class="form-label">Peso (kg)</label>
              <input type="number" step="0.1" min="0" class="form-control" id="peso" name="peso" required>
            </div>
            <div class="col-6">
              <label for="altura" class="form-label">Altura (m)</label>
              <input type="number" step="0.1" min="0" class="form-control" id="altura" name="altura" required>
            </div>
          </div>

          <h6 class="text-uppercase text-muted small fw-bold mb-3">Membros superiores</h6>
          <div class="row g-3 mb-4">
            <div class="col-6">
              <label for="biceps_direito" class="form-label">Bíceps direito (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" id="biceps_direito" name="biceps_direito">
            </div>
            <div class="col-6">
              <label for="biceps_esquerdo" class="form-label">Bíceps esquerdo (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" id="biceps_esquerdo" name="biceps_esquerdo">
            </div>
            <div class="col-6">
              <label for="antebraco_direito" class="form-label">Antebraço direito (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" id="antebraco_direito" name="antebraco_direito">
            </div>
            <div class="col-6">
              <label for="antebraco_esquerdo" class="form-label">Antebraço esquerdo (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" id="antebraco_esquerdo" name="antebraco_esquerdo">
            </div>
          </div>

          <h6 class="text-uppercase text-muted small fw-bold mb-3">Membros inferiores</h6>
          <div class="row g-3 mb-4">
            <div class="col-6">
              <label for="coxa_direita" class="form-label">Coxa direita (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" id="coxa_direita" name="coxa_direita">
            </div>
            <div class="col-6">
              <label for="coxa_esquerda" class="form-label">Coxa esquerda (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" id="coxa_esquerda" name="coxa_esquerda">
            </div>
            <div class="col-6">
              <label for="panturrilha_direita" class="form-label">Panturrilha direita (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" id="panturrilha_direita" name="panturrilha_direita">
            </div>
            <div class="col-6">
              <label for="panturrilha_esquerda" class="form-label">Panturrilha esquerda (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" id="panturrilha_esquerda" name="panturrilha_esquerda">
            </div>
          </div>

          <h6 class="text-uppercase text-muted small fw-bold mb-3">Tronco</h6>
          <div class="row g-3">
            <div class="col-6">
              <label for="cintura" class="form-label">Cintura (cm)</label>
              <input type="number" step="0.1" min="0" class="form-control" id="cintura" name="cintura">
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg" aria-hidden="true"></i> Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<script>
  document.getElementById('avaliacaoModal').addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    document.getElementById('avaliacaoUsuarioId').value = button.getAttribute('data-usuario-id');
    document.getElementById('avaliacaoUsuarioNome').textContent = button.getAttribute('data-usuario-nome');
  });
</script>
@endpush
@endsection