<?php

namespace App\Http\Controllers\Api\Setup;
use App\Models\Setup\NivelCiclo;

use Illuminate\Http\Request;


class NivelCicloController
{
    public function index(Request $request)
    {
        return response()->json(['success' => true,
            'data' => NivelCiclo::all(),
            'message' => 'lista de NivelCiclos'], 200);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        NivelCiclo::create($input);
        return response()->json(['success' => true,
            'data' => NivelCiclo::all(),
            'message' => 'Lista de NivelCiclos'], 200);
    }
    public function show($id)
    {
        $NivelCiclo = NivelCiclo::find($id);

        if (is_null($NivelCiclo)) {
            return $this->sendError('NivelCicloes not found.');
        }
        return response()->json(['success' => true,
            'data' => $NivelCiclo,
            'message' => 'NivelCiclo por id'], 200);
    }

    public function update(Request $request,$id)
    {

        NivelCiclo::find($id)->update($request->all());
        return response()->json(['success' => true,
            'data' => NivelCiclo::all(),
            'message' => 'Lista de NivelCiclos'], 200);

    }
    public function destroy($id)
    {
        NivelCiclo::find($id)->delete();
        return response()->json(['success' => true,
            'data' => NivelCiclo::all(),
            'message' => 'Lista de NivelCiclos'], 200);
    }
}
