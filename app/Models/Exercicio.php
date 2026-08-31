<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercicio extends Model
{
    protected $table = 'exercicios';
    protected $fillable = ['nome', 'grupo_muscular', 'descricao'];
}
