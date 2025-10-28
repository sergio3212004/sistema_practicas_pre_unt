<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
    protected $table = 'empresas';
    protected $primaryKey = 'ruc';
    protected $keyType = 'string';
    public $incrementing = false;

    public $fillable = [
        'ruc',
        'user_id',
        'razon_social_id',
        'nombre',
        'telefono',
        'departamento',
        'provincia',
        'distrito',
        'direccion',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
