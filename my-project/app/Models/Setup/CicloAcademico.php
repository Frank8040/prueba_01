<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CicloAcademico extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'ciclo_academico';
    public $timestamps = false;
    protected $casts = ['estado' => 'boolean'];
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'anio', 'periodo', 'estado', 'fe_inicio_ciclo', 'fe_fin_ciclo'];
}
