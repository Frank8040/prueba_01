<?php

namespace App\Http\Controllers\Api\Setup;

use App\Models\Setup\Aplicacion;
use App\Util\Pagination;
use Illuminate\Http\Request;


class AplicacionController
{
    public function list($request)
    {
       return Aplicacion::select('aplicacion.id',
            'aplicacion.nombre',
            'aplicacion.direccion',
            'aplicacion.lugar',
            'aplicacion.tipo_gestion',
            'aplicacion.dre',
           'aplicacion.ugel',
           'aplicacion.resolucion_creacion',
           'aplicacion.resolucion_conversion',
           'aplicacion.numero_codigo_modular',
           'aplicacion.logo',
           'aplicacion.logo_inicio',
           'aplicacion.color',
            'ubigeo.desc_dep_sunat as departamento_id',
            'ubigeo.desc_prov_sunat as provincia_id',
            'ubigeo.desc_ubigeo_sunat as distrito_id')
            ->leftJoin('ubigeo','aplicacion.distrito_id','ubigeo.cod_ubigeo_sunat')
            ->get();
    }

    public function index(Request $request)
    {
        return response()->json(['success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'lista de Aplicaciones'], 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Aplicacion::create($input);
        return response()->json(['success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'Lista de Aplicaciones'], 200);
    }

    public function show($id)
    {
        $Aplicacion = Aplicacion::find($id);

        if (is_null($Aplicacion)) {
            return $this->sendError('Aplicaciones not found.');
        }
        return response()->json(['success' => true,
            'data' => $Aplicacion,
            'message' => 'Aplicacion por id'], 200);
    }

    public function update(Request $request, $id)
    {

        Aplicacion::find($id)->update($request->all());
        return response()->json(['success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'Lista de Aplicaciones'], 200);

    }

    public function destroy(Request $request, $id)
    {
        Aplicacion::find($id)->delete();
        return response()->json(['success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'Lista de Aplicaciones'], 200);
    }
}
