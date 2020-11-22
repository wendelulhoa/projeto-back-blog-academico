<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\ModelEndereco;
use App\Models\Professor\ModelProfessor;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfessorController extends Controller
{
    public function index(){
        
    }
    public function create(Request $request){
        try{
        DB::transaction(function () use($request){
            ModelProfessor::create([
                'nome_professor'=>$request->nome,
                'cpf'=>$request->cpf,
                'nome_mae'=>$request->nomeMae,
                'data_nascimento'=>$request->dataNasc,
                'rg'=>$request->rg,
                'matricula_professor'=>$request->matricula,
                'cod_materia'=>544
            ]);
            ModelEndereco::create([
                'endereco'=>$request->endereco,
                'complemento'=>$request->complemento,
                'bairro'=>$request->bairro,
                'estado'=>$request->estado,
                'cidade'=>$request->cidade,
                'numero'=>$request->numero,
                'matricula_professor'=>$request->matricula
            ]);
            User::create([
                'matricula'=>$request->matricula,
                'password'=>$request->password,
                'adm'=>1
            ]);
        });
        return ['sucesso'];
        }catch(Exception $e){
            return response()->json(['message'=>'verifique os campos e tente novamente'], 500);
        }
    }
    public function atividade(Request $request){
        if($request->file->isValid()){
            return $request->file->store('professor/atividades');
        }else{
            return ['erro'];
        }
    }
}
