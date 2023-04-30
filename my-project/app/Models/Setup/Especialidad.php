<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'especialidad';
    public $timestamps = false;
    protected $casts = ['estado' => 'boolean'];
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nombre', 'descripcion', 'creditos', 'cantidad_horas', 'estado'];
}

