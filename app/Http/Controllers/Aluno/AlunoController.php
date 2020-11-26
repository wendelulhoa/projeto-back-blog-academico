<?php

namespace App\Http\Controllers\Aluno;

use App\Http\Controllers\Controller;
use App\Models\Aluno\ModelAluno;
use App\Models\ModelAtividade;
use App\Models\ModelAtividades;
use App\Models\ModelCurso;
use App\Models\ModelEndereco;
use App\Models\ModelMateria;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AlunoController extends Controller
{
    public function index(Request $request){
        switch($request['tipo']){
            case 'atividade':
                return ModelMateria::where('cod_materia', $request['cod'])->with('atividade')->get();
            break;
            case 'materia':
                return ModelMateria::paginate(5);
            break;
            case 'boletim':
                return ModelMateria::where('matricula_aluno', $request->cod)
                ->join('tb_boletim', 'tb_boletim.cod_materia','=', 'tb_materia.cod_materia')
                ->get();
            break;
            case 'cursos':
              return  ModelCurso::all();
            break;
            case 'nome':
             return  ModelAluno::where('matricula_aluno', $request->matricula)->select('nome_aluno')->get();
            break;
        }
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
                'cod_curso'=>$request->curso
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
                'password'=>Hash::make($request->password),
                'adm'=>2
            ]);
        });
        return ['sucesso'];
        }catch(Exception $e){
            return response()->json(['message'=>'verifique os campos e tente novamente'], 400);
        }
    }
    public function atividade(Request $request)
    {
        if (isset($request['file'])){
            $path = $request->file->store('professor/atividades');
        } else{
            $path ='';
        }
        date_default_timezone_set('America/Sao_Paulo');
        // CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
            $dataLocal = date('d/m/Y H:i:s', time());
        ModelAtividades::create([
            'matricula_aluno'=>$request->matricula,
            'cod_atividade'=>$request->cod,
            'data'=>$dataLocal,
            'path_atividade'=>$path
        ]);
        
       
    }
}
