<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

// Pivot model dedicado da tabela treino_exercicio.
// Usado em Treino::exercicios() e Exercicio::treinos() para poder
// acessar/tratar os dados proprios da combinacao (series, repeticoes,
// carga_kg, dia_semana) como atributos normais do pivot.
class TreinoExercicio extends Pivot
{
    protected $table = 'treino_exercicio';

    // A tabela tem coluna id() propria (nao e um pivot composto puro).
    public $incrementing = true;

    protected $fillable = [
        'treino_id',
        'exercicio_id',
        'series',
        'repeticoes',
        'carga_kg',
        'dia_semana',
    ];

    protected $casts = [
        'series' => 'integer',
        'repeticoes' => 'integer',
        'carga_kg' => 'decimal:2',
    ];

    // Relacao apenas via Eloquent, sem FK no banco.
    public function treino()
    {
        return $this->belongsTo(Treino::class);
    }

    public function exercicio()
    {
        return $this->belongsTo(Exercicio::class);
    }
}
