<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NivelCiclo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'nivel_ciclo';
    public $timestamps = false;
    protected $casts = ['estado' => 'boolean'];
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nombre', 'descripcion','resolucion_directoral', 'estado'];
}

