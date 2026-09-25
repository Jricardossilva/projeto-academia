<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\Profissional;
use App\Models\Exercicio;

class Treino extends Model
{
    protected $table = 'treino_exercicio';
    protected $fillable = [
        'usuario_id',
        'profissional_id',
        'nome',        
        'data_criacao'
    ];
    protected $casts = [
        'data_criacao' => 'date',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function profissional()
    {
        return $this->belongsTo(Profissional::class);
    }
}
