@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <div>
      <h2 class="h5 mb-1 section-title"><i class="bi bi-people" aria-hidden="true"></i><span>Professores</span></h2>
    </div>
    <a class="btn btn-primary btn-sm" href="{{ route('professores.create') }}">Novo Professor</a>
  </div>
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Especialidade</th>
          <th class="text-end">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($professores as $professor)
          <tr>
            <td>{{ $professor->nome }}</td>
            <td>{{ $professor->email }}</td>
            <td>{{ $professor->especialidade }}</td>
            <td class="text-end">
              <a class="btn btn-light btn-sm" href="{{ route('professores.edit', $professor) }}">Editar</a>
              <form action="{{ route('professores.destroy', $professor) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-secondary btn-sm" onclick="return confirm('Excluir este professor?')">Excluir</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</section>
@endsection
