<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriterioEvaluacion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'criterio_evaluacion';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nombre', 'item', 'unidad_id'];
}
