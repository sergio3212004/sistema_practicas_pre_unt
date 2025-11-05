<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfesorAsignado extends Model
{
    //
    use HasFactory;
    protected $table = 'profesores_asignados';
    protected $fillable = [
        'profesor_id',
        'alumno_id',
        'profesor_id'
    ];

    public function alumno() {
        return $this->belongsTo(Alumno::class, 'alumno_id', 'codigo_matricula');
    }
    public function profesor() {
        return $this->belongsTo(Profesor::class, 'profesor_id', 'codigo_profesor');
    }
    public function fichaRegistro()
    {
        return $this->hasOne(FichaRegistro::class);
    }
}
