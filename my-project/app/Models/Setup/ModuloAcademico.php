<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuloAcademico extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'modulo_academico';
    public $timestamps = false;
    protected $casts = ['estado' => 'boolean'];
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nombre', 'credito',
        'cantidad_horas',
        'nivel_ciclo_id',
        'especialidad_id',
        'tipo_programa_id',
        'estado'];
}

