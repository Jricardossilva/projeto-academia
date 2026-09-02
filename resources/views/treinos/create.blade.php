@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Novo Treino</h2>
  </div>
  <form method="POST" action="{{ route('treinos.store') }}" class="p-3">
    @csrf
    <div class="mb-3 col-md-6">
      <label class="form-label">Nome</label>
      <input type="text" name="profissionais" class="form-control" value="{{ old('profissionais') }}">
      @error('profissionais') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Usuário</label>
      <select name="usuario_id" class="form-control">
        <option value="">Selecione um usuário</option>
        @foreach ($usuarios as $usuario)
          <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
            {{ $usuario->nome }}
          </option>
        @endforeach
      </select>
      @error('usuario_id') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Profissional</label>
      <select name="profissional_id" class="form-control">
        <option value="">Selecione um profissional</option>
        @foreach ($profissionais as $profissional)
          <option value="{{ $profissional->id }}" {{ old('profissional_id') == $profissional->id ? 'selected' : '' }}>
            {{ $profissional->nome }}
          </option>
        @endforeach
      </select>
      @error('profissional_id') <div class="text-danger small">{{ $message }}</div> @enderror  
    </div>
    <div class="mb-3">
      <label class="form-label">CPF</label>
      <input type="text" name="cpf" class="form-control" value="{{ old('cpf') }}">
      @error('cpf') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Senha</label>
      <input type="password" name="senha" class="form-control">
      @error('senha') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <button class="btn btn-primary" type="submit">Salvar</button>
  </form>
</section>
@endsection