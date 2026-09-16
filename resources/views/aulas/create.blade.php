@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Nova Aula</h2>
  </div>
  <form method="POST" action="{{ route('aulas.store') }}" class="p-3">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" value="{{ old('nome') }}">
      @error('nome') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">descrição</label>
      <input type="text" name="descricao" class="form-control" value="{{ old('descricao') }}">
      @error('descricao') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Professor</label>
      <input type="text" name="professor" class="form-control" value="{{ old('professor') }}">
      @error('professor') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">dia da semana</label>
      <input type="text" name="dia_semana" class="form-control" value="{{ old('dia_semana') }}">
      @error('dia_semana') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">horário de início</label>
      <input type="time" name="horario_inicio" class="form-control" value="{{ old('horario_inicio') }}">
      @error('horario_inicio') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">horário de fim</label>
      <input type="text" name="horario_fim" class="form-control" value="{{ old('horario_fim') }}">
      @error('horario_fim') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">capacidade</label>
      <input type="text" name="capacidade" class="form-control" value="{{ old('capacidade') }}">
      @error('capacidade') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <button class="btn btn-primary" type="submit">Salvar</button>
  </form>
</section>
@endsection