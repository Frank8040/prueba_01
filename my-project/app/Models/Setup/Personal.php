<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'personal';
    public $timestamps = false;

    protected $primaryKey = 'id';
    protected $fillable = ['id',
        'dni',
        'apellido_pa',
        'apellido_ma',
        'nombres',
        'correo_electronico',
        'celular',
        'sexo',
        'fe_nacimiento',
        'estado_civil_id',
        'departamento_id',
        'provincia_id',
        'distrito_id',
        'grado_instruccion_id'];
}

