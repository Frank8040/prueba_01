<?php

namespace App\Http\Controllers\Api\Setup;
use App\Models\Setup\Modulo;

use Illuminate\Http\Request;


class ModuloController
{
    public function index(Request $request)
    {
        return response()->json(['success' => true,
            'data' => Modulo::all(),
            'message' => 'lista de modulos'], 200);

    }
    public function index_parent(Request $request)
    {
        return response()->json(['success' => true,
            'data' => Modulo::where('nivel',0)->get(),
            'message' => 'lista de modulos padres'], 200);

    }

    public function store(Request $request)
    {
        $input = $request->all();
        Modulo::create($input);
        return response()->json(['success' => true,
            'data' => Modulo::all(),
            'message' => 'Lista de modulos'], 200);
    }
    public function show($id)
    {
        $modulo = Modulo::find($id);

        if (is_null($modulo)) {
            return $this->sendError('modulo not found.');
        }
        return response()->json(['success' => true,
            'data' => $modulo,
            'message' => 'Modulo por id'], 200);
    }

    public function update(Request $request, Modulo $modulo)
    {
        $input = $request->all();
        $modulo->nombre = $input['nombre'];
        $modulo->icono = $input['icono'];
        $modulo->orden = $input['orden'];
        $modulo->nivel = $input['nivel'];
        $modulo->url = $input['url'];
        $modulo->Parent_id = $input['Parent_id'];
        $modulo->save();
        return response()->json(['success' => true,
            'data' => Modulo::all(),
            'message' => 'Lista de modulos'], 200);

    }
    public function destroy(Modulo $modulo)
    {
        $modulo->delete();
        return response()->json(['success' => true,
            'data' => Modulo::all(),
            'message' => 'Lista de modulos'], 200);
    }
}
