<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspecialidadModulo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'especialidad_modulos';
    public $timestamps = false;

    protected $primaryKey = 'id';
    protected $casts = ['estado' => 'boolean'];
    protected $fillable = ['id',
       'hora_inicio',
       'hora_fin',
       'vacantes',
       'seccion',
       'estado',
       'fecha_inicio',
       'fecha_fin',
       'turno_id',
       'especialidad_id',
       'modulo_id',
       'personal_id',
       'laboratorio_id',
       'ciclo_academico_id'];
}

