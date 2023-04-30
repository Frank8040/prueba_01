<?php

namespace App\Http\Controllers\Api\Setup;

use App\Models\Setup\Menu;
use Exception;
use Illuminate\Http\Request;

class MenuController
{


    public function index(Request $request)
    {
        $menu = [];
        try {
            $list_padre_mudulo = Menu::listar_menu_por_usuario_padre(auth()->user()->id);
            foreach ($list_padre_mudulo as $key => $dataPadre) {
                $lista = $dataPadre;
                $list = Menu::listar_menu_por_usuario_hijo(auth()->user()->id, $dataPadre->Parent_id);
                $lista->children = $list;
                array_push($menu, $lista);
            }
            $jResponse['success'] = true;
            $jResponse['data'] = $menu;
        } catch (Exception $e) {
            dd($e);
        }

        return response()->json(['success' => true,
            'data' => $menu,
            'message' => 'Lista de Menu'], 200);


    }

}
