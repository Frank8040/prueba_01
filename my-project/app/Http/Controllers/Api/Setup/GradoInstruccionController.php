<?php

namespace App\Http\Controllers\Api\Setup;
use App\Models\Setup\GradoInstruccion;

use Illuminate\Http\Request;


class GradoInstruccionController
{
    public function index(Request $request)
    {
        return response()->json(['success' => true,
            'data' => GradoInstruccion::all(),
            'message' => 'lista de GradoInstrucciones'], 200);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        GradoInstruccion::create($input);
        return response()->json(['success' => true,
            'data' => GradoInstruccion::all(),
            'message' => 'Lista de GradoInstrucciones'], 200);
    }
    public function show($id)
    {
        $GradoInstruccion = GradoInstruccion::find($id);

        if (is_null($GradoInstruccion)) {
            return $this->sendError('GradoInstrucciones not found.');
        }
        return response()->json(['success' => true,
            'data' => $GradoInstruccion,
            'message' => 'GradoInstruccion por id'], 200);
    }

    public function update(Request $request,$id)
    {

        GradoInstruccion::find($id)->update($request->all());
        return response()->json(['success' => true,
            'data' => GradoInstruccion::all(),
            'message' => 'Lista de GradoInstrucciones'], 200);

    }
    public function destroy($id)
    {
        GradoInstruccion::find($id)->delete();
        return response()->json(['success' => true,
            'data' => GradoInstruccion::all(),
            'message' => 'Lista de GradoInstrucciones'], 200);
    }
}
