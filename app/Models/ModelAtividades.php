<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelAtividades extends Model
{
    use HasFactory;
    protected $table = "tb_atividades";
    public $timestamps = false;
    protected $fillable = ['matricula_aluno', 'cod_atividade', 'data', 'path_atividade'];
}