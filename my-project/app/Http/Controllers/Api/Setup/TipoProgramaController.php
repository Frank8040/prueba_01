<?php

namespace App\Http\Controllers\Api\Setup;
use App\Models\Setup\TipoPrograma;

use Illuminate\Http\Request;


class TipoProgramaController
{
    public function index(Request $request)
    {
        return response()->json(['success' => true,
            'data' => TipoPrograma::all(),
            'message' => 'lista de TipoProgramas'], 200);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        TipoPrograma::create($input);
        return response()->json(['success' => true,
            'data' => TipoPrograma::all(),
            'message' => 'Lista de TipoProgramas'], 200);
    }
    public function show($id)
    {
        $TipoPrograma = TipoPrograma::find($id);

        if (is_null($TipoPrograma)) {
            return $this->sendError('TipoProgramaes not found.');
        }
        return response()->json(['success' => true,
            'data' => $TipoPrograma,
            'message' => 'TipoPrograma por id'], 200);
    }

    public function update(Request $request,$id)
    {

        TipoPrograma::find($id)->update($request->all());
        return response()->json(['success' => true,
            'data' => TipoPrograma::all(),
            'message' => 'Lista de TipoProgramas'], 200);

    }
    public function destroy($id)
    {
        TipoPrograma::find($id)->delete();
        return response()->json(['success' => true,
            'data' => TipoPrograma::all(),
            'message' => 'Lista de TipoProgramas'], 200);
    }
}
