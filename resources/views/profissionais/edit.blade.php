@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Editar Profissional</h2>
  </div>
  <form method="POST" action="{{ route('profissionais.update', $profissional) }}" class="p-3">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" value="{{ old('nome', $profissional->nome) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Celular</label>
      <input type="text" name="celular" class="form-control" value="{{ old('celular', $profissional->celular) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Número de registro</label>
      <input type="text" name="numero_registro" class="form-control" value="{{ old('numero_registro', $profissional->numero_registro) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Especialização</label>
      <input type="text" name="especializacao" class="form-control" value="{{ old('especializacao', $profissional->especializacao) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Localização</label>
      <input type="text" name="localizacao" class="form-control" value="{{ old('localizacao', $profissional->localizacao) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Currículo</label>
      <textarea name="curriculo" class="form-control">{{ old('curriculo', $profissional->curriculo) }}</textarea>
    </div>
    <button class="btn btn-primary" type="submit">Atualizar</button>
    <a class="btn btn-secondary" href="{{ route('profissionais.index') }}">Cancelar</a>
  </form>
</section>
@endsection