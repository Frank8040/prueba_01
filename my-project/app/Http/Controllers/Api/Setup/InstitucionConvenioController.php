<?php

namespace App\Http\Controllers\Api\Setup;
use App\Models\Setup\InstitucionConvenio;

use App\Models\Setup\ModuloAcademico;
use Illuminate\Http\Request;


class InstitucionConvenioController
{
    public function index(Request $request)
    {
        $data = InstitucionConvenio::select('institucion_convenio.id',
            'institucion_convenio.nombre',
            'institucion_convenio.direccion',
            'institucion_convenio.celular',
            'institucion_convenio.correo',
            'ubigeo.desc_dep_inei as departamento_id',
            'ubigeo.desc_prov_inei as provincia_id',
            'ubigeo.desc_ubigeo_inei as distrito_id')
            ->leftJoin('ubigeo', 'institucion_convenio.distrito_id', 'ubigeo.cod_ubigeo_inei')
            ->get();

        return response()->json(['success' => true,
            'data' => $data,
            'message' => 'lista de InstitucionConvenios'], 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        InstitucionConvenio::create($input);
        return response()->json(['success' => true,
            'data' => InstitucionConvenio::all(),
            'message' => 'Lista de InstitucionConvenios'], 200);
    }
    public function show($id)
    {
        $InstitucionConvenio = InstitucionConvenio::find($id);

        if (is_null($InstitucionConvenio)) {
            return $this->sendError('InstitucionConvenios not found.');
        }
        return response()->json(['success' => true,
            'data' => $InstitucionConvenio,
            'message' => 'InstitucionConvenio por id'], 200);
    }

    public function update(Request $request,$id)
    {

        InstitucionConvenio::find($id)->update($request->all());
        return response()->json(['success' => true,
            'data' => InstitucionConvenio::all(),
            'message' => 'Lista de InstitucionConvenios'], 200);

    }
    public function destroy($id)
    {
        InstitucionConvenio::find($id)->delete();
        return response()->json(['success' => true,
            'data' => InstitucionConvenio::all(),
            'message' => 'Lista de InstitucionConvenios'], 200);
    }
}
