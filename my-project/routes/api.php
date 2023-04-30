<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Setup\MatriculaController;
use App\Http\Controllers\Api\Setup\TareaController as SetupTareaController;
use Setup\AplicacionController;
use Setup\BecaController;
use Setup\CicloAcademicoController;
use Setup\EspecialidadController;
use Setup\EspecialidadModuloController;
use Setup\EstadoCivilController;
use Setup\EstudianteController;
use Setup\GradoInstruccionController;
use Setup\InstitucionConvenioController;
use Setup\LaboratorioController;
use Setup\MenuController;
use Setup\ModuloAcademicoController;
use Setup\ModuloController;
use Setup\NivelCicloController;
use Setup\PersonalController;
use Setup\RolController;
use Setup\RolModuloController;
use Setup\RolUsuarioController;
use Setup\TipoProgramaController;

Route::resource('rol', RolController::class);
Route::resource('modulo', ModuloController::class);
Route::get('modulo-padre', 'Setup\ModuloController@index_parent');
Route::get('usuario', 'AuthController@list_users');
Route::resource('rol-modulo', RolModuloController::class);
Route::resource('rol-usuario', RolUsuarioController::class);
Route::resource('menu', MenuController::class);

Route::get('ubigeo-departamento', 'Setup\UbigeoController@listar_departamentos');
Route::get('ubigeo-provincia/{depId}', 'Setup\UbigeoController@listar_provincias');
Route::get('ubigeo-distrito/{provId}', 'Setup\UbigeoController@listar_distritos');

Route::resource('especialidad', EspecialidadController::class);
Route::resource('ciclo-academico', CicloAcademicoController::class);
Route::resource('estudiantes', EstudianteController::class);
Route::resource('estado-civil', EstadoCivilController::class);
Route::resource('laboratorio', LaboratorioController::class);

Route::resource('grado-instruccion', GradoInstruccionController::class);
Route::resource('personal', PersonalController::class);
Route::resource('nivel-ciclo', NivelCicloController::class);
Route::resource('beca', BecaController::class);
Route::resource('institucion-convenio', InstitucionConvenioController::class);
Route::resource('tipo-programa', TipoProgramaController::class);
Route::resource('modulo-academico', ModuloAcademicoController::class);
Route::resource('tareas', SetupTareaController::class);
Route::resource('matricula', MatriculaController::class);
Route::get('modulo-academico-especialidad/{id}', 'Setup\ModuloAcademicoController@indexByEspecialite');


Route::resource('especialidad-modulos', EspecialidadModuloController::class);

Route::get('especialidad-modulos-gestionar-unidad/{id}', 'Setup\EspecialidadModuloController@listarPorIdParaGestionarUnidades');
Route::put('especialidad-modulos-gestionar-unidad/{id}', 'Setup\EspecialidadModuloController@actualizarGestionarUnidades');



Route::resource('aplicacion', AplicacionController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
