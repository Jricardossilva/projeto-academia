@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <div>
      <h2 class="h5 mb-1 section-title">
        <span class="nav-icon">
          <img src="{{ asset('assets/images/png/parceiros.png') }}" alt="Parceiros" width="16" height="16">
        </span>
        <span>Parceiros</span>
      </h2>
    </div>
    @unless (auth()->user()->isConvidado())
      <a class="btn btn-primary btn-sm" href="{{ route('parceiros.create') }}">Novo Parceiro</a>
    @endunless
  </div>
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Telefone</th>
          <th>Email</th>
          <th class="text-end">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($parceiros as $parceiro)
          <tr>
            <td>{{ $parceiro->nome }}</td>
            <td>{{ $parceiro->descricao }}</td>
            <td>{{ $parceiro->telefone }}</td>
            <td>{{ $parceiro->email }}</td>
            <td class="text-end">
              @unless (auth()->user()->isConvidado())
              <a class="btn btn-light btn-sm" href="{{ route('parceiros.edit', $parceiro) }}">Editar</a>
              <form action="{{ route('parceiros.destroy', $parceiro) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-secondary btn-sm" onclick="return confirm('Excluir este parceiro?')">Excluir</button>
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