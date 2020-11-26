<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBoletim extends Model
{
    use HasFactory;
    protected $table = "tb_boletim";
    public $timestamps = false;
    protected $fillable = ['nota_a1', 'nota_a2', 'media_final', 'status', 'matricula_aluno', 'cod_materia'];
}
