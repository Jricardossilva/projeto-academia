<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Aula extends Model
{
    protected $table = 'aulas';

    protected $fillable = [
        'nome', 
        'descricao', 
        'professor', 
        'dia_semana', 
        'horario_inicio', 
        'horario_fim', 
        'capacidade', 
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
