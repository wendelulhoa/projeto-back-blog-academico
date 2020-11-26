<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ModelAdmin;
use App\Models\Aluno\ModelAluno;
use App\Models\ModelCurso;
use App\Models\ModelEndereco;
use App\Models\ModelMateria;
use App\Models\Professor\ModelProfessor;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request){
        
        switch($request['tipo']){
            case 'alunos':
               return ModelAluno::paginate(5);
            break;
            case 'professores':
               return ModelProfessor::paginate(5);
            break;
            case 'cursos':
                return ModelCurso::paginate(5);
            break;
            case 'admin':
                return ModelMateria::paginate(5);
            break;
            case 'materia':
                return ModelMateria::paginate(5);
            break;
        }
        
    }
    public function create(Request $request){
        try{
        DB::transaction(function () use($request){
            ModelAdmin::create([
                'nome_admin'=>$request->nome,
                'cpf'=>$request->cpf,
                'nome_mae'=>$request->nomeMae,
                'data_nascimento'=>$request->dataNasc,
                'rg'=>$request->rg,
                'matricula_admin'=>$request->matricula
            ]);
            ModelEndereco::create([
                'endereco'=>$request->endereco,
                'complemento'=>$request->complemento,
                'bairro'=>$request->bairro,
                'estado'=>$request->estado,
                'cidade'=>$request->cidade,
                'numero'=>$request->numero,
                'matricula_admin'=>$request->matricula
            ]);
            User::create([
                'matricula'=>$request->matricula,
                'password'=>Hash::make($request->password),
                'adm'=>0
            ]);
        });
        return ['sucesso'];
        }catch(Exception $e){
            return response()->json(['message'=>'verifique os campos e tente novamente'], 500);
        }
    }
}
