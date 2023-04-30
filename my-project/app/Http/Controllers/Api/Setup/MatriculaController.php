<?php

namespace App\Http\Controllers\Api\Setup;

use App\Models\Setup\Matricula;
use App\Util\Pagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatriculaController
{
    public function list($request)
    {
        return Matricula::select(
            'modulo_matricula.id',
            'estudiante.dni',
            DB::Raw("CONCAT(estudiante.apellido_pa, ' ', estudiante.apellido_pa) AS apellidos"),
            'estudiante.nombres',
            'especialidad.nombre as especialidad',
            'modulo.nombre as modulo',
            'turno.nombre as turno',
            'especialidad_modulos.hora_inicio',
            'especialidad_modulos.hora_fin',
            'especialidad_modulos.seccion',
            'modulo_matricula.observacion',
            'modulo_matricula.fecha',
            'modulo_matricula.pago',
            'estudiante.codigo',
            'modulo_matricula.voucher_aprobado'
        )
            ->leftJoin('estudiante', 'modulo_matricula.estudiante_id', 'estudiante.id')
            ->leftJoin('especialidad', 'modulo_matricula.especialidad_id', 'especialidad.id')
            ->leftJoin('modulo', 'modulo_matricula.modulo_id', 'modulo.id')
            ->leftJoin('especialidad_modulos', 'modulo_matricula.especialidad_modulo_id', 'especialidad_modulos.id')
            ->leftJoin('turno', 'especialidad_modulos.turno_id', 'turno.id')
            ->get();
    }
    public function index(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'lista matriculas'
        ], 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Matricula::create($input);
        return response()->json([
            'success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'lista matriculas'
        ], 200);
    }

    public function show($id)
    {
        $Matricula = Matricula::find($id);

        if (is_null($Matricula)) {
            return $this->sendError('Matricula not found.');
        }
        return response()->json([
            'success' => true,
            'data' => $Matricula,
            'message' => 'Matricula por id'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        Matricula::find($id)->update($request->all());
        return response()->json([
            'success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'Lista de matriculas'
        ], 200);
    }

    public function destroy(Request $request, $id)
    {
        Matricula::find($id)->delete();
        return response()->json([
            'success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'Lista de matriculas'
        ], 200);
    }
}
