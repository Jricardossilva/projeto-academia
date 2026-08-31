@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <div>
      <h2 class="h5 mb-1 section-title"><i class="bi bi-clipboard2-pulse" aria-hidden="true"></i><span>Fichas Esportivas</span></h2>
      <p class="text-muted mb-0">Lista de fichas cadastradas.</p>
    </div>
    <a class="btn btn-primary btn-sm" href="{{ route('fichas-esportivas.create') }}">Nova Ficha</a>
  </div>
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th>Usuário</th>
          <th>Tempo de prática</th>
          <th>Modalidade</th>
          <th>Frequência</th>
          <th>Nível</th>
          <th class="text-end">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($fichas as $ficha)
          <tr>
            <td>{{ $ficha->usuario->nome }}</td>
            <td>{{ $ficha->tempo_pratica }}</td>
            <td>{{ $ficha->modalidades }}</td>
            <td>{{ $ficha->frequencia }}</td>
            <td>{{ $ficha->nivel_experiencia }}</td>
            <td class="text-end">
              <a class="btn btn-light btn-sm" href="{{ route('fichas-esportivas.edit', $ficha) }}">Editar</a>
              <form action="{{ route('fichas-esportivas.destroy', $ficha) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-secondary btn-sm" onclick="return confirm('Excluir esta ficha?')">Excluir</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</section>
@endsection