<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelAdmin extends Model
{
    use HasFactory;
    protected $table = "tb_admin";
    public $timestamps = false;
    protected $fillable = ['nome_admin', 'cpf', 'nome_mae', 'data_nascimento', 'rg', 'matricula_admin'];
}
