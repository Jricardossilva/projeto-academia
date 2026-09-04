@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Novo Profissional</h2>
  </div>
  <form method="POST" action="{{ route('profissionais.store') }}" class="p-3">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" value="{{ old('nome') }}">
      @error('nome') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    </div>
    <div class="mb-3">
      <label class="form-label">Celular</label>
      <input type="text" name="celular" class="form-control" value="{{ old('celular') }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Número de registro</label>
      <input type="text" name="numero_registro" class="form-control" value="{{ old('numero_registro') }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Especialização</label>
      <input type="text" name="especializacao" class="form-control" value="{{ old('especializacao') }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Localização</label>
      <input type="text" name="localizacao" class="form-control" value="{{ old('localizacao') }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Currículo</label>
      <textarea name="curriculo" class="form-control">{{ old('curriculo') }}</textarea>
    </div>
    <button class="btn btn-primary" type="submit">Salvar</button>
  </form>
</section>
@endsection