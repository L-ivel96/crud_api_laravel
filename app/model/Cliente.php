<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Vendas;

class Cliente extends Model
{
	public $table = "cliente";
	protected $fillable = ['cpf_cnpj','nome'];
    
    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }

}
