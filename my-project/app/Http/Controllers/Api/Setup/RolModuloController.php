<?php

namespace App\Http\Controllers\Api\Setup;

use App\Models\Setup\RolModulo;
use Illuminate\Http\Request;

class RolModuloController
{
    public function index(Request $request)
    {
        $lista = RolModulo::listar_modulos_asignados_rol($request->input('rol_id'),
            $request->input('modulo_id'));
        $listaAccesos = [];
        foreach ($lista as $key => $acceso) {
            $acceso->asignado = $acceso->asignado == '1' ? true : false;
            array_push($listaAccesos, $acceso);
        }
        return response()->json(['success' => true,
            'data' => $listaAccesos,
            'message' => 'lista de modulos asignados a un rol'], 200);

    }

    public function store(Request $request)
    {
        $input = $request->all();
        RolModulo::eliminar_roles_asignados($input['rol_id'], $input['Parent_id']);
        foreach ($input['modulos'] as $modulo) {
            $rol_modulo = new RolModulo();
            $rol_modulo->modulo_id = $modulo;
            $rol_modulo->rol_id = $input['rol_id'];
            $rol_modulo->save();
        }
        return response()->json(['success' => true,
            'data' => 'ok',
            'message' => 'Lista de modulos'], 200);
    }

}
