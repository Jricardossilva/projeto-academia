@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <div>
      <h2 class="h5 mb-1 section-title"><i class="bi bi-people" aria-hidden="true"></i><span>Matriculas</span></h2>
    </div>
    <a class="btn btn-primary btn-sm" href="{{ route('matriculas.create') }}">Nova Matricula</a>
  </div>
  <div class="table-responsive">

    <table class="table align-middle mb-0">
      <thead>
        <tr>
            <th>Nome</th>
            <th>Plano</th>
            <th>Data inicio</th>
            <th>Data fim</th>
          <th class="text-end">Ações</th> 
        </tr>
      </thead>
      <tbody>
        @foreach ($matriculas as $matriculas) 
          <tr>
            <td>{{ $matricula->nome }}</td>
            <td>{{ $matricula->plano }}</td>
            <td>{{ $matricula->data_inicio }}</td>
            <td>{{ $matricula->data_fim }}</td>
            <td class="text-end">
              <a class="btn btn-light btn-sm" href="{{ route('matriculas.edit', $matricula) }}">Editar</a>
              <form action="{{ route('matriculas.destroy', $matricula) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-secondary btn-sm" onclick="return confirm('Excluir este cliente?')">Excluir</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</section>
@endsection