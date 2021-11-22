<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeliculaRelacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'pertenece_pelicula_id',
        'pelicula_id'
    ];
    protected $hidden = ['created_at', 'updated_at'];
    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class,'pelicula_id');
    }
}
