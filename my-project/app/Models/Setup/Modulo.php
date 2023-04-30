<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'modulo';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nombre', 'icono', 'orden', 'nivel', 'url', 'Parent_id'];
}

