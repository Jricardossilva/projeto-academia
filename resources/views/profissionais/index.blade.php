@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <div>
      <h2 class="h5 mb-1 section-title"><i class="bi bi-people" aria-hidden="true"></i><span>Profissionais</span></h2>
    </div>
    <a class="btn btn-primary btn-sm" href="{{ route('profissionais.create') }}">Novo Profissional</a>
  </div>
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Telefone</th>
          <th>especializacao</th>
          <th>Registro</th> 
          <th>Termos</th>
          <th class="text-end">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($profissionais as $profissional)
          <tr>
            <td>{{ $profissional->nome }}</td> 
            <td>{{ $profissional->celular }}</td>
            <td>{{ $profissional->especializacao }}</td>
            <td>{{ $profissional->numero_registro }}</td>
            <td>

              @if ($profissional->aceite_termos)
                <span class="badge text-bg-success">Aceito</span>
              @else
                <span class="badge text-bg-secondary">Pendente</span>
              @endif
            </td>
            <td class="text-end">
              <a class="btn btn-light btn-sm" href="{{ route('profissionais.edit', $profissional) }}">Editar</a>
              <form action="{{ route('profissionais.destroy', $profissional) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-secondary btn-sm" onclick="return confirm('Excluir este profissional?')">Excluir</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</section>
@endsection