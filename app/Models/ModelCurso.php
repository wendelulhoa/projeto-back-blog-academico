<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCurso extends Model
{
    use HasFactory;
    protected $table = "tb_curso";
    public $timestamps = false;
    protected $fillable = ['nome_curso', 'valor_curso', 'status'];
}
