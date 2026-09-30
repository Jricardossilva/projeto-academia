@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Nova Ficha Esportiva</h2>
  </div>
  <form method="POST" action="{{ route('fichas-esportivas.store') }}" class="p-3">
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
      <label class="form-label">Tempo de prática</label>
      <input type="text" name="tempo_pratica" class="form-control" value="{{ old('tempo_pratica') }}">
      @error('tempo_pratica') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Modalidade</label>
      <input type="text" name="modalidades" class="form-control" value="{{ old('modalidades') }}">
      @error('modalidades') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Frequência</label>
      <input type="text" name="frequencia" class="form-control" value="{{ old('frequencia') }}">
      @error('frequencia') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Nível de experiência</label>
      <input type="text" name="nivel_experiencia" class="form-control" value="{{ old('nivel_experiencia') }}">
      @error('nivel_experiencia') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Objetivos</label>
      <textarea name="objetivos" class="form-control">{{ old('objetivos') }}</textarea>
    </div>
    <button class="btn btn-primary" type="submit">Salvar</button>
    <a class="btn btn-secondary" href="{{ route('fichas-esportivas.index') }}">Cancelar</a>
  </form>
</section>
@endsection