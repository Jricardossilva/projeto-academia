@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Editar Treino</h2>
  </div>
  <form method="POST" action="{{ route('treinos.update', $treino) }}" class="p-3">
    @csrf
    @method('PUT')
<div class="mb-3 col-md-6">
  <label class="form-label">Nome</label>
  <input
    type="text"
    name="nome"
    class="form-control"
    value="{{ old('nome', $treino->nome) }}"
  >
  @error('nome')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>
<div class="mb-3">
  <label class="form-label">Usuário</label>

  <select name="usuario_id" class="form-control">
    <option value="">Selecione um usuário</option>

    @foreach ($usuarios as $usuario)
      <option
        value="{{ $usuario->id }}"
        {{ old('usuario_id', $treino->usuario_id) == $usuario->id ? 'selected' : '' }}
      >
        {{ $usuario->nome }}
      </option>
    @endforeach
  </select>

  @error('usuario_id')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label class="form-label">Profissional</label>

  <select name="profissional_id" class="form-control">
    <option value="">Selecione um profissional</option>

    @foreach ($profissionais as $profissional)
      <option
        value="{{ $profissional->id }}"
        {{ old('profissional_id', $treino->profissional_id) == $profissional->id ? 'selected' : '' }}
      >
        {{ $profissional->nome }}
      </option>
    @endforeach
  </select>

  @error('profissional_id')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

<button class="btn btn-primary" type="submit">
  Salvar alterações
</button>

<a href="{{ route('treinos.index') }}" class="btn btn-secondary">
  Cancelar
</a>

  </form>
</section>
@endsection