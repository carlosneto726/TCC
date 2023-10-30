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
use App\Http\Controllers\AssociadoController;

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

/*
|--------------------------------------------------------------------------
| CooperativaController
|--------------------------------------------------------------------------
*/
Route::get('/cooperativa/{cooperativa}', [CooperativaController::class, 'viewCooperativa']);
Route::post('/atualizar/cooperativa', [CooperativaController::class, 'updateCooperativa']);
Route::get('/associados', [CooperativaController::class, 'viewAssociados']);
Route::post('/adicionar/associado', [CooperativaController::class, 'addAssociado']);
Route::get('/remover/associado/{id_associado}', [CooperativaController::class, 'deleteAssociado']);
// Rotas a para pedidos
Route::get('/pedidos/cooperativa', [CooperativaController::class, 'viewPedidos']);
Route::get('/pedidos/concluir', [CooperativaController::class, 'concluirPedido']);
Route::get('/pedidos/cancelar', [CooperativaController::class, 'cancelarPedido']);
Route::get('/pedidos/chat/usuario/{id_pedido}', [CooperativaController::class, 'chatCliente']);



/*
|--------------------------------------------------------------------------
| AssociadoController
|--------------------------------------------------------------------------
*/
Route::get('/meusprodutos', [AssociadoController::class, 'viewProdutos']);
Route::post('/cadastrar/produto', [AssociadoController::class, 'addProduto']);
Route::post('/atualizar/produto', [AssociadoController::class, 'updateProduto']);


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

//Route::get('/preco/cooperativa', [ContaController::class, 'viewPreco']);
Route::get('/cadastrar/cooperativa', [ContaController::class, 'viewCadastroCooperativa']);
Route::post('/cadastrar/cooperativa', [ContaController::class, 'addCooperativa']);

Route::get('/cadastrar/usuario', [ContaController::class, 'viewUsuarioCadastro']);
Route::post('/cadastrar/usuario', [ContaController::class, 'addUsuario']);

/*
|--------------------------------------------------------------------------
| UsuarioController
|--------------------------------------------------------------------------
*/
Route::get('/perfil', [UsuarioController::class, 'viewPerfil']);
Route::post('/usuario/atualizar', [UsuarioController::class, 'updateUsuario']);
Route::get('/adicionar/associado/{id_cooperativa}/{token}', [UsuarioController::class, 'validarAssociado']);
Route::get('/pedidos/usuario', [UsuarioController::class, 'viewPedidos']);
Route::get('/pedidos/chat/cooperativa/{id_pedido}', [UsuarioController::class, 'chatCooperativa']);

// ForumController
Route::get('/foruns', [ForumController::class, 'viewForuns']);

Route::get('/forum/{id_forum}', [ForumController::class, 'viewForum']);
Route::post('/forum/adicionar_forum', [ForumController::class, 'createTopic']);











// ChatController
Route::get('/chats', [ChatController::class, 'viewChats']);
Route::get('/chat/{chat}', [ChatController::class, 'viewChat']);

// CarrinhoController
Route::get('/carrinho/add', [CarrinhoController::class, 'addProduto']);
Route::get('/carrinho', [CarrinhoController::class, 'viewCarrinho']);
Route::post('/carrinho/update', [CarrinhoController::class, 'updateQuantidade']);
Route::post('/carrinho/del', [CarrinhoController::class, 'delProduto']);
Route::post('/carrinho/finalizar', [CarrinhoController::class, 'endCarrinho']);

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
