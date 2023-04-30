<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitucionConvenio extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'institucion_convenio';
    public $timestamps = false;

    protected $primaryKey = 'id';
    protected $fillable = ['id',
        'nombre',
        'direccion',
        'celular',
        'correo',
        'departamento_id',
        'provincia_id',
        'distrito_id'];
}

