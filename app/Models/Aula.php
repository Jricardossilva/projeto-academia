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
        'dia_da_semana', 
        'horario_de_inicio', 
        'horario_de_termino', 
        'capacidade', 
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
