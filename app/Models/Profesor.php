<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Profesor extends Model
{
    //
    protected $table = 'profesores';
    protected $primaryKey = 'codigo_profesor';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'codigo_profesor',
        'user_id',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'telefono'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function alumnos(): BelongsToMany
    {
        return $this->belongsToMany(
            Alumno::class,
            'profesores_asignados',
            'profesor_id',
            'alumno_id',
            'codigo_profesor',
            'codigo_matricula'
        )->withTimestamps();
    }

}
