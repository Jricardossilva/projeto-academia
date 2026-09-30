<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\Profissional;
use App\Models\Exercicio;

class Treino extends Model
{
    protected $table = 'treinos';
    protected $fillable = [
        'usuario_id',
        'profissional_id',
        'nome',
        'tipo',
        'avaliacao_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function profissional()
    {
        return $this->belongsTo(Profissional::class, 'profissional_id');
    }

    public function avaliacao()
    {
        return $this->belongsTo(Avaliacao::class);
    }

    public function exercicios()
    {
        return $this->belongsToMany(Exercicio::class, 'treino_exercicio')
            ->withPivot('series', 'repeticoes', 'carga_kg', 'dia_semana')
            ->withTimestamps();
    }
}

