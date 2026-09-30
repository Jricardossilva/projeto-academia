@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Editar Matricula</h2>
  </div>
    <form method="POST" action="{{ route('matriculas.update', ['matricula' => $matricula]) }}" class="p-3">
        @csrf
        @method('PUT')
        <div class="mb-3">
        <label class="form-label">Usuário</label>
        <select name="usuario_id" class="form-control">
            @foreach ($usuarios as $usuario)
            <option value="{{ $usuario->id }}" @selected($usuario->id == $matricula->usuario_id)>{{ $usuario->nome }}</option>
            @endforeach
        </select>
        </div>
        <div class="mb-3">
        <label class="form-label">Plano</label>
        <select name="plano_id" class="form-control">
            @foreach ($planos as $plano)
            <option value="{{ $plano->id }}" @selected($plano->id == $matricula->plano_id)>{{ $plano->nome }}</option>
            @endforeach
        </select>
        </div>
        <div class="mb-3">
        <label class="form-label">Data de Início</label>
        <input type="date" name="data_inicio" class="form-control" value="{{ old('data_inicio', $matricula->data_inicio) }}">
        </div>
        <div class="mb-3">
        <label class="form-label">Data de Fim</label>
        <input type="date" name="data_fim" class="form-control" value="{{ old('data_fim', $matricula->data_fim) }}">
        </div>
        <button class="btn btn-primary" type="submit">Atualizar</button>
        <a class="btn btn-secondary" href="{{ route('matriculas.index') }}">Cancelar</a>
    </form>
</section>
@endsection