<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    protected $table = 'profissionais';
    protected $fillable = [
        'nome', 
        'celular',
        'numero_registro',
        'curriculo', 
        'especializacao',
        'localizacao',
        'aceite_termos'];
    protected $casts = [
        'aceite_termos' => 'boolean',
    ];

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }

    public function treinos()
    {
        return $this->hasMany(Treino::class);
    }
}
