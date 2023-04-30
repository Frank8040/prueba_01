<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{


    /**  ==========metodos para la lista de menu =================*/
    public static function listar_menu_por_usuario_padre($userid)
    {
        $sql = "select m.nombre name, m.icono icon, url , Parent_id
from modulo m where m.Parent_id in (
    select m2.Parent_id from modulo m2 where m2.id in (
        select rm.modulo_id from rol_modulo rm  where rm.rol_id in (
            select ru.rol_id from rol_usuario ru where ru.usuario_id ='$userid'
        ))
) and m.nivel=0
order by m.orden";
        $Query = DB::select($sql);
        return $Query;
    }

    public static function listar_menu_por_usuario_hijo($usuario_id, $Parent_id)
    {
        $sql = "select rm.modulo_id,m.nombre name, m.icono icon, m.url, m.Parent_id
from rol_modulo rm , modulo m
where rm.rol_id in (
    select ru.rol_id from rol_usuario ru where ru.usuario_id='$usuario_id'
    )
and rm.modulo_id=m.id
  and m.Parent_id='$Parent_id'
and m.nivel=1
group by rm.modulo_id, m.nombre, m.icono, m.url, m.Parent_id";
        $Query = DB::select($sql);
        return $Query;
    }
}

