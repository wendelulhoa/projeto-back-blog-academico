<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\Aluno\ModelAluno;
use App\Models\ModelAtividade;
use App\Models\ModelAtividades;
use App\Models\ModelBoletim;
use App\Models\ModelEndereco;
use App\Models\ModelMateria;
use App\Models\Professor\ModelProfessor;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfessorController extends Controller
{
    public function index(Request $request)
    {
        switch($request['tipo']){
            case 'cod':
                return ModelProfessor::where('matricula_professor', $request->matricula)
                ->with('materia')
                ->get();
            break;
            case 'atividade':
                return ModelAtividade::where('cod_materia', 100)->paginate(5);
            break;
            case 'alunos':
                return ModelAluno::all();
            break;
            case 'atividades':
                return ModelAtividades::join('tb_aluno', 'tb_aluno.matricula_aluno','=', 'tb_atividades.matricula_aluno')->
                where('tb_atividades.cod_atividade', $request->cod)
                ->paginate(5);
             break;
            
        }
    }
    public function create(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                ModelProfessor::create([
                    'nome_professor' => $request->nome,
                    'cpf' => $request->cpf,
                    'nome_mae' => $request->nomeMae,
                    'data_nascimento' => $request->dataNasc,
                    'rg' => $request->rg,
                    'matricula_professor' => $request->matricula,
                    'cod_materia' => $request->materia
                ]);
                ModelEndereco::create([
                    'endereco' => $request->endereco,
                    'complemento' => $request->complemento,
                    'bairro' => $request->bairro,
                    'estado' => $request->estado,
                    'cidade' => $request->cidade,
                    'numero' => $request->numero,
                    'matricula_professor' => $request->matricula
                ]);
                User::create([
                    'matricula' => $request->matricula,
                    'password' => Hash::make($request->password),
                    'adm' => 1
                ]);
            });
            return ['sucesso'];
        } catch (Exception $e) {
            return response()->json(['message' => 'verifique os campos e tente novamente'], 500);
        }
    }
    public function atividade(Request $request)
    {
        if (isset($request['file'])){
            $path = $request->file->store('professor/atividades');
        } else{
            $path ='';
        }
        ModelAtividade::create([
            'matricula_professor'=>$request->matricula,
            'cod_materia'=>$request->codMateria,
            'titulo'=>$request->titulo,
            'texto_add'=>$request->textoAdd,
            'data'=>$request->data,
            'path_atividade'=>$path
        ]);
    }
    public function notas(Request $request){
       
   
        if($request['semestre']  == "a1"){
            ModelBoletim::create([
                'nota_a1'=>$request->nota,
                'cod_materia'=>$request->cod,
                'matricula_aluno'=>$request->matricula
            ]);
            
        }else{
           DB::table('tb_boletim')
              ->where([['matricula_aluno',$request->matricula], ['cod_materia',$request->cod]])
              ->update(['nota_a2' => $request->nota]);
        }
        
    }
}
