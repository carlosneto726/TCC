<?php

use App\Http\Controllers\CompararController;
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


use App\Http\Controllers\TestsController;

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
Route::get('/', [HomeController::class, 'viewHome']);
Route::get('/sobre', [HomeController::class, 'viewSobre']);
Route::get('/termos', [HomeController::class, 'viewTermos']);
// PesquisaController
Route::get('/pesquisa', [PesquisaController::class, 'viewPesquisa']);
Route::get('/pesquisa/{categoria}', [PesquisaController::class, 'viewPesquisaCategoria']);
// ProdutoController
Route::get('/produto/{produto}', [ProdutoController::class, 'viewProduto']);
Route::post('/avaliar', [ProdutoController::class, 'avaliarProduto']);
Route::get('/favoritos', [ProdutoController::class, 'viewFavoritos']);
Route::get('/produto/{produto}/favoritar/{favorito}', [ProdutoController::class, 'favorito']);
// CooperativaController
Route::get('/cooperativa/{cooperativa}', [CooperativaController::class, 'viewCooperativa']);
Route::get('/meusprodutos', [CooperativaController::class, 'viewProdutos']);
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
Route::get('/validar/usuario/{token}', [ContaController::class, 'validarEmailUsuario']);
Route::get('/validar/cooperativa/{token}', [ContaController::class, 'validarEmailCooperativa']);
Route::get('/redefinir-senha', [ContaController::class, 'viewRedefinirSenha']);
Route::post('/redefinir-senha/{token}', [ContaController::class, 'redefinirSenha']);
Route::get('/atualizar-senha/{token}', [ContaController::class, 'viewAtualizarSenha']);
Route::post('/redefinir-senha', [ContaController::class, 'redefinirSenhaEmail']);
// UsuarioController
Route::get('/cadastrar/usuario', [UsuarioController::class, 'viewUsuarioCadastro']);
Route::post('/cadastrar/usuario', [UsuarioController::class, 'addUsuario']);
Route::get('/perfil', [UsuarioController::class, 'viewPerfil']);
Route::post('/usuario/atualizar', [UsuarioController::class, 'updateUsuario']);
// ForumController
Route::post('/forum/adicionar_forum', [ForumController::class, 'createTopic']);
Route::get('/forum', [ForumController::class, 'viewForum']);
Route::get('/foruns', [ForumController::class, 'viewForuns']);
// ChatController
Route::get('/chats', [ChatController::class, 'viewChats']);
Route::get('/chat/{chat}', [ChatController::class, 'viewChat']);
// CarrinhoController
Route::get('/carrinho/add', [CarrinhoController::class, 'addProduto']);
Route::get('/carrinho', [CarrinhoController::class, 'viewCarrinho']);
Route::post('/carrinho/update', [CarrinhoController::class, 'updateQuantidade']);
Route::post('/carrinho/del', [CarrinhoController::class, 'delProduto']);
Route::post('/carrinho/finalizar', [CarrinhoController::class, 'endCarrinho']);
// PedidosController
Route::get('/pedidos', [PedidosController::class, 'viewPedidos']);
Route::get('/pedidos', [PedidosController::class, 'viewPedidos']);
Route::get('/pedidos/concluir', [PedidosController::class, 'concluirPedido']);
Route::get('/pedidos/cancelar', [PedidosController::class, 'cancelarPedido']);
Route::get('/pedidos/chat/{id_pedido}', [PedidosController::class, 'chatCliente']);
// RelatoriosController
Route::get('/relatorios', [RelatoriosController::class, 'viewVendas']);
Route::get('/relatorios/vendas', [RelatoriosController::class, 'viewVendas']);
Route::get('/relatorios/maisvendidos', [RelatoriosController::class, 'viewMaisVendidos']);
Route::get('/relatorios/locaisvendidos', [RelatoriosController::class, 'viewLocaisVendidos']);
Route::get('/relatorios/receita', [RelatoriosController::class, 'viewReceita']);
// CompararController
Route::get('/comparar', [CompararController::class, 'viewComparar']);
Route::get('/comparar/{id_produto}', [CompararController::class, 'addComparacao']);

Route::get('/teste', [TestsController::class, 'teste']);
