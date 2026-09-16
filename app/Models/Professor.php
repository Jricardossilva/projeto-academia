<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $table = 'professores';

    protected $fillable = [
        'nome', 
        'email', 
        'telefone', 
        'especialidade', 
        'data_de_contratacao', 
        'status:ativo/inativo'
    ];
}
