<?php

namespace App\Http\Controllers\Api\Setup;
use App\Models\Setup\EstadoCivil;

use Illuminate\Http\Request;


class EstadoCivilController
{
    public function index(Request $request)
    {
        return response()->json(['success' => true,
            'data' => EstadoCivil::all(),
            'message' => 'listado de los estados civil'], 200);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        EstadoCivil::create($input);
        return response()->json(['success' => true,
            'data' => EstadoCivil::all(),
            'message' => 'listado de los estados civil'], 200);
    }
    public function show($id)
    {
        $EstadoCivil = EstadoCivil::find($id);

        if (is_null($EstadoCivil)) {
            return $this->sendError('Estado civil not found.');
        }
        return response()->json(['success' => true,
            'data' => $EstadoCivil,
            'message' => 'listado de estado civil por id'], 200);
    }

    public function update(Request $request,$id)
    {
        EstadoCivil::find($id)->update($request->all());
        return response()->json(['success' => true,
            'data' => EstadoCivil::all(),
            'message' => 'listado por de los estados civil'], 200);
    }
    public function destroy($id)
    {
        EstadoCivil::find($id)->delete();
        return response()->json(['success' => true,
            'data' => EstadoCivil::all(),
            'message' => 'listado de los estados civil'], 200);
    }
}
