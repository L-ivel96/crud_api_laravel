<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Vendas;

class Cliente extends Model
{
	public $table = "cliente";
	protected $fillable = ['cpf_cnpj','nome', 'created_at', 'updated_at'];
    
    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }

}
