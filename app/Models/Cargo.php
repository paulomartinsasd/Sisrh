<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;
    protected $fillable = ['descricao'];

    //Relação entre tabelas (Relação N:1)
    public function funionariosAtivos(){
        return $this->hasMany(Funcionario::class)->where('status','=','on');
    }
}
