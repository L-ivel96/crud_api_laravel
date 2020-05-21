<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use ItemVenda;

class Produto extends Model
{
    public $table = "produto";
	protected $fillable = ['produto', 'descricao', 'valor', 'quantidade_estoque'];
    
    public function item_venda()
    {
        return $this->hasMany(ItemVenda::class);
    }
}
