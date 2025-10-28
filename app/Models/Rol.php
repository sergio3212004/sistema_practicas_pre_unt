<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
    protected $table = 'roles';
    protected $primaryKey = 'id';
    public $keyType = 'integer';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'rol'
    ];

    public function users() {
        return $this->hasMany(User::class, 'rol_id', 'id');
    }



}
