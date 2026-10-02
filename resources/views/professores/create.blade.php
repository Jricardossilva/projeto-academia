@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Novo Professor</h2>
  </div>
  <form method="POST" action="{{ route('professores.store') }}" class="p-3">
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
      <label for="telefone" class="form-label">Telefone</label>
      <input type="text"
       id="telefone"
       name="telefone"
        class="form-control"
        data-mask="phone"
        inputmode="tel"
        maxlenght="15"
        placeholder="(00) 00000-0000"
        value="{{ old('telefone') }}">
      @error('telefone') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Especialidade</label>
      <input type="text" name="especialidade" class="form-control" value="{{ old('especialidade') }}">
      @error('especialidade') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Data de Contratação</label>
        <input type="date" name="data_de_contratacao" class="form-control" value="{{ old('data_de_contratacao') }}">
        @error('data_de_contratacao') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    
    <button class="btn btn-primary" type="submit">Salvar</button>
    <a class="btn btn-secondary" href="{{ route('professores.index') }}">Cancelar</a>
  </form>
</section>
@endsection
