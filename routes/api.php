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

//Testar remover esta rota
/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

//JWT
Route::group([
    //'middleware' => ['apiJwt'],
    'prefix' => 'auth'
], function ($router) {
    Route::post('registrar', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
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

