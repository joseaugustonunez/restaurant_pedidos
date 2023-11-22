<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'categoria',
        'precio',
        'imagen',
        'descripcion'
    ];
    public function usuarios()
{
    return $this->belongsToMany(Usuario::class, 'ordenes', 'producto_id', 'usuario_id')
        ->withPivot('cantidad'); // Si hay datos adicionales en la tabla intermedia
}

public function mesa()
{
    return $this->belongsTo(Mesa::class, 'mesas_id');
}
}
