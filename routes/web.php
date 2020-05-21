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

Route::get('/', 'ClienteController@index')->name('listar_cliente');
Route::get('/pagina_cadastrar', 'ClienteController@pagina_cadastrar');
Route::get('/pagina_editar/{id}', 'ClienteController@pagina_editar');

Route::get('/pagina_listar_produto', 'ProdutoController@index')->name('listar_produto');
Route::get('/pagina_cadastrar_produto', 'ProdutoController@pagina_cadastrar');
Route::get('/pagina_editar_produto/{id}', 'ProdutoController@pagina_editar');


