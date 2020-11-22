<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelCurso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index(){

    }
    public function create(Request $request){
        ModelCurso::create([
            'nome_curso'=>$request->nomeCurso,
            'valor_curso'=>$request->valorCurso,
            'status'=>true
        ]);
    }
}
