<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\Profissional;
use App\Models\Exercicio;

class Treino extends Model
{
    protected $fillable = [
        'usuario_id',
        'profissional_id',
        'nome',
        'data_criacao'
    ];
    protected $casts = [
        'data_criacao' => 'date',
    ];

    // Usuario (aluno) dono do treino. Relação apenas via Eloquent,
    // sem constraint de FK no banco (usuario_id é unsignedBigInteger solto).
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    // Profissional que criou/prescreveu o treino.
    public function profissional()
    {
        return $this->belongsTo(Profissional::class);
    }

    // Exercicios que compoem o treino. N-N via tabela pivot treino_exercicio,
    // que carrega dados proprios da combinacao treino+exercicio
    // (series, repeticoes, carga_kg, dia_semana), por isso usa um Pivot model dedicado.
    public function exercicios()
    {
        return $this->belongsToMany(Exercicio::class, 'treino_exercicio')
            ->using(TreinoExercicio::class)
            ->withPivot('series', 'repeticoes', 'carga_kg', 'dia_semana')
            ->withTimestamps();
    }
}
