<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelMateria extends Model
{
    use HasFactory;
    protected $table = "tb_materia";
    public $timestamps = false;
    protected $fillable = ['cod_materia', 'nome_materia', 'status'];
}
