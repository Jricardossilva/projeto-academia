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
      <label class="form-label">Descrição</label>
      <textarea name="descricao" class="form-control">{{ old('descricao', $plano->descricao) }}</textarea>
    </div>
    <div class="mb-3">
      <label for="valor"  class="form-label">Valor</label>
      <input type="text"
      id="valor"
       name="valor"
        class="form-control"
        data-mask="money"
        inputmode="numeric"
        placeholder="R$ 0,00" value="{{ old('valor', $plano->valor) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Duração (em meses)</label>
      <input type="number" name="duracao" class="form-control" value="{{ old('duracao', $plano->duracao) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Benefícios</label>
      <textarea name="beneficios" class="form-control">{{ old('beneficios', $plano->beneficios) }}</textarea>
    </div>
    
    <button class="btn btn-primary" type="submit">Atualizar</button>
    <a class="btn btn-secondary" href="{{ route('planos.index') }}">Cancelar</a>
  </form>
</section>
@endsection 