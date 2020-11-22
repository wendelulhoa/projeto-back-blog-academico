<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelMateria;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index(){

    }
    public function create(Request $request){
        ModelMateria::create([
            'nome_materia'=>$request->nomeMateria,
            'cod_materia'=>$request->codMateria,
            'status'=>true
        ]);
    }
}
