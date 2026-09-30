@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Editar Ficha Esportiva</h2>
  </div>
  <form method="POST" action="{{ route('fichas-esportivas.update', ['ficha' => $ficha]) }}" class="p-3">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Usuário</label>
      <select name="usuario_id" class="form-control">
        @foreach ($usuarios as $usuario)
          <option value="{{ $usuario->id }}" @selected($usuario->id == $ficha->usuario_id)>{{ $usuario->nome }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Tempo de prática</label>
      <input type="text" name="tempo_pratica" class="form-control" value="{{ old('tempo_pratica', $ficha->tempo_pratica) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Modalidade</label>
      <input type="text" name="modalidades" class="form-control" value="{{ old('modalidades', $ficha->modalidades) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Frequência</label>
      <input type="text" name="frequencia" class="form-control" value="{{ old('frequencia', $ficha->frequencia) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Nível de experiência</label>
      <input type="text" name="nivel_experiencia" class="form-control" value="{{ old('nivel_experiencia', $ficha->nivel_experiencia) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Objetivos</label>
      <textarea name="objetivos" class="form-control">{{ old('objetivos', $ficha->objetivos) }}</textarea>
    </div>
    <button class="btn btn-primary" type="submit">Atualizar</button>
    <a class="btn btn-secondary" href="{{ route('fichas-esportivas.index') }}">Cancelar</a>
  </form>
</section>
@endsection