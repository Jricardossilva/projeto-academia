@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Nova Matricula</h2>
  </div>
  <form method="POST" action="{{ route('matriculas.store') }}" class="p-3">
    @csrf
    <div class="mb-3">
      <label class="form-label">Usuário</label>
      <select name="usuario_id" class="form-control">
        @foreach ($usuarios as $usuario)
          <option value="{{ $usuario->id }}">{{ $usuario->nome }}</option>
        @endforeach
      </select>
      @error('usuario_id') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Plano</label>
      <select name="plano_id" class="form-control">
        @foreach ($planos as $plano)
          <option value="{{ $plano->id }}">{{ $plano->nome }}</option>
        @endforeach
      </select>
      @error('plano_id') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Data de Início</label>
      <input type="date" name="data_inicio" class="form-control" value="{{ old('data_inicio') }}">
      @error('data_inicio') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Data de Fim</label>
      <input type="date" name="data_fim" class="form-control" value="{{ old('data_fim') }}">
      @error('data_fim') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <button class="btn btn-primary" type="submit">Salvar</button>
    <a class="btn btn-secondary" href="{{ route('matriculas.index') }}">Cancelar</a>
  </form>
</section>
@endsection