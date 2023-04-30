<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'unidad';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nombre', 'item', 'especialidad_modulo_id'];
}
