<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RolUsuario extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'rol_usuario';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'rol_id', 'usuario_id'];

    /** listar roles asignados  a un usuario */
    public static function lista_roles_asignados_a_usuario($usuario_id)
    {
        try {
            $query = "select r.id,
       r.nombre,
       (select count(ru.id)
        from rol_usuario ru
        where ru.rol_id = r.id
          and ru.usuario_id = (select id from users where id = '$usuario_id')) asignado
from rol r  group by r.id, r.nombre";
            $response = DB::select($query);
        } catch (\Exception $e) {
            $response = $e;
        }
        return $response;

    }
}

