@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <div>
      <h2 class="h5 mb-1 section-title"><i class="bi bi-people" aria-hidden="true"></i><span>Aulas</span></h2>
    </div>
    <a class="btn btn-primary btn-sm" href="{{ route('aulas.create') }}">Nova Aula</a>
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
@endsection
