<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CursoController;
use App\Http\Controllers\Admin\MateriaController;
use App\Http\Controllers\Aluno\AlunoController;
use App\Http\Controllers\AuthController;
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
    Route::any('/find', [AlunoController::class, 'index']);
    Route::post('/cadastro', [AlunoController::class, 'create']);
    Route::post('/cadastro/atividade', [AlunoController::class, 'atividade']);
   
});
Route::group(['prefix' => 'professor'], function () {
    Route::any('/find', [ProfessorController::class, 'index']);
    Route::post('/cadastro', [ProfessorController::class, 'create']);
    Route::post('/cadastro/atividade', [ProfessorController::class, 'atividade']);
    Route::post('/cadastro/nota', [ProfessorController::class, 'notas']);
});
Route::get('professor/atividades/{args}', function ($args)
{
    $file = Storage::disk('local')->get("professor/atividades/$args");
    if(strpos($args, 'pdf')){
        return response()->make($file,200,[ 'Content-Type' => 'application/pdf']);
    }else if(strpos($args, 'jpeg')){
        return response()->make($file,200,[ 'Content-Type' => 'image/jpeg']);
    }else if(strpos($args, 'png')){
        return response()->make($file,200,[ 'Content-Type' => 'image/png']);
    }else{
        return response()->make($file,200,[ 'Content-Type' => 'application/vnd.oasis.opendocument.text']);
    }
    
});
Route::group([
    'prefix' => 'auth',
], function ($router) {
    Route::any('refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::any('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('me', [AuthController::class, 'me'])->name('me');
    Route::any('login', [AuthController::class, 'login'])->name('login');
});


