<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calidad extends Model
{
    use HasFactory;

    protected $fillable = [
        'formato',
        'nivel',
        'peli_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class,'peli_id');
    }
}
