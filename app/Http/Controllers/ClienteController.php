<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Cliente;
use Exception;
use App\Services\ChaveApi;

class ClienteController extends Controller
{
    public function index()
    {
        $dados = array("token" => ChaveApi::acesso_api() );
        return view('cliente.listar', $dados);
    }

    public function pagina_cadastrar()
    {
        $dados = array("token" => ChaveApi::acesso_api() );
        return view('cliente.cadastrar', $dados);
    }

    public function pagina_editar($id)
    {
        $dados = array(
            "token" => ChaveApi::acesso_api(),
            "id"=>$id
        );
        return view('cliente.editar', $dados);
    }

    public function cadastrar(Request $request)
    {
    	try
    	{
            $token_api = ChaveApi::acesso_api();
            if($token_api !== $request->token)
            {
                throw new Exception("Acesso a API negado! Verifique seu token e tente novamente");
            }
    		if(empty($request->nome) || empty($request->cpf_cnpj) )
    		{
    			throw new Exception("Os parametros nome({$request->nome}) e cpf_cnpj({$request->cpf_cnpj}) são obrigatórios");	
    		}

	    	$dados = array(
	    		"cpf_cnpj" => $request->cpf_cnpj,
	    		"nome" => $request->nome
	    	);
	    	return $cliente = Cliente::create($dados);

    	}
    	catch(Exception $e)
    	{
    		return 'Erro: '.$e->getMessage();
    	}
    }

    public function listar(Request $request)
    {
    	try
    	{
            $token_api = ChaveApi::acesso_api();
            if($token_api !== $request->token)
            {
                throw new Exception("Acesso a API negado! Verifique seu token e tente novamente");
            }

    		$lista_cliente = null;

	    	if(!empty($request->nome)) {
	    		$nome = '%'.$request->nome.'%';
	    		$lista_cliente = Cliente::where("nome", "like", $nome)->orderBy('nome')->get();
	    	}
            else if(!empty($request->id)) {
                $lista_cliente = Cliente::where("id_cliente", "=", $request->id)->first();
            }
	    	else {
	    		$lista_cliente = Cliente::orderBy('nome')->get();
	    	}

	    	return $lista_cliente;
    	}
    	catch(Exception $e)
    	{
    		return 'Erro: '.$e->getMessage();
    	}
    }

    public function editar(Request $request)
    {
    	try
    	{
            $token_api = ChaveApi::acesso_api();
            if($token_api !== $request->token)
            {
                throw new Exception("Acesso a API negado! Verifique seu token e tente novamente");
            }

    		if(
    			!is_numeric($request->id) || empty($request->id) 
    			|| empty($request->nome) || empty($request->cpf_cnpj) 
    		) {
    			throw new Exception("Os parametros id({$request->id}), nome({$request->nome}) e cpf_cnpj({$request->cpf_cnpj}) são obrigatórios");	
    		}
    		
    		return $update = Cliente::where('id_cliente', $request->id)->update(['nome' => $request->nome,'cpf_cnpj' => $request->cpf_cnpj]);
    	}
    	catch(Exception $e)
    	{
    		return 'Erro: '.$e->getMessage();
    	}

    }

    public function excluir(Request $request)
    {
    	try
    	{
            $token_api = ChaveApi::acesso_api();
            if($token_api !== $request->token)
            {
                throw new Exception("Acesso a API negado! Verifique seu token e tente novamente");
            }

    		if(!is_numeric($request->id) || empty($request->id)) {
    			throw new Exception("O id é um parametro obrigatório)");
    		}

    		return $excluir = Cliente::where('id_cliente', $request->id)->delete();
    	}
    	catch(Exception $e)
    	{
    		return 'Erro: '.$e->getMessage();
    	}
    }

}
