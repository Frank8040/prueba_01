<?php

namespace App\Http\Controllers\Api\Setup;

use App\Models\Setup\CriterioEvaluacion;
use App\Models\Setup\EspecialidadModulo;
use App\Models\Setup\Unidad;
use App\Util\Pagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EspecialidadModuloController
{
    public function list($request)
    {
        return EspecialidadModulo::select('especialidad_modulos.id',
            DB::Raw("CONCAT(ciclo_academico.anio, ' ', ciclo_academico.periodo) AS ciclo"),
            'especialidad.nombre as especialidad',
            'modulo_academico.nombre as modulo',
            'tipo_programa.nombre as programa',
            DB::Raw("CONCAT(turno.nombre, ' ', especialidad_modulos.hora_inicio, ' ', especialidad_modulos.hora_fin) AS turno_hora"),
            DB::Raw("CONCAT(personal.apellido_pa, ' ', personal.apellido_ma, ' ', personal.nombres) AS docente"),
            'laboratorio.nombre as laboratorio',
            'especialidad_modulos.vacantes',
            'especialidad_modulos.seccion',
            'especialidad_modulos.estado',
            'especialidad_modulos.fecha_inicio',
            'especialidad_modulos.fecha_fin',
        )
            ->leftJoin('especialidad', 'especialidad_modulos.especialidad_id', 'especialidad.id')
            ->leftJoin('modulo_academico', 'especialidad_modulos.modulo_id', 'modulo_academico.id')
            ->leftJoin('tipo_programa', 'modulo_academico.tipo_programa_id', 'tipo_programa.id')
            ->leftJoin('laboratorio', 'especialidad_modulos.laboratorio_id', 'laboratorio.id')
            ->leftJoin('ciclo_academico', 'especialidad_modulos.ciclo_academico_id', 'ciclo_academico.id')
            ->leftJoin('modulo', 'especialidad_modulos.modulo_id', 'modulo.id')
            ->leftJoin('turno', 'especialidad_modulos.turno_id', 'turno.id')
            ->leftJoin('personal', 'especialidad_modulos.personal_id', 'personal.id')
            ->get();
    }




    public function index(Request $request)
    {
        return response()->json(['success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'lista de Especialidad modulos'], 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['estado'] = (int)$input['estado'];
        EspecialidadModulo::create($input);
        return response()->json(['success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'Lista de Especialidad modulos'], 200);
    }

    public function show($id)
    {
        $EspecialidadModulo = EspecialidadModulo::find($id);

        if (is_null($EspecialidadModulo)) {
            return $this->sendError('Especialidad modulos not found.');
        }
        return response()->json(['success' => true,
            'data' => $EspecialidadModulo,
            'message' => 'Especialidad modulos por id'], 200);
    }

    public function update(Request $request, $id)
    {

        EspecialidadModulo::find($id)->update($request->all());
        return response()->json(['success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'Lista de Especialidad modulos'], 200);

    }

    public function destroy(Request $request, $id)
    {
        EspecialidadModulo::find($id)->delete();
        return response()->json(['success' => true,
            'data' => Pagination::paginator($this->list($request), $request->input('ver_por_pagina'), $request),
            'message' => 'Lista de Especialidad modulos'], 200);
    }

    public function listarPorIdParaGestionarUnidades($id)
    {
        $EspecialidadModulo = EspecialidadModulo::find($id);
        if (is_null($EspecialidadModulo)) {
            return $this->sendError('Especialidad modulos not found.');
        }
        $EspecialidadModulo->unidades = Unidad::where('especialidad_modulo_id', $id)
            ->orderBy('item')
            ->get();
        foreach ($EspecialidadModulo->unidades as $item) {
            $item->criterios_evaluacion = CriterioEvaluacion::where('unidad_id', $item->id)
                ->orderBy('item')
                ->get();
        }
        return response()->json(['success' => true,
            'data' => $EspecialidadModulo,
            'message' => 'Lista de Especialidad modulo'], 200);
    }

    public function actualizarGestionarUnidades(Request $request, $id)
    {
        $item = 1;
        foreach ($request->input('unidades') as $unidad) {
            if (array_key_exists('id', $unidad)) {
                if (Unidad::find($unidad['id'])) {
                    Unidad::find($unidad['id'])->update(array("nombre" => $unidad['nombre'], "item" => $item));

                    $item_criterio_evaliacion = 1;
                    foreach ($unidad['criterios_evaluacion'] as $criterio_evaluacion) {
                        if (array_key_exists('id', $criterio_evaluacion)) {
                            if (CriterioEvaluacion::find($criterio_evaluacion['id'])) {
                                CriterioEvaluacion::find($criterio_evaluacion['id'])->update(array("nombre" => $unidad['nombre'], "item" => $item_criterio_evaliacion));

                            }
                        }else{


                                $criterio_evaluacion_nuevo = new CriterioEvaluacion();
                                $criterio_evaluacion_nuevo->item = $item_criterio_evaliacion;
                                $criterio_evaluacion_nuevo->nombre = $criterio_evaluacion['nombre'];
                                $criterio_evaluacion_nuevo->unidad_id = $unidad['id'];
                                $criterio_evaluacion_nuevo->save();


                        }
                        $item_criterio_evaliacion++;
                    }
                } else {

                    $unidad_nuevo = new Unidad();
                    $unidad_nuevo->item = $item;
                    $unidad_nuevo->nombre = $unidad['nombre'];
                    $unidad_nuevo->especialidad_modulo_id = $id;
                    $data_guardada = $unidad_nuevo->save();
                    $item_criterio_evaliacion = 1;
                    foreach ($unidad['criterios_evaluacion'] as $criterio_evaluacion) {
                        $criterio_evaluacion_nuevo = new CriterioEvaluacion();
                        $criterio_evaluacion_nuevo->item = $item_criterio_evaliacion;
                        $criterio_evaluacion_nuevo->nombre = $criterio_evaluacion['nombre'];
                        $criterio_evaluacion_nuevo->unidad_id = $data_guardada->id;
                        $criterio_evaluacion_nuevo->save();
                        $item_criterio_evaliacion++;
                    }

                }
            } else {
                $unidad_nuevo = new Unidad();
                $unidad_nuevo->item = $item;
                $unidad_nuevo->nombre = $unidad['nombre'];
                $unidad_nuevo->especialidad_modulo_id = $id;
                $data_guardada = $unidad_nuevo->save();
                $item_criterio_evaliacion = 1;
                foreach ($unidad['criterios_evaluacion'] as $criterio_evaluacion) {
                    $criterio_evaluacion_nuevo = new CriterioEvaluacion();
                    $criterio_evaluacion_nuevo->item = $item_criterio_evaliacion;
                    $criterio_evaluacion_nuevo->nombre = $criterio_evaluacion['nombre'];
                    $criterio_evaluacion_nuevo->unidad_id = $data_guardada->id;
                    $criterio_evaluacion_nuevo->save();
                    $item_criterio_evaliacion++;
                }
            }
            $item++;

        }
        $EspecialidadModulo = EspecialidadModulo::find($id);
        if (is_null($EspecialidadModulo)) {
            return $this->sendError('Especialidad modulos not found.');
        }
        $EspecialidadModulo->unidades = Unidad::where('especialidad_modulo_id', $id)
            ->orderBy('item')
            ->get();
        foreach ($EspecialidadModulo->unidades as $item) {
            $item->criterios_evaluacion = CriterioEvaluacion::where('unidad_id', $item->id)
                ->orderBy('item')
                ->get();
        }
        return response()->json(['success' => true,
            'data' => $EspecialidadModulo,
            'message' => 'Lista de Especialidad modulo'], 200);

    }
}
