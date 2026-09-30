@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Editar Usuário</h2>
  </div>
  <form method="POST" action="{{ route('usuarios.update', $usuario) }}" class="p-3">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" value="{{ old('nome', $usuario->nome) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">E-mail</label>
      <input type="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">CPF</label>
      <input type="text" name="cpf" class="form-control" value="{{ old('cpf', $usuario->cpf) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Nova senha (deixe em branco para manter a atual)</label>
      <input type="password" name="senha" class="form-control">
    </div>
    @if (auth()->user()->isAdmin())
      <div class="mb-3">
        <label class="form-label">Tipo de acesso</label>
        <select name="tipo" class="form-select">
          <option value="aluno" @selected(old('tipo', $usuario->tipo) == 'aluno')>Aluno</option>
          <option value="professor" @selected(old('tipo', $usuario->tipo) == 'professor')>Professor</option>
          <option value="admin" @selected(old('tipo', $usuario->tipo) == 'admin')>Admin</option>
        </select>
      </div>
    @endif
    <button class="btn btn-primary" type="submit">Atualizar</button>
    <a class="btn btn-secondary" href="{{ route('usuarios.index') }}">Cancelar</a>
  </form>
</section>
@endsection