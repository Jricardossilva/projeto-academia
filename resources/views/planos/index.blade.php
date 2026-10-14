@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <div>
      <h2 class="h5 mb-1 section-title">
        <span class="nav-icon">
          <img src="{{ asset('assets/images/png/planos.png') }}" alt="Planos" width="16" height="16">
        </span>
        <span>Planos</span>
      </h2>
    </div>
    @unless (auth()->user()->isConvidado())
      <a class="btn btn-primary btn-sm" href="{{ route('planos.create') }}">Novo Plano</a>
    @endunless
  </div>
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Valor</th>
          <th>Duração</th>
          <th>Ativo</th>
          <th class="text-end">Ações</th> 
        </tr>
      </thead>
      <tbody>
        @foreach ($planos as $plano)
          <tr>
            <td>{{ $plano->nome }}</td>
            <td> R$ {{ number_format($plano->valor, 2, ',', '.') }}</td>
            <td>{{ $plano->duracao }} meses</td> 
            <td>{{ $plano->ativo ? 'Sim' : 'Não' }}</td>
           
            <td class="text-end">
              @unless (auth()->user()->isConvidado())
              <a class="btn btn-light btn-sm" href="{{ route('planos.edit', $plano) }}">Editar</a>
              <form action="{{ route('planos.destroy', $plano) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-secondary btn-sm" onclick="return confirm('Excluir este plano?')">Excluir</button>
              </form>
              @endunless
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</section>
@endsection
