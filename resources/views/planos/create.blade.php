@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Novo Plano</h2>
  </div>
  <form method="POST" action="{{ route('planos.store') }}" class="p-3">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" value="{{ old('nome') }}">
      @error('nome') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Descrição</label>
      <textarea name="descricao" class="form-control">{{ old('descricao') }}</textarea>
      @error('descricao') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label for="valor" class="form-label">Valor</label>
      <input type="text"
      id="valor"
       name="valor"
        class="form-control"
        data-mask="money"
        inputmode="numeric"
        placeholder="R$ 0,00" value="{{ old('valor') }}">
      @error('valor') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Duração</label>
      <input type="text" name="duracao" class="form-control" value="{{ old('duracao') }}">
      @error('duracao') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <di class="mb-3">
      <label class="form-label">beneficios</label>
      <textarea name="beneficios" class="form-control">{{ old('beneficios') }}</textarea>
      @error('beneficios') <div class="text-danger small">{{ $message }}</div> @enderror
    </di>
    <button class="btn btn-primary" type="submit">Salvar</button>
    <a class="btn btn-secondary" href="{{ route('planos.index') }}">Cancelar</a>
  </form>
</section>
@endsection