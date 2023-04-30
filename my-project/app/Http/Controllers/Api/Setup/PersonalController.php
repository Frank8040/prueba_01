<?php

namespace App\Http\Controllers\Api\Setup;

use App\Models\Setup\Personal;
use App\Util\Pagination;
use Illuminate\Http\Request;


class PersonalController
{
    public function list($request)
    {
       return Personal::select('personal.id',
            'personal.dni',
            'personal.apellido_pa',
            'personal.apellido_ma',
            'personal.nombres',
            'personal.correo_electronico',
            'personal.celular',
            'personal.sexo',
            'personal.fe_nacimiento',
            'estado_civil.nombre as estado_civil_id',
            'ubigeo.desc_dep_sunat as departamento_id',
            'ubigeo.desc_prov_sunat as provincia_id',
            'ubigeo.desc_ubigeo_sunat as distrito_id',
            'grado_instruccion.nombre as grado_instruccion_id')
            ->leftJoin('ubigeo','personal.distrito_id','ubigeo.cod_ubigeo_sunat')
            ->leftJoin('grado_instruccion','personal.grado_instruccion_id','grado_instruccion.id')
            ->leftJoin('estado_civil','personal.estado_civil_id','estado_civil.id')
            ->get();
    }

    public function index(Request $request)
    {
        return response()->json(['success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'lista de Personales'], 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Personal::create($input);
        return response()->json(['success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'Lista de Personales'], 200);
    }

    public function show($id)
    {
        $Personal = Personal::find($id);

        if (is_null($Personal)) {
            return $this->sendError('Personales not found.');
        }
        return response()->json(['success' => true,
            'data' => $Personal,
            'message' => 'Personal por id'], 200);
    }

    public function update(Request $request, $id)
    {

        Personal::find($id)->update($request->all());
        return response()->json(['success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'Lista de Personales'], 200);

    }

    public function destroy(Request $request, $id)
    {
        Personal::find($id)->delete();
        return response()->json(['success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'Lista de Personales'], 200);
    }
}
