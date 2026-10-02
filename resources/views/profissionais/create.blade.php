@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Novo Profissional</h2>
  </div>
  <form method="POST" action="{{ route('profissionais.store') }}" class="p-3">
    @csrf
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" value="{{ old('nome') }}">
      @error('nome') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label for="celular" class="form-label">Celular</label>
      <input type="text"
      id="celular"
       name="celular"
        class="form-control"
        data-mask="phone"
        inputmode="tel"
        maxlenght="15"
        placeholder="(00) 00000-0000"
        value="{{ old('celular') }}">
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
    <a class="btn btn-secondary" href="{{ route('profissionais.index') }}">Cancelar</a>
  </form>
</section>
@endsection