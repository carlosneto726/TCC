<?php

use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\PedidosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rotas básicas
Route::get('/', 'App\Http\Controllers\UserController@index');
Route::get('/pesquisa', 'App\Http\Controllers\UserController@pesquisa');
Route::get('/produto', 'App\Http\Controllers\UserController@pagina_produto');
Route::get('/cooperativa', 'App\Http\Controllers\UserController@cooperativa');
// Rotas sobre cadastro e login
Route::get('/sair', 'App\Http\Controllers\UserController@sair');
Route::get('/login', 'App\Http\Controllers\UserController@login');
Route::post('/login', 'App\Http\Controllers\UserController@validar_login');
Route::get('/cadastro', 'App\Http\Controllers\UserController@cadastro');
Route::get('/cadastro/usuario', 'App\Http\Controllers\UserController@cadastro_usuario');
Route::get('/cadastro/cooperativa', 'App\Http\Controllers\UserController@cadastro_cooperativa');
Route::post('/cadastro/usuario', 'App\Http\Controllers\UserController@cadastrar_usuario');
Route::post('/cadastro/cooperativa', 'App\Http\Controllers\UserController@cadastrar_cooperativa');
// Rotas sobre forum
Route::get('/forum/adicionar_forum', [ForumController::class, 'createTopic']);
Route::get('/forum', [ForumController::class, 'viewForum']);
Route::get('/foruns', [ForumController::class, 'viewForuns']);
// Rotas sobre o chat
Route::get('/chats', [ChatController::class, 'viewChats']);
Route::get('/chat', [ChatController::class, 'viewChat']);
// Rotas sobre cadastro de produtos
Route::post('/cadastrar/produto', 'App\Http\Controllers\UserController@cadastrar_produto');
Route::post('/atualizar/produto', 'App\Http\Controllers\UserController@atualizar_produto');
Route::post('/atualizar/cooperativa', 'App\Http\Controllers\UserController@atualizar_cooperativa');
// Rotas sobre o carrinho
Route::get('/carrinho/add', [CarrinhoController::class, 'addProduto']);
Route::get('/carrinho', [CarrinhoController::class, 'viewCarrinho']);
Route::post('/carrinho/update', [CarrinhoController::class, 'updateQuantidade']);
Route::post('/carrinho/del', [CarrinhoController::class, 'delProduto']);
Route::post('/carrinho/finalizar', [CarrinhoController::class, 'endCarrinho']);
// Rotas sobre pedidos
Route::get('/pedidos', [PedidosController::class, 'viewPedidos']);


Route::get('/teste', [UserController::class, 'generateChart']);
Route::post('/avaliar', [UserController::class, 'avaliarProduto']);
Route::get('/teste', [UserController::class, 'generateChart']);







