<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'funcionario';
    protected $primaryKey = 'id_func';
    protected $fillable=[
        'nome_func',
        'nome_filial',
        'nome_departamento',
        'cargo_func',
        'sal_func'
    ];
    public $timestamps = false;
    public array $rules=[
        'nome_func'=>'required|min:5|max:100|alpha'
    ];
}
?>