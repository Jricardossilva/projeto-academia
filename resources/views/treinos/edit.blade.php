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

<div class="mb-3">
  <label class="form-label">Tipo</label>
  <select name="tipo" class="form-control">
    <option value="generico" @selected(old('tipo', $treino->tipo) == 'generico')>Genérico</option>
    <option value="especifico" @selected(old('tipo', $treino->tipo) == 'especifico')>Específico</option>
  </select>
  @error('tipo')
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

<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Exercícios deste treino</h2>
  </div>

  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th>Exercício</th>
          <th>Dia</th>
          <th>Séries</th>
          <th>Repetições</th>
          <th>Carga (kg)</th>
          <th class="text-end">Ações</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($treino->exercicios as $exercicio)
          <tr>
            <td>{{ $exercicio->nome }}</td>
            <td>{{ $exercicio->pivot->dia_semana }}</td>
            <td>{{ $exercicio->pivot->series }}</td>
            <td>{{ $exercicio->pivot->repeticoes }}</td>
            <td>{{ $exercicio->pivot->carga_kg ?? '—' }}</td>
            <td class="text-end">
              <form action="{{ route('treinos.exercicios.detach', [$treino, $exercicio]) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-secondary btn-sm" onclick="return confirm('Remover este exercício do treino?')">Remover</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center text-muted py-3">Nenhum exercício adicionado ainda.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <form method="POST" action="{{ route('treinos.exercicios.attach', $treino) }}" class="p-3 row g-2 align-items-end">
    @csrf
    <div class="col-md-3">
      <label class="form-label">Exercício</label>
      <select name="exercicio_id" class="form-control" required>
        @foreach ($exercicios as $exercicio)
          <option value="{{ $exercicio->id }}">{{ $exercicio->nome }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-2">
      <label class="form-label">Dia da semana</label>
      <input type="text" name="dia_semana" class="form-control" placeholder="Segunda" required>
    </div>
    <div class="col-md-2">
      <label class="form-label">Séries</label>
      <input type="number" name="series" class="form-control" min="1" required>
    </div>
    <div class="col-md-2">
      <label class="form-label">Repetições</label>
      <input type="number" name="repeticoes" class="form-control" min="1" required>
    </div>
    <div class="col-md-2">
      <label class="form-label">Carga (kg)</label>
      <input type="number" step="0.1" name="carga_kg" class="form-control" min="0">
    </div>
    <div class="col-md-1">
      <button class="btn btn-primary w-100" type="submit">+</button>
    </div>
  </form>
</section>
@endsection