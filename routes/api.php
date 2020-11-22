<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CursoController;
use App\Http\Controllers\Admin\MateriaController;
use App\Http\Controllers\Aluno\AlunoController;
use App\Http\Controllers\Professor\ProfessorController;
use Facade\FlareClient\Http\Response;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'admin'], function () {
    Route::any('/buscar', [AdminController::class, 'index']);
    Route::post('/cadastro/admin', [AdminController::class, 'create']);
    Route::post('/cadastro/curso', [CursoController::class, 'create']);
    Route::post('/cadastro/materia', [MateriaController::class, 'create']);
});
Route::group(['prefix' => 'aluno'], function () {
    Route::any('/find/admin', [AlunoController::class, 'index']);
    Route::post('/cadastro', [AlunoController::class, 'create']);
});
Route::group(['prefix' => 'professor'], function () {
    Route::any('/find/admin', [AdminController::class, 'index']);
    Route::post('/cadastro', [ProfessorController::class, 'create']);
    Route::post('/cadastro/atividade', [ProfessorController::class, 'atividade']);
});
Route::get('professor/atividades', function ()
{
    $file = Storage::disk('public')->get('professor/atividades/nWVzd1BX5YADxfkg3eH722YCYylLmTMWietodC6M.mkv');
    return response()->make($file,200,[ 'Content-Type' => 'video/mp4']);
});


