<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'ubigeo';
    public $timestamps = false;

    protected $primaryKey = 'cod_dep_inei';
    protected $fillable = ['cod_dep_inei',
        'desc_dep_inei',
        'cod_prov_inei',
        'desc_prov_inei',
        'cod_ubigeo_inei',
        'desc_ubigeo_inei',
        'cod_dep_reniec',
        'desc_dep_reniec',
        'cod_prov_reniec',
        'desc_prov_reniec',
        'cod_ubigeo_reniec',
        'desc_ubigeo_reniec',
        'cod_dep_sunat',
        'desc_dep_sunat',
        'cod_prov_sunat',
        'desc_prov_sunat',
        'cod_ubigeo_sunat',
        'desc_ubigeo_sunat'];
}

