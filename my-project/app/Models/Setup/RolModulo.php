<?php

namespace App\Models\Setup;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RolModulo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'rol_modulo';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'modulo_id', 'rol_id'];

    /**  ==========listar modulos asignados a un rol =================*/
    public static function listar_modulos_asignados_rol($rol_id, $modulo_id)
    {
        try {
            $sql = "select m.id,
       m.nombre,
       (select count(rm.id) from rol_modulo rm where rm.modulo_id = m.id and rm.rol_id = '$rol_id') asignado
from modulo m
where m.nivel = 1
  and m.Parent_id = '$modulo_id'
group by m.id, m.nombre";
            $response = DB::select($sql);


        } catch (Exception $e) {
            $response = $e;

        }
        return $response;

    }

    /**  ==========Asignar rol modulo =================*/
    public static function eliminar_roles_asignados($rol_id, $Parent_id)
    {
        try {
            $queryDelete = "delete from rol_modulo
where rol_id= '$rol_id' and modulo_id in (
    select id from modulo where Parent_id='" . $Parent_id . "')";
            DB::delete($queryDelete);

        } catch (Exception $e) {
            dd($e);
        }

    }
}

