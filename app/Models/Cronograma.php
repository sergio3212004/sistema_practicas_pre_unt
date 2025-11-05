<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'ficha_registro_id',
        'documento',
        'estado', // pendiente, enviado, aceptado, rechazado
    ];

    // Relación inversa con ficha de registro
    public function fichaRegistro()
    {
        return $this->belongsTo(FichaRegistro::class);
    }
}
