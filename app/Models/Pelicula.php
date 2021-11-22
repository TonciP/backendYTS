<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    use HasFactory;

    protected$fillable = [
        'id',
        'nombre',
        'ano',
        'calificacion_rotten',
        'calificacion_IMDB',
        'director',
        'video_trailer',
        'sinopsis',
        'genero',
        'calidad_id'
    ];
    protected $hidden = ['created_at', 'updated_at'];
    public function relacion()
    {
        return $this->hasMany(PeliculaRelacion::class,'pertenece_pelicula_id')->with('pelicula');
    }
    public function calidad()
    {
        return $this->hasMany(Calidad::class,'peli_id');
    }
}
