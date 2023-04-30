<?php

namespace App\Http\Controllers\Api\Setup;

use App\Models\Setup\Rol;
use Illuminate\Http\Request;

class RolController
{
    public function index(Request $request)
    {
        return response()->json(['success' => true,
            'data' => Rol::all(),
            'message' => 'lista de roles'], 200);

    }

    public function store(Request $request)
    {
        $input = $request->all();
        Rol::create($input);
        return response()->json(['success' => true,
            'data' => Rol::all(),
            'message' => 'Lista de roles'], 200);
    }

    public function show($id)
    {
        $rol = Rol::find($id);

        if (is_null($rol)) {
            return $this->sendError('Rol not found.');
        }
        return response()->json(['success' => true,
            'data' => $rol,
            'message' => 'Rol por id'], 200);
    }

    public function update(Request $request, Rol $rol)
    {
        $input = $request->all();
        $rol->nombre = $input['nombre'];
        $rol->save();
        return response()->json(['success' => true,
            'data' => Rol::all(),
            'message' => 'Lista de roles'], 200);

    }

    public function destroy(Rol $rol)
    {
        $rol->delete();
        return response()->json(['success' => true,
            'data' => Rol::all(),
            'message' => 'Lista de roles'], 200);
    }
}
