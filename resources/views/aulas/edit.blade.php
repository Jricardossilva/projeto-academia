@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Editar Aula</h2>
  </div>
  <form method="POST" action="{{ route('aulas.update', $aula) }}" class="p-3">
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
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" value="{{ old('nome', $aula->nome) }}">
      @error('nome') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Descrição</label>
      <input type="text" name="descricao" class="form-control" value="{{ old('descricao', $aula->descricao) }}">
      @error('descricao') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Professor</label>
      <select name="professor_id" class="form-select">
        <option value="">Selecione...</option>
        @foreach ($professores as $professor)
          <option value="{{ $professor->id }}" @selected(old('professor_id', $aula->professor_id) == $professor->id)>{{ $professor->nome }}</option>
        @endforeach
      </select>
      @error('professor_id') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Dia da Semana</label>
      <input type="text" name="dia_da_semana" class="form-control" value="{{ old('dia_da_semana', $aula->dia_da_semana) }}">
      @error('dia_da_semana') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Horário de Início</label>
      <input type="time" name="horario_de_inicio" class="form-control" value="{{ old('horario_de_inicio', $aula->horario_de_inicio) }}">
      @error('horario_de_inicio') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Horário de Término</label>
      <input type="time" name="horario_de_termino" class="form-control" value="{{ old('horario_de_termino', $aula->horario_de_termino) }}">
      @error('horario_de_termino') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Capacidade</label>
      <input type="text" name="capacidade" class="form-control" value="{{ old('capacidade', $aula->capacidade) }}">
      @error('capacidade') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3 form-check">
      <input type="hidden" name="ativo" value="0">
      <input type="checkbox" name="ativo" value="1" class="form-check-input" id="ativo" @checked(old('ativo', $aula->ativo))>
      <label class="form-check-label" for="ativo">Ativo</label>
    </div>
    <button class="btn btn-primary" type="submit">Atualizar</button>
    <a class="btn btn-secondary" href="{{ route('aulas.index') }}">Cancelar</a>
  </form>
</section>
@endsection
