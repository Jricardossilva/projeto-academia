@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Novo Exercício</h2>
  </div>
  <form method="POST" action="/exercicios" class="p-3">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Grupo muscular</label>
      <input type="text" name="grupo_muscular" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Descrição</label>
      <textarea name="descricao" class="form-control"></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Salvar</button>
  </form>
</section>
@endsection