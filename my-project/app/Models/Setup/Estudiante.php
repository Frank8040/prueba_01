<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'estudiante';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['id',
        'nombres',
        'apellido_pa',
        'apellido_ma',
        'dni',
        'correo_electronico',
        'celular',
        'sexo',
        'fe_nacimiento',
        'direccion',
        'departamento_id',
        'provincia_id',
        'distrito_id',
        'codigo',
        'estado_civil_id',
        'grado_instruccion_id'];
}
