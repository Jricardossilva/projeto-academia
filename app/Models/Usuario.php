<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FichaEsportiva;
use App\Models\Treino;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $fillable = ['nome', 'email', 'cpf', 'senha', 'aceite_termos'];
    protected $casts = [
        'aceite_termos' => 'boolean',
    ];

    public function fichaEsportiva()
    {
        return $this->hasOne(FichaEsportiva::class);
    }

    // Treinos criados para este usuario (lado inverso de Treino::usuario).
    public function treinos()
    {
        return $this->hasMany(Treino::class);
    }
}
