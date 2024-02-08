<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
class Boat extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'Matricula',
        'Manga',
        'Eslora',
        'Origen',
        'Titular',
        'Imagen',
        'Numero_registro',
        'Datos_Tecnicos',
        'Modelo',
        'Nombre',
        'Causa',
        'Tipo',
    ];

    public function transits()
    {
        return $this->belongsToMany(Transit::class, 'TransitBoat', 'Boat_id', 'Transit_id');
    }
}
