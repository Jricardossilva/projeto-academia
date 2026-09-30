<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercicio extends Model
{
    protected $table = 'execicios';
    protected $fillable = ['nome', 'grupo_muscular', 'descricao'];

    public function treinos()
    {
        return $this->belongsToMany(Treino::class, 'treino_exercicio')
            ->withPivot('series', 'repeticoes', 'carga_kg', 'dia_semana')
            ->withTimestamps();
    }
}
