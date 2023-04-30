<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beca extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'beca';
    public $timestamps = false;
    protected $casts = ['estado' => 'boolean'];
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nombre', 'descripcion', 'monto', 'estado'];
}

