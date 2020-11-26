<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelAtividade extends Model
{
    use HasFactory;
    protected $table = "tb_atividade";
    public $timestamps = false;
    protected $fillable = ['matricula_professor', 'cod_materia', 'titulo', 'texto_add', 'data', 'path_atividade'];
}
