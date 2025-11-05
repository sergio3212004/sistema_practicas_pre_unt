<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class FichaRegistro extends Model
{
    //
    use HasFactory;
    protected $table = 'ficha_registros';

    protected $fillable = [
        'profesor_asignado_id',
        'documento',
        'estado'
    ];

    public function profesorAsignado()
    {
        return $this->belongsTo(ProfesorAsignado::class);
    }

    public function cronogramas()
    {
        return $this->hasMany(Cronograma::class);
    }
}
