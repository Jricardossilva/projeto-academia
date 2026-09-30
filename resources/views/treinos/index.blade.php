@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <div>
      <h2 class="h5 mb-1 section-title"><i class="bi bi-people" aria-hidden="true"></i><span>Treinos</span></h2>
    </div>
    <a class="btn btn-primary btn-sm" href="{{ route('treinos.create') }}">Novo Treino</a>
  </div>
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th>Usuário</th>
          <th>Profissional</th>
          <th>Nome</th>
          <th>Tipo</th>
          <th class="text-end">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($treinos as $treino)
          <tr>
            <td>{{ $treino->usuario->nome }}</td>
            <td>{{ $treino->profissional->nome }}</td>
            <td>{{ $treino->nome }}</td>
            <td>
              <span class="badge {{ $treino->tipo === 'especifico' ? 'text-bg-success' : 'text-bg-secondary' }}">
                {{ $treino->tipo === 'especifico' ? 'Específico' : 'Genérico' }}
              </span>
            </td>
            <td class="text-end">
              <a class="btn btn-light btn-sm" href="{{ route('treinos.edit', $treino) }}">Editar</a>
              <form action="{{ route('treinos.destroy', $treino) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-secondary btn-sm" onclick="return confirm('Excluir este treino?')">Excluir</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</section>
@endsection
                