<?php

namespace App\Http\Controllers\Api\Setup;
use App\Models\Setup\CicloAcademico;

use Illuminate\Http\Request;


class CicloAcademicoController
{
    public function index(Request $request)
    {
        return response()->json(['success' => true,
            'data' => CicloAcademico::all(),
            'message' => 'listado por ciclo académico'], 200);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        CicloAcademico::create($input);
        return response()->json(['success' => true,
            'data' => CicloAcademico::all(),
            'message' => 'listado por ciclo académico'], 200);
    }
    public function show($id)
    {
        $CicloAcademico = CicloAcademico::find($id);

        if (is_null($CicloAcademico)) {
            return $this->sendError('CicloAcademicoes not found.');
        }
        return response()->json(['success' => true,
            'data' => $CicloAcademico,
            'message' => 'Ciclo académico por id'], 200);
    }

    public function update(Request $request,$id)
    {
        CicloAcademico::find($id)->update($request->all());
        return response()->json(['success' => true,
            'data' => CicloAcademico::all(),
            'message' => 'listado por ciclo académico'], 200);
    }
    public function destroy($id)
    {
        CicloAcademico::find($id)->delete();
        return response()->json(['success' => true,
            'data' => CicloAcademico::all(),
            'message' => 'listado por ciclo académico'], 200);
    }
}