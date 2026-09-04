<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Treino;

class Exercicio extends Model
{
    protected $table = 'execicios';
    protected $fillable = ['nome', 'grupo_muscular', 'descricao'];

    // Treinos que usam este exercicio. N-N via pivot treino_exercicio,
    // lado inverso de Treino::exercicios (mesmo pivot model dedicado).
    public function treinos()
    {
        return $this->belongsToMany(Treino::class, 'treino_exercicio')
            ->using(TreinoExercicio::class)
            ->withPivot('series', 'repeticoes', 'carga_kg', 'dia_semana')
            ->withTimestamps();
    }
}
