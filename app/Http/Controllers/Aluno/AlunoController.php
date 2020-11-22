<?php

namespace App\Http\Controllers\Aluno;

use App\Http\Controllers\Controller;
use App\Models\Aluno\ModelAluno;
use App\Models\ModelEndereco;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
    public function index(){
        return ['aa'];
    }
    public function create(Request $request){
        try{
          //  dd($request);
        DB::transaction(function () use($request){
            ModelAluno::create([
                'nome_aluno'=>$request->nome,
                'cpf'=>$request->cpf,
                'nome_mae'=>$request->nomeMae,
                'data_nascimento'=>$request->dataNasc,
                'rg'=>$request->rg,
                'matricula_aluno'=>$request->matricula,
                'status'=> true,
                'cod_curso'=>'545'
            ]);
            ModelEndereco::create([
                'endereco'=>$request->endereco,
                'complemento'=>$request->complemento,
                'bairro'=>$request->bairro,
                'estado'=>$request->estado,
                'cidade'=>$request->cidade,
                'numero'=>$request->numero,
                'matricula_aluno'=>$request->matricula
            ]);
            User::create([
                'matricula'=>$request->matricula,
                'password'=>$request->password,
                'adm'=>2
            ]);
        });
        return ['sucesso'];
        }catch(Exception $e){
            return response()->json(['message'=>'verifique os campos e tente novamente'], 500);
        }
    }
}
