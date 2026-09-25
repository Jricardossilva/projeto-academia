<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
class Matricula extends Model
{
    protected $table = 'matriculas';

    protected $fillable = [
        'usuario_id', 
        'plano_id', 
        'data_inicio', 
        'data_fim', 
        'status'
    ];

    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
        'status' => 'string',
    ];
    
    public function usuario()
    {
        return $this->hasMany(Avaliacao::class);
    }

    public function plano()
    {
        return $this->hasOne(Planos::class);
    }
}
