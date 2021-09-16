<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Cliente;
use Produto;
use Venda;

class ItemVenda extends Model
{
    public $table = "item_venda";
	protected $fillable = ['venda','produto', 'valor_produto', 'quantidade'];
    
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }

}
