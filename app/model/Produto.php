<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use ItemVenda;

class Produto extends Model
{
    public $table = "produto";
	protected $fillable = ['produto', 'descricao', 'valor', 'created_at', 'updated_at'];
    
    public function item_venda()
    {
        return $this->hasMany(ItemVenda::class);
    }
}
