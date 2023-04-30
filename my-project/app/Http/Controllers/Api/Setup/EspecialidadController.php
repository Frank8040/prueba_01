<?php

namespace App\Http\Controllers\Api\Setup;
use App\Models\Setup\Especialidad;

use Illuminate\Http\Request;


class EspecialidadController
{
    public function index(Request $request)
    {
        return response()->json(['success' => true,
            'data' => Especialidad::all(),
            'message' => 'lista de Especialidades'], 200);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        Especialidad::create($input);
        return response()->json(['success' => true,
            'data' => Especialidad::all(),
            'message' => 'Lista de Especialidades'], 200);
    }
    public function show($id)
    {
        $Especialidad = Especialidad::find($id);

        if (is_null($Especialidad)) {
            return $this->sendError('Especialidades not found.');
        }
        return response()->json(['success' => true,
            'data' => $Especialidad,
            'message' => 'Especialidad por id'], 200);
    }

    public function update(Request $request,$id)
    {

        Especialidad::find($id)->update($request->all());
        return response()->json(['success' => true,
            'data' => Especialidad::all(),
            'message' => 'Lista de Especialidades'], 200);

    }
    public function destroy($id)
    {
        Especialidad::find($id)->delete();
        return response()->json(['success' => true,
            'data' => Especialidad::all(),
            'message' => 'Lista de Especialidades'], 200);
    }
}
