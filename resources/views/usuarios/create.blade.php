@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Novo Usuário</h2>
  </div>
  <form method="POST" action="{{ route('usuarios.store') }}" class="p-3">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" value="{{ old('nome') }}">
      @error('nome') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">E-mail</label>
      <input type="email" name="email" class="form-control" value="{{ old('email') }}">
      @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
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