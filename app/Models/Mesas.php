<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesas extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'codigo',
        'nombre',
        'estado',
        'capacidad',
        'qr'

    ];
    public function usuario()
{
    return $this->belongsTo(Usuario::class, 'usuario_id');
}
public function productos()
{
    return $this->hasMany(Producto::class, 'mesas_id');
}

}
