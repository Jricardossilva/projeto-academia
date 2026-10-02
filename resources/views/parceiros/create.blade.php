@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Novo Parceiro</h2>
  </div>
  <form method="POST" action="{{ route('parceiros.store') }}" class="p-3">
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
      <label class="form-label">Categoria</label>
      <input type="text" name="categoria" class="form-control" value="{{ old('categoria') }}">
      @error('categoria') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Descrição</label>
      <input type="text" name="descricao" class="form-control" value="{{ old('descricao') }}">
      @error('descricao') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Telefone</label>
      <input type="text" name="telefone" class="form-control" value="{{ old('telefone') }}">
      @error('telefone') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        
      <label class="form-label">E-mail</label>
      <input type="email" name="email" class="form-control" value="{{ old('email') }}">
      @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Benefício Oferecido</label>
      <input type="text" name="beneficio_oferecido" class="form-control" value="{{ old('beneficio_oferecido') }}">
      @error('beneficio_oferecido') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    

    <button class="btn btn-primary" type="submit">Salvar</button>
    <a class="btn btn-secondary" href="{{ route('parceiros.index') }}">Cancelar</a>
  </form>
</section>
@endsection

