<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Cliente;

class Venda extends Model
{
    public $table = "venda";
	protected $fillable = ['cliente','total_venda','data_venda'];
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function item_venda()
    {
        return $this->hasMany(ItemVenda::class);
    }

}
