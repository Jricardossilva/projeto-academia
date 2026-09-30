@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Editar Parceiro</h2>
  </div>
  <form method="POST" action="{{ route('parceiros.update', $parceiro) }}" class="p-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" value="{{ old('nome', $parceiro->nome) }}">
      @error('nome') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Categoria</label>
      <input type="text" name="categoria" class="form-control" value="{{ old('categoria', $parceiro->categoria) }}">
      @error('categoria') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Descrição</label>
      <input type="text" name="descricao" class="form-control" value="{{ old('descricao', $parceiro->descricao) }}">
      @error('descricao') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Telefone</label>
      <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $parceiro->telefone) }}">
      @error('telefone') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">E-mail</label>
      <input type="email" name="email" class="form-control" value="{{ old('email', $parceiro->email) }}">
      @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Benefício Oferecido</label>
      <input type="text" name="beneficio_oferecido" class="form-control" value="{{ old('beneficio_oferecido', $parceiro->beneficio_oferecido) }}">
      @error('beneficio_oferecido') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 form-check">
      <input type="hidden" name="ativo" value="0">
      <input type="checkbox" name="ativo" value="1" class="form-check-input" id="ativo" @checked(old('ativo', $parceiro->ativo))>
      <label class="form-check-label" for="ativo">Ativo</label>
    </div>

    <button class="btn btn-primary" type="submit">Atualizar</button>
    <a class="btn btn-secondary" href="{{ route('parceiros.index') }}">Cancelar</a>
  </form>
</section>
@endsection
