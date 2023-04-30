<?php

namespace App\Http\Controllers\Api\Setup;
use App\Models\Setup\Laboratorio;

use Illuminate\Http\Request;


class LaboratorioController
{
    public function index(Request $request)
    {
        return response()->json(['success' => true,
            'data' => Laboratorio::all(),
            'message' => 'lista de Laboratorios'], 200);

    }

    public function store(Request $request)
    {
        $input = $request->all();
        Laboratorio::create($input);
        return response()->json(['success' => true,
            'data' => Laboratorio::all(),
            'message' => 'Lista de Laboratorios'], 200);
    }
    public function show($id)
    {
        $Laboratorio = Laboratorio::find($id);

        if (is_null($Laboratorio)) {
            return $this->sendError('Laboratorios not found.');
        }
        return response()->json(['success' => true,
            'data' => $Laboratorio,
            'message' => 'Laboratorio por id'], 200);
    }

    public function update(Request $request,$id)
    {
        Laboratorio::find($id)->update($request->all());
        return response()->json(['success' => true,
            'data' => Laboratorio::all(),
            'message' => 'Lista de Laboratorios'], 200);
    }
    public function destroy($id)
    {
        Laboratorio::find($id)->delete();
        return response()->json(['success' => true,
            'data' => Laboratorio::all(),
            'message' => 'Lista de Laboratorios'], 200);
    }
}
