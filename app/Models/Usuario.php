<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FichaEsportiva;

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
}
