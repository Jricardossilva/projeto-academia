@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <div>
      <h2 class="h5 mb-1 section-title"><i class="bi bi-people" aria-hidden="true"></i><span>Aulas</span></h2>
    </div>
    <a class="btn btn-primary btn-sm" href="{{ route('aulas.create') }}">Nova Aula</a>
     <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#avaliacaoModal">
                <i class="bi bi-clipboard2-pulse" aria-hidden="true"></i> Nova Avaliação
              </button>
  </div>
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Professor</th>
          <th class="text-end">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($aulas as $aula)
          <tr>
            <td>{{ $aula->nome }}</td>
            <td>{{ $aula->descricao }}</td>
            <td>{{ $aula->professor->nome ?? 'Não especificado' }}</td>
            <td class="text-end">
              <a class="btn btn-light btn-sm" href="{{ route('aulas.edit', $aula) }}">Editar</a>
              <form action="{{ route('aulas.destroy', $aula) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-secondary btn-sm" onclick="return confirm('Excluir esta aula?')">Excluir</button>
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
      <form id="avaliacaoForm" method="POST" action="#">
        @csrf
        <input type="hidden" name="aula_id" id="avaliacaoAulaId">

        <div class="modal-header">
          <h5 class="modal-title" id="avaliacaoModalLabel">Nova ficha de avaliação — <span id="avaliacaoAulaNome"></span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="avaliacaoData" class="form-label">Data da avaliação</label>
            <input type="date" class="form-control" id="avaliacaoData" name="data_avaliacao">
          </div>

          <div id="avaliacaoCamposAdicionais">
            {{-- Demais campos da ficha (peso, medidas, etc.) entram aqui --}}
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