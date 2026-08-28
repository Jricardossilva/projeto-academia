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
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Termos</th>
          <th class="text-end">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($usuarios as $usuario)
          <tr>
            <td>{{ $usuario->nome }}</td>
            <td>{{ $usuario->email }}</td>
            <td>
              @if ($usuario->aceite_termos)
                <span class="badge text-bg-success">Aceito</span>
              @else
                <span class="badge text-bg-secondary">Pendente</span>
              @endif
            </td>
            <td class="text-end">
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
@endsection