<?php

namespace App\Models\Professor;

use App\Models\ModelMateria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelProfessor extends Model
{
    use HasFactory;
    protected $table = "tb_professor";
    public $timestamps = false;
    protected $fillable = ['nome_professor', 'matricula_professor','cpf', 'nome_mae', 'data_nascimento', 'rg', 'status', 'cod_materia'];

    public function materia(){
        return $this->hasMany(ModelMateria::class, 'cod_materia', 'cod_materia');
    }
}
