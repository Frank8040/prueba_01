<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tarea';
    public $timestamps = false;

    protected $primaryKey = 'id';
    protected $guarded = ['']; // $fillable = ['id', 'nombre', 'fecha_inicio'];
}

