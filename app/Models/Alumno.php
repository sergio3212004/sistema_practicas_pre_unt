<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    //
    use HasFactory;
    protected $primaryKey = 'codigo_matricula';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'codigo_matricula',
        'user_id',
        'nombres',
        'apellido_materno',
        'apellido_paterno',
        'telefono'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
