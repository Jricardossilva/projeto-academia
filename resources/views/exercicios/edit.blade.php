@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Editar Exercício</h2>
  </div>
  <form method="POST" action="{{ route('exercicios.update', $exercicio) }}" class="p-3">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" value="{{ old('nome', $exercicio->nome) }}">
      @error('nome') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Grupo muscular</label>
      <input type="text" name="grupo_muscular" class="form-control" value="{{ old('grupo_muscular', $exercicio->grupo_muscular) }}">
      @error('grupo_muscular') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Descrição</label>
      <textarea name="descricao" class="form-control">{{ old('descricao', $exercicio->descricao) }}</textarea>
      @error('descricao') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <button class="btn btn-primary" type="submit">Atualizar</button>
    <a class="btn btn-secondary" href="{{ route('exercicios.index') }}">Cancelar</a>
  </form>
</section>
@endsection
