<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelEndereco extends Model
{
    use HasFactory;
    protected $table = "tb_endereco";
    public $timestamps = false;
    protected $fillable = ['endereco', 'complemento','bairro', 'estado', 'cidade', 'numero', 'matricula_professor', 'matricula_aluno', 'matricula_admin'];
}
