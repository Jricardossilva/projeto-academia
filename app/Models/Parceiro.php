<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parceiro extends Model
{
    protected $table = 'parceiros';
    protected $fillable = [
        'nome', 
        'categoria',
        'descricao', 
        'telefone', 
        'email', 
        'beneficio_oferecido', 
        'ativo'
        ];
        
    protected$casts = [
        'ativo' => 'boolean',
    ];
}
