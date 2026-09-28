<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\Profissional;
use App\Models\Exercicio;

class Treino extends Model
{
    protected $table = 'treinos';
    protected $fillable = [
        'usuario_id',
        'profissional_id',
        'nome'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function profissional()
    {
        return $this->belongsTo(Profissional::class, 'profissional_id');
    }
}

