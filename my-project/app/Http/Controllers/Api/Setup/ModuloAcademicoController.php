<?php

namespace App\Http\Controllers\Api\Setup;

use App\Models\Setup\ModuloAcademico;
use App\Util\Pagination;
use Illuminate\Http\Request;


class ModuloAcademicoController
{
    public function list($request)
    {
        return ModuloAcademico::select('modulo_academico.id',
            'modulo_academico.nombre',
            'modulo_academico.credito',
            'modulo_academico.cantidad_horas',
            'nivel_ciclo.nombre as nivel_ciclo_id',
            'especialidad.nombre as especialidad_id',
            'tipo_programa.nombre as tipo_programa_id',
            'modulo_academico.estado')
            ->leftJoin('nivel_ciclo', 'modulo_academico.nivel_ciclo_id', 'nivel_ciclo.id')
            ->leftJoin('especialidad', 'modulo_academico.especialidad_id', 'especialidad.id')
            ->leftJoin('tipo_programa', 'modulo_academico.tipo_programa_id', 'tipo_programa.id')
            ->get();
    }

    public function index(Request $request)
    {
        return response()->json(['success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'lista de Modulos Academicos'], 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        ModuloAcademico::create($input);
        return response()->json(['success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'Lista de Modulos Academicos'], 200);
    }

    public function show($id)
    {
        $ModuloAcademico = ModuloAcademico::find($id);

        if (is_null($ModuloAcademico)) {
            return $this->sendError('Modulo Academico not found.');
        }
        return response()->json(['success' => true,
            'data' => $ModuloAcademico,
            'message' => 'ModuloAcademico por id'], 200);
    }

    public function update(Request $request, $id)
    {

        ModuloAcademico::find($id)->update($request->all());
        return response()->json(['success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'Lista de Modulos Academicos'], 200);

    }

    public function destroy(Request $request, $id)
    {
        ModuloAcademico::find($id)->delete();
        return response()->json(['success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'Lista de Modulos Academicos'], 200);
    }
    public function indexByEspecialite($id){
        return response()->json(['success' => true,
            'data' => ModuloAcademico::where('especialidad_id',$id)->get(),
            'message' => 'Lista de Modulos Academicos'], 200);
    }

}
