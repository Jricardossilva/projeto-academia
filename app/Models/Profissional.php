<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Treino;

class Profissional extends Model
{
    protected $table = 'profissionais';
    protected $fillable = [
        'nome', 'email', 'cpf', 'senha', 'celular',
        'numero_registro', 'curriculo', 'especializacao',
        'localizacao', 'aceite_termos'
    ];

    // Treinos prescritos por este profissional (lado inverso de Treino::profissional).
    public function treinos()
    {
        return $this->hasMany(Treino::class);
    }
}
