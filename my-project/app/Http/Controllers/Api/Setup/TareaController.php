<?php

namespace App\Http\Controllers\Api\Setup;
use App\Models\Setup\Tarea;

use Illuminate\Http\Request;


class TareaController
{
    public function index()
    {
        return Tarea::select('tarea.id',
            'tarea.nombre',
            'tarea.descripcion')
            ->get();
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $resultado = Tarea::create($input);
        return response()->json(['estado' => true,
            'data' => $resultado,
            'message' => 'Se creó muy bien la tarea'], 200);
    }
    public function show($id)
    {
        $Tarea = Tarea::find($id);
        if (is_null($Tarea)) {
            return $this->sendError('Tareas not found.');
        }
        return response()->json(['success' => true,
            'data' => $Tarea,
            'message' => 'listado de Tarea por id'], 200);
    }
    public function update(Request $request,$id)
    {
        Tarea::find($id)->update($request->all());
        return response()->json(['success' => true,
            'data' => Tarea::all(),
            'message' => 'listado por Tareas'], 200);
    }
    public function destroy($id)
    {
        Tarea::find($id)->delete();
        return response()->json(['success' => true,
            'data' => Tarea::all(),
            'message' => 'listado por Tareas'], 200);
    }
}
