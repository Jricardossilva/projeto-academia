<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaEsportiva extends Model
{
    protected $fillable = [
        'usuario_id', 
        'tempo_pratica', 
        'modalidades', 
        'frequencia', 
        'nivel_experiencia', 
        'objetivos'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
