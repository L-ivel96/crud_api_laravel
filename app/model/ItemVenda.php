<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Cliente;
use Produto;

class ItemVenda extends Model
{
    public $table = "cliente";
	protected $fillable = ['cpf_cnpj','nome'];
    
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function venda()
    {
        return $this->belongsTo(Produto::class);
    }

}
