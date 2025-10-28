<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Rol;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function alumno() {
        return $this->hasOne(Alumno::class, 'user_id', 'id');
    }

    public function profesor() {
        return $this->hasOne(Profesor::class, 'user_id', 'id');
    }

    public function director() {
        return $this->hasOne(Director::class, 'user_id', 'id');
    }

    public function empresa() {
        return $this->hasOne(Empresa::class, 'user_id', 'id');
    }

    public function rol() {
        return $this->belongsTo(Rol::class, 'role_id', 'id');
    }

    public function getNombreAttribute()
    {
        $mapa = [
            'alumno' => ['relacion' => 'alumno', 'campo' => 'nombres'],
            'profesor' => ['relacion' => 'profesor', 'campo' => 'nombres'],
            'director' => ['relacion' => 'director', 'campo' => 'nombres'],
            'empresa' => ['relacion' => 'empresa', 'campo' => 'nombre'],
        ];

        $rolNombre = $this->rol->rol ?? null;

        if ($rolNombre && isset($mapa[$rolNombre])) {
            $relacion = $mapa[$rolNombre]['relacion'];
            $campo = $mapa[$rolNombre]['campo'];

            return $this->$relacion?->$campo ?? $this->email;
        }

        return $this->email;
    }
    
}
