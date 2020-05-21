<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Venda;
use App\model\Produto;
use App\model\ItemVenda;
use App\model\Cliente;
use Carbon\Carbon;


class VendaController extends Controller
{
    public function criarVenda(Request $request)
    {
    	try
    	{
    		//Recebe dados do cliente e dos produtos selecionados

    		// Verifica se tem em estoque os produtos

    		//Soma os produtos

	    	$dados_venda = array(
	    		"cliente" => $request->id_cliente,
	    		"total" => $request->total_venda,
	    		"data_venda" => null
	    	);
	    	$venda = Venda::create($dados_venda);

	    	//Add na tabela ItemVenda (com o id da venda criada)

    	}
    	catch(Exception $e)
    	{
    		return 'Erro: '.$e->getMessage();
    	}
    }

    public function editarVenda()
    {
    	try
    	{
    		if(
    			!is_numeric($request->id_cliente) || empty($request->id_cliente) 
    			|| !is_numeric($request->total_venda) || empty($request->total_venda)
    		) {
    			throw new Exception("Os parametros id_cliente({$request->id_cliente}) e total_venda({$request->total_venda}) são obrigatórios");
    		}

    		//Verifica se o registro existe
    		$registro = Venda::where('id_venda', $request->id)->first();
    		if($registro->isEmpty()) {
    			throw new Exception("Registro não encontrado");
    		}

    		//Verifica se não foi finalizada
    		if(!is_null($registro["data_venda"])) {
    			throw new Exception("Não é possível editar, pois esta venda já foi finalizada no dia ".$registro["data_venda"]);
    		}
    		
    		$dados = array(
	    		"cliente" => $request->id_cliente,
	    		"total" => $request->total_venda,
	    		"data_venda" => null
	    	);
    		$update = Venda::where('id_venda', $request->id)->update($dados);
    	}
    	catch(Exception $e)
    	{
    		return 'Erro: '.$e->getMessage();
    	}
    }

    public function finalizarVenda()
    {
    	try
    	{
    		if(
    			!is_numeric($request->id_cliente) || empty($request->id_cliente) 
    			|| !is_numeric($request->total_venda) || empty($request->total_venda)
    		) {
    			throw new Exception("Os parametros id_cliente({$request->id_cliente}) e total_venda({$request->total_venda}) são obrigatórios");	
    		}
    		
    		$dados = array(
	    		"cliente" => $request->id_cliente,
	    		"total" => $request->total_venda,
	    		"data_venda" => Carbon::now()
	    	);
    		$update = Venda::where('id_cliente', $request->id)->update($dados);
    	}
    	catch(Exception $e)
    	{
    		return 'Erro: '.$e->getMessage();
    	}
    }

    public function listarVendas()
    {
    	try
    	{
	    	$lista_cliente = Venda::orderBy('nome')->get();	
	    	return $lista_cliente;
    	}
    	catch(Exception $e)
    	{
    		return 'Erro: '.$e->getMessage();
    	}
    }


}
