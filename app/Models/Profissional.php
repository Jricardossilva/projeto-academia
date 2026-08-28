<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    protected $fillable = [
        'nome', 'email', 'cpf', 'senha', 'celular',
        'numero_registro', 'curriculo', 'especializacao',
        'localizacao', 'aceite_termos'
    ];
}
