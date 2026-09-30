<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FichaEsportiva;
 use Illuminate\Foundation\Auth\User as Authenticatable;


class Usuario extends Authenticatable
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'senha',
        'aceite_termos',
        'tipo',
    ];
    protected $casts = [
        'aceite_termos' => 'boolean',
    ];

    protected $hidden = [
        'senha','remember_token'
    ];


    public function getAuthPassword()
    {
        return $this->senha;
    }


    public function fichaEsportiva()
    {
        return $this->hasOne(FichaEsportiva::class);
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }

    public function treinos()
    {
        return $this->hasMany(Treino::class);
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class)->orderBy('data_avaliacao');
    }

    public function isAdmin(): bool
    {
        return $this->tipo === 'admin';
    }

    public function isProfessor(): bool
    {
        return $this->tipo === 'professor';
    }

    public function isAluno(): bool
    {
        return $this->tipo === 'aluno';
    }
}
