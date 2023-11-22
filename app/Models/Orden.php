<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model

{
    use HasFactory;

    protected $table = 'ordenes';

    protected $fillable = [
        'carrito',
        'usuario_id',
        'cantidad',
        'mesas_id'
    ];
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    public function mesa()
{
    return $this->belongsTo(Mesas::class, 'mesas_id');
}
}