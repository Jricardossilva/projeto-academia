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
        'aceite_termos'
    ];
    protected $casts = [
        'aceite_termos' => 'boolean',
    ];

    protected $hidden = [
        'senha','remember_token'
    ];





    public function fichaEsportiva()
    {
        return $this->hasOne(FichaEsportiva::class);
    }

    public function planos()
    {
        return $this->senha;
    }


    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }
}
