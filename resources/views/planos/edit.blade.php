@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Editar Plano</h2>
  </div>
  <form method="POST" action="{{ route('planos.update', $plano) }}" class="p-3">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" value="{{ old('nome', $plano->nome) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Valor</label>
      <input type="number" name="valor" class="form-control" value="{{ old('valor', $plano->valor) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Duração</label>
      <input type="text" name="duracao" class="form-control" value="{{ old('duracao', $plano->duracao) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Ativo</label>
      <input type="checkbox" name="ativo" class="form-control" value="{{ old('ativo', $plano->ativo) }}">
    </div>
    <button class="btn btn-primary" type="submit">Atualizar</button>
    <a class="btn btn-secondary" href="{{ route('planos.index') }}">Cancelar</a>
  </form>
</section>
@endsection 