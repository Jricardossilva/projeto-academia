@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Exercícios</h2>
  </div>
  <div class="table-responsive">
    <table class="table align-middle mb-0">
    <thead>
  <tr>
    <th>Nome</th>
    <th>Grupo muscular</th>
    <th>Descrição</th>
    <th class="text-end">Ações</th>
  </tr>
</thead>
<tbody>
  @foreach ($exercicios as $exercicio)
    <tr>
      <td>{{ $exercicio->nome }}</td>
      <td>{{ $exercicio->grupo_muscular }}</td>
      <td>{{ $exercicio->descricao }}</td>
      <td class="text-end">
        <a class="btn btn-light btn-sm" href="/exercicios/{{ $exercicio->id }}/editar">Editar</a>
      </td>
    </tr>
  @endforeach
</tbody>
    </table>
  </div>
</section>
@endsection