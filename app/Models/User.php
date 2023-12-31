<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function mensajes()
    {
        return $this->hasMany(Mensaje::class, 'usuario_id');
    }
    public function setPasswordAttribute($password){
        $this->attributes['password']= bcrypt($password);
    }
    public function mesas()
{
    return $this->hasMany(Mesa::class, 'usuario_id');
}
public function productos()
{
    return $this->belongsToMany(Producto::class, 'ordenes', 'usuario_id', 'producto_id')
        ->withPivot('cantidad'); // Si hay datos adicionales en la tabla intermedia
}
    
}
