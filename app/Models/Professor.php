<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Professor extends Model
{
    protected $table = 'professores';
    
    //softdeletes
    use SoftDeletes;


    protected $fillable = [
        'nome', 
        'email', 
        'telefone', 
        'especialidade', 
        'data_de_contratacao'
    ];

    protected $casts = [
        'data_de_contratacao' => 'date',
    ];
    
    public function aulas()
    {
        return $this->hasMany(Aula::class);
    }
}
