<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planos extends Model
{
    protected $table = 'planos';
    protected $fillable = ['nome', 'descricao', 'duracao', 'valor', 'beneficios', 'ativo']; 
    protected $casts = [
        'ativo' => 'boolean',
        'valor' => 'decimal:2',
    ];
    
}   
