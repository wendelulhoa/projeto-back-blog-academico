<?php

namespace App\Models\Aluno;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelAluno extends Model
{
    use HasFactory;
    protected $table = 'tb_aluno';
    public $timestamps = false;
    protected $fillable = ['nome_aluno', 'matricula_aluno','cpf', 'nome_mae', 'data_nascimento', 'rg', 'status', 'cod_curso'];
}
