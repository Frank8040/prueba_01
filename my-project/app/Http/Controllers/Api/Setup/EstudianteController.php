<?php

namespace App\Http\Controllers\Api\Setup;
use App\Models\Setup\Estudiante;

use Illuminate\Http\Request;


class EstudianteController
{
    public function index(Request $request)
    {
        return Estudiante::select('estudiante.id',
            'estudiante.dni',
            'estudiante.apellido_pa',
            'estudiante.apellido_ma',
            'estudiante.nombres',
            'estudiante.correo_electronico',
            'estudiante.celular',
            'estudiante.sexo',
            'estudiante.fe_nacimiento',
            'estudiante.direccion',
            'estudiante.codigo',
            'estado_civil.nombre as estado_civil_id',
            'ubigeo.desc_dep_sunat as departamento_id',
            'ubigeo.desc_prov_sunat as provincia_id',
            'ubigeo.desc_ubigeo_sunat as distrito_id',
            'grado_instruccion.nombre as grado_instruccion_id')
            ->leftJoin('ubigeo','estudiante.distrito_id','ubigeo.cod_ubigeo_sunat')
            ->leftJoin('grado_instruccion','estudiante.grado_instruccion_id','grado_instruccion.id')
            ->leftJoin('estado_civil','estudiante.estado_civil_id','estado_civil.id')
            ->get();
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $input['codigo'] = getdate()['hours'] . getdate()['minutes'] . getdate()['mday'] . getdate()['mon'];

        $resultado = Estudiante::create($input);
        return response()->json(['success' => true,
            'data' => $resultado,
            'message' => 'listado de estudiantes'], 200);
    }
    public function show($id)
    {
        $Estudiante = Estudiante::find($id);
        if (is_null($Estudiante)) {
            return $this->sendError('Estudiantes not found.');
        }
        return response()->json(['success' => true,
            'data' => $Estudiante,
            'message' => 'listado de estudiante por id'], 200);
    }
    public function update(Request $request,$id)
    {
        Estudiante::find($id)->update($request->all());
        return response()->json(['success' => true,
            'data' => Estudiante::all(),
            'message' => 'listado por estudiantes'], 200);
    }
    public function destroy($id)
    {
        Estudiante::find($id)->delete();
        return response()->json(['success' => true,
            'data' => Estudiante::all(),
            'message' => 'listado por estudiantes'], 200);
    }
}
