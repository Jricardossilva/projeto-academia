@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Editar Professor</h2>
  </div>
  <form method="POST" action="{{ route('professores.update', $professor) }}" class="p-3">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" value="{{ old('nome', $professor->nome) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">E-mail</label>
      <input type="email" name="email" class="form-control" value="{{ old('email', $professor->email) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">telefone</label>
      <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $professor->telefone) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Especialidade</label>
      <input type="text" name="especialidade" class="form-control" value="{{ old('especialidade', $professor->especialidade) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">data_de_contratacao</label>
        <input type="date" name="data_de_contratacao" class="form-control" value="{{ old('data_de_contratacao', $professor->data_de_contratacao) }}">
        @error('data_de_contratacao') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <button class="btn btn-primary" type="submit">Atualizar</button>
  </form>
</section>
@endsection