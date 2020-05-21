<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Clientes
Route::post('/cadastrar_cliente', 'ClienteController@cadastrar');
Route::post('/listar_cliente', 'ClienteController@listar');
Route::put('/editar_cliente', 'ClienteController@editar');
Route::delete('/excluir_cliente', 'ClienteController@excluir');

//Produto
Route::post('/cadastrar_produto', 'ProdutoController@cadastrar');
Route::post('/listar_produto', 'ProdutoController@listar');
Route::put('/editar_produto', 'ProdutoController@editar');
Route::delete('/excluir_produto', 'ProdutoController@excluir');

