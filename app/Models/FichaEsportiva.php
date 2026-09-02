<?php

namespace App\Models;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Model;

class FichaEsportiva extends Model
{
    protected $table = 'fichas_esportivas';
    
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
