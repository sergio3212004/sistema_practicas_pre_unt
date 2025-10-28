<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    //
    protected $table = 'directores';
    protected $primaryKey = 'codigo_director';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'codigo_director',
        'user_id',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'telefono'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
