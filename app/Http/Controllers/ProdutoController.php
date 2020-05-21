<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Produto;
use Exception;
use App\Services\ChaveApi;

class ProdutoController extends Controller
{
    public function index()
    {
        $dados = array("token" => ChaveApi::acesso_api() );
        return view('produto.listar', $dados);
    }

    public function pagina_cadastrar()
    {
        $dados = array("token" => ChaveApi::acesso_api() );
        return view('produto.cadastrar', $dados);
    }

    public function pagina_editar($id)
    {
        $dados = array(
            "token" => ChaveApi::acesso_api(),
            "id"=>$id
        );
        return view('produto.editar', $dados);
    }

    public function cadastrar(Request $request)
    {
    	try
    	{
            $token_api = ChaveApi::acesso_api();
            if($token_api !== $request->token) {
                throw new Exception("Acesso a API negado! Verifique seu token e tente novamente");
            }

            //formatação
            $valor = $request->valor;
            $quantidade_estoque = (int)$request->quantidade_estoque;
            $descricao = empty($request->descricao) ? "" : $request->descricao;

            if(
                empty($request->produto) || empty($valor)
                || !is_numeric($valor) 
            ) {
                throw new Exception("Os parametros produto({$request->produto}) e valor({$request->valor}) são obrigatórios");  
            }

	    	$dados = array(
	    		"produto" => $request->produto,
	    		"descricao" => $descricao,
	    		"valor" => $valor,
	    		"quantidade_estoque" => $quantidade_estoque
	    	);
	    	return $cliente = Produto::create($dados);

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
            if($token_api !== $request->token) {
                throw new Exception("Acesso a API negado! Verifique seu token e tente novamente");
            }

    		$lista_produto = null;

	    	if(!empty($request->produto)) {
	    		$produto = '%'.$request->produto.'%';
	    		$lista_produto = Produto::where("produto", "like", $produto)->orderBy('produto')->get();
	    	}
            else if(!empty($request->id)) {
                $lista_produto = Produto::where("id_produto", "=", $request->id)->first();
            }
	    	else {
	    		$lista_produto = Produto::orderBy('produto')->get();
	    	}

	    	return $lista_produto;
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
            if($token_api !== $request->token) {
                throw new Exception("Acesso a API negado! Verifique seu token e tente novamente");
            }

            //formatação
            $valor = number_format($request->valor,2,".","");;
            $quantidade_estoque = (int) $request->quantidade_estoque;
            $descricao = empty($request->descricao) ? "" : $request->descricao;

    		if(
    			!is_numeric($request->id) || empty($request->id) 
    			|| empty($request->produto) || empty($valor)
    			|| !is_numeric($valor) 
    		) {
    			throw new Exception("Os parametros id({$request->id}), nome({$request->nome}) e cpf_cnpj({$request->cpf_cnpj}) são obrigatórios");	
    		}

            $dados = array(
                "produto" => $request->produto,
                "descricao" => $descricao,
                "valor" => $valor,
                "quantidade_estoque" => $quantidade_estoque
            );
    		
    		return $update = Produto::where('id_produto', $request->id)->update($dados);
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
            if($token_api !== $request->token) {
                throw new Exception("Acesso a API negado! Verifique seu token e tente novamente");
            }

    		if(!is_numeric($request->id) || empty($request->id)) {
    			throw new Exception("O id é um parametro obrigatório)");
    		}

    		return $excluir = Produto::where('id_produto', $request->id)->delete();
    	}
    	catch(Exception $e)
    	{
    		return 'Erro: '.$e->getMessage();
    	}
    }
}
