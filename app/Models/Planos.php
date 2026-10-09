<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Matricula;

class Planos extends Model
{
    protected $table = 'planos';
    protected $fillable = ['nome', 'descricao', 'valor', 'duracao', 'beneficios']; 
    protected $casts = [
        'ativo' => 'boolean',
        'valor' => 'decimal:2',
    ];
    
    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }
}  
