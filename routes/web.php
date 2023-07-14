<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\PesquisaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\RelatoriosController;
use App\Http\Controllers\CooperativaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CaixaController;

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

// HomeController
Route::get('/', [HomeController::class, 'index']);
// PesquisaController
Route::get('/pesquisa', [PesquisaController::class, 'pesquisa']);
// ProdutoController
Route::get('/produto', [ProdutoController::class, 'viewProduto']);
Route::post('/avaliar', [ProdutoController::class, 'avaliarProduto']);
// CooperativaController
Route::get('/cooperativa', [CooperativaController::class, 'viewCooperativa']);
Route::post('/cadastrar/produto', [CooperativaController::class, 'addProduto']);
Route::post('/atualizar/produto', [CooperativaController::class, 'updateProduto']);
Route::post('/atualizar/cooperativa', [CooperativaController::class, 'updateCooperativa']);
Route::post('/cadastrar/cooperativa', [CooperativaController::class, 'addCooperativa']);
Route::get('/cadastrar/cooperativa', [CooperativaController::class, 'viewCadastroUsuario']);
// ContaController
Route::get('/sair', [ContaController::class, 'sair']);
Route::get('/entrar', [ContaController::class, 'entrar']);
Route::post('/entrar', [ContaController::class, 'validarLogin']);
Route::get('/cadastrar', [ContaController::class, 'cadastrar']);
// UsuarioController
Route::get('/cadastrar/usuario', [UsuarioController::class, 'viewUsuarioCadastro']);
Route::post('/cadastrar/usuario', [UsuarioController::class, 'addUsuario']);
// ForumController
Route::post('/forum/adicionar_forum', [ForumController::class, 'createTopic']);
Route::get('/forum', [ForumController::class, 'viewForum']);
Route::get('/foruns', [ForumController::class, 'viewForuns']);
// ChatController
Route::get('/chats', [ChatController::class, 'viewChats']);
Route::get('/chat', [ChatController::class, 'viewChat']);
// CarrinhoController
Route::get('/carrinho/add', [CarrinhoController::class, 'addProduto']);
Route::get('/carrinho', [CarrinhoController::class, 'viewCarrinho']);
Route::post('/carrinho/update', [CarrinhoController::class, 'updateQuantidade']);
Route::post('/carrinho/del', [CarrinhoController::class, 'delProduto']);
Route::post('/carrinho/finalizar', [CarrinhoController::class, 'endCarrinho']);
// PedidosController
Route::get('/pedidos', [PedidosController::class, 'viewPedidos']);
Route::get('/pedidos/concluir', [PedidosController::class, 'concluirPedido']);
Route::get('/pedidos/cancelar', [PedidosController::class, 'cancelarPedido']);
Route::get('/pedidos/chat', [PedidosController::class, 'chatCliente']);
// RelatoriosController
Route::get('/relatorios', [RelatoriosController::class, 'viewVendas']);
Route::get('/relatorios/vendas', [RelatoriosController::class, 'viewVendas']);
Route::get('/relatorios/maisvendidos', [RelatoriosController::class, 'viewMaisVendidos']);
Route::get('/relatorios/receita', [RelatoriosController::class, 'viewReceita']);
Route::get('/relatorios/locaisvendidos', [RelatoriosController::class, 'viewLocaisVendidos']);
// CaixaController
Route::get('/caixa', [CaixaController::class, 'viewCaixaTotal']);
Route::get('/caixa/total', [CaixaController::class, 'viewCaixaTotal']);
Route::get('/caixa/ano', [CaixaController::class, 'viewCaixaAno']);
Route::get('/caixa/mes', [CaixaController::class, 'viewCaixaMes']);
Route::get('/caixa/dia', [CaixaController::class, 'viewCaixaDia']);
