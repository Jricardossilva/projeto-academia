@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Editar Aula</h2>
  </div>
  <form method="POST" action="{{ route('aulas.update', $aula) }}" class="p-3">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" value="{{ old('nome', $aula->nome) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Descrição</label>
      <input type="text" name="descricao" class="form-control" value="{{ old('descricao', $aula->descricao) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Professor</label>
      <input type="text" name="professor" class="form-control" value="{{ old('professor', $aula->professor) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Dia da Semana</label>
      <input type="text" name="dia_semana" class="form-control" value="{{ old('dia_semana', $aula->dia_semana) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Horário de Início</label>
      <input type="text" name="horario_inicio" class="form-control" value="{{ old('horario_inicio', $aula->horario_inicio) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Horário de Fim</label>
      <input type="text" name="horario_fim" class="form-control" value="{{ old('horario_fim', $aula->horario_fim) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Capacidade</label>
      <input type="text" name="capacidade" class="form-control" value="{{ old('capacidade', $aula->capacidade) }}">
    </div>
    <button class="btn btn-primary" type="submit">Atualizar</button>
  </form>
</section>
@endsection