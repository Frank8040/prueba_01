<?php

namespace App\Http\Controllers\Api\Setup;
use App\Models\Setup\Beca;

use Illuminate\Http\Request;


class BecaController
{
    public function index(Request $request)
    {
        return response()->json(['success' => true,
            'data' => Beca::all(),
            'message' => 'lista de Becas'], 200);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        Beca::create($input);
        return response()->json(['success' => true,
            'data' => Beca::all(),
            'message' => 'Lista de Becas'], 200);
    }
    public function show($id)
    {
        $Beca = Beca::find($id);

        if (is_null($Beca)) {
            return $this->sendError('Becaes not found.');
        }
        return response()->json(['success' => true,
            'data' => $Beca,
            'message' => 'Beca por id'], 200);
    }

    public function update(Request $request,$id)
    {

        Beca::find($id)->update($request->all());
        return response()->json(['success' => true,
            'data' => Beca::all(),
            'message' => 'Lista de Becas'], 200);

    }
    public function destroy($id)
    {
        Beca::find($id)->delete();
        return response()->json(['success' => true,
            'data' => Beca::all(),
            'message' => 'Lista de Becas'], 200);
    }
}
