<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';
    
    protected $fillable = [
        'usuario_id',
        'profissional_id',
        'data_avaliacao',
        'peso',
        'altura',
        'biceps_direito',
        'biceps_esquerdo',
        'antebraco_direito',
        'antebraco_esquerdo',
        'coxa_direita',
        'coxa_esquerda',
        'panturrilha_direita',
        'panturrilha_esquerda',
        'cintura',
    ];

    protected $casts = [
        'data_avaliacao' => 'date',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function profissional()
    {
        return $this->belongsTo(Profissional::class);
    }

    public function proximaReavaliacao()
    {
        return $this->data_avaliacao ? $this->data_avaliacao->copy()->addMonths(2) : null;
    }

}
