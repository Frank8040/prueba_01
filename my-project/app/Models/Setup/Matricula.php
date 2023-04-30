<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'matricula';
    public $timestamps = false;
    protected $casts = ['voucher_aprobado' => 'boolean'];
    protected $primaryKey = 'id';
    protected $fillable = ['id',
        'estudiante_id',
        'ciclo_academico_id',
        'especialidad_id',
        'modulo_id',
        'especialidad_modulo_id',
        'pago',
        'importe_pago',
        'voucher_numero_operacion',
        'voucher_img',
        'modalidad',
        'voucher_aprobado',
        'observacion',
        'fecha'];
}


