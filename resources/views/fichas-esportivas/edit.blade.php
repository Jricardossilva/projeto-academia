@extends('layouts.app')

@section('content')
<section class="panel mt-3">
  <div class="panel-header">
    <h2 class="h5 mb-0 section-title">Editar Ficha Esportiva</h2>
  </div>
  <form method="POST" action="{{ route('fichas-esportivas.update', $fichaEsportiva) }}" class="p-3">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Usuário</label>
      <select name="usuario_id" class="form-control">
        @foreach ($usuarios as $usuario)
          <option value="{{ $usuario->id }}" @selected($usuario->id == $fichaEsportiva->usuario_id)>{{ $usuario->nome }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Tempo de prática</label>
      <input type="text" name="tempo_pratica" class="form-control" value="{{ old('tempo_pratica', $fichaEsportiva->tempo_pratica) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Modalidade</label>
      <input type="text" name="modalidades" class="form-control" value="{{ old('modalidades', $fichaEsportiva->modalidades) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Frequência</label>
      <input type="text" name="frequencia" class="form-control" value="{{ old('frequencia', $fichaEsportiva->frequencia) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Nível de experiência</label>
      <input type="text" name="nivel_experiencia" class="form-control" value="{{ old('nivel_experiencia', $fichaEsportiva->nivel_experiencia) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Objetivos</label>
      <textarea name="objetivos" class="form-control">{{ old('objetivos', $fichaEsportiva->objetivos) }}</textarea>
    </div>
    <button class="btn btn-primary" type="submit">Atualizar</button>
  </form>
</section>
@endsection