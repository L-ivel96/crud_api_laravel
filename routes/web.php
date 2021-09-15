<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ClienteController@index');

Route::get('listar_clientes', 'ClienteController@index')->name('listar_cliente');
Route::get('cadastrar_cliente', 'ClienteController@pagina_cadastrar');
Route::get('editar_cliente/{id}', 'ClienteController@pagina_editar');

Route::get('listar_produto', 'ProdutoController@index')->name('listar_produto');
Route::get('cadastrar_produto', 'ProdutoController@pagina_cadastrar');
Route::get('editar_produto/{id}', 'ProdutoController@pagina_editar');


