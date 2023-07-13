<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\ChatController;
use App\Mail\PedidoEmail;
use Illuminate\Support\Facades\Mail;

session_start();
class PedidosController extends Controller
{
    public function viewPedidos(){
        $pedidos_pendentes = $this->getPedidos("= 0");
        $pedidos_concluidos = $this->getPedidos("!= 0");
        return view('cooperativa.pedidos', compact('pedidos_pendentes', 'pedidos_concluidos'));
    }

    public function concluirPedido(){
        $id_pedido = request("id_pedido");
        $query = "AND tb_pedidos.id =".$id_pedido;
        $pedido = $this->getPedidos("= 0", $query);
        $id_cooperativa = $_COOKIE['cooperativa'];

        foreach ($pedido[0]->produtos as $pedido_produto) {
            $produto = DB::select("SELECT * FROM tb_produtos WHERE tb_produtos.id = ?", [$pedido_produto->pid]);
            $qtd = $produto[0]->quantidade;
            $qtd_pedido_produto = $pedido_produto->pqtd;

            if(($qtd - $qtd_pedido_produto) < 0){
                AlertController::alert("Parece que você não possui estoque o suficiente.", "danger");
                return redirect("/pedidos");
            }else{
                DB::update("UPDATE tb_produtos SET quantidade = ? WHERE id = ?", [($qtd - $qtd_pedido_produto), $produto[0]->id]);
                DB::update("UPDATE tb_pedidos SET status = ? WHERE id = ?", [1, $id_pedido]);
            }
        }
        DB::insert("INSERT INTO tb_vendas (id_pedido, data, preco_total) VALUES (?, NOW(), ?);", [$id_pedido, $pedido[0]->preco_total]);

        $email_usuario = DB::select("   SELECT tb_usuarios.email 
                                        FROM tb_usuarios
                                        WHERE tb_usuarios.id IN 
                                            (SELECT tb_pedidos.id_usuario
                                            FROM tb_pedidos WHERE tb_pedidos.id = ?);", 
        [$id_pedido]);

        $produtos_pedido = DB::select(" SELECT tb_produtos.nome as pnome, 
                                            tb_produtos.imagem as pimg, 
                                            tb_produtos.preco as ppreco,
                                            tb_produtos.id as pid,
                                            tb_itens_pedido.quantidade as pqtd
                                            FROM tb_itens_pedido
                                            INNER JOIN tb_produtos ON tb_itens_pedido.id_produto = tb_produtos.id
                                            WHERE tb_itens_pedido.id_pedido = ? AND tb_produtos.id_cooperativa = ?;", 
        [$id_pedido, $id_cooperativa]);
        $nome_cooperativa = DB::select("SELECT tb_cooperativas.nome FROM tb_cooperativas WHERE tb_cooperativas.id = ?", [$id_cooperativa]);

        $dados = [
            'nome' => $nome_cooperativa[0]->nome,
            'email' => $email_usuario[0]->email,
            'chat' => 'http://127.0.0.1:8000/pedidos/chat?id_pedido='.$id_pedido,
            'status' => 'Concluído',
            'produtos_pedido' => [],
        ];

        $dados['produtos_pedido'] = $produtos_pedido;
    
        Mail::to('carlosneto726@gmail.com')->send(new PedidoEmail($dados, 'finalizarPedido'));
        AlertController::alert("Pedido concluído.", "success");
        return redirect("/pedidos");
    }

    public function cancelarPedido(){
        $id_pedido = request("id_pedido");
        DB::update("UPDATE tb_pedidos SET status = ? WHERE id = ?", [2, $id_pedido]);

        AlertController::alert("Produto cancelado.", "warning");
        return redirect("/pedidos");
        
    }

    public function getPedidos($status_pedido, $id_pedido = null){
        $id_cooperativa = $_COOKIE['cooperativa'];
        $preco_total_pedido = 0;

        $pedidos = DB::select(" SELECT * FROM tb_pedidos 
                                WHERE tb_pedidos.status ".$status_pedido." ".$id_pedido." AND tb_pedidos.id IN 
                                    (SELECT tb_itens_pedido.id_pedido FROM tb_itens_pedido
                                    WHERE tb_itens_pedido.id_produto IN 
                                        (SELECT tb_produtos.id FROM tb_produtos
                                        WHERE tb_produtos.id_cooperativa IN
                                            (SELECT tb_cooperativas.id FROM tb_cooperativas
                                            WHERE tb_cooperativas.id = ?)
                                        )
                                    ) ORDER BY id DESC;", 
            [$id_cooperativa]);

        foreach ($pedidos as $pedido) {
            $nome_usuario = DB::select("SELECT nome FROM tb_usuarios WHERE id = ?", [$pedido->id_usuario]);
            $produtos_pedido = DB::select(" SELECT tb_produtos.nome as pnome, 
                                            tb_produtos.imagem as pimg, 
                                            tb_produtos.preco as ppreco,
                                            tb_produtos.id as pid,
                                            tb_itens_pedido.quantidade as pqtd
                                            FROM tb_itens_pedido
                                            INNER JOIN tb_produtos ON tb_itens_pedido.id_produto = tb_produtos.id
                                            WHERE tb_itens_pedido.id_pedido = ? AND tb_produtos.id_cooperativa = ?;", 
                [$pedido->id, $id_cooperativa]);

                foreach ($produtos_pedido as $produto) {
                    $preco_total_pedido += ($produto->ppreco * $produto->pqtd);
                }
            
            $pedido->produtos = $produtos_pedido;
            $pedido->preco_total = $preco_total_pedido;
            $pedido->nome_usuario = $nome_usuario[0]->nome;
        }

        return $pedidos;
    }

    public function chatCliente(){
        $chat = new ChatController();
        $id_cooperativa = $_COOKIE['cooperativa'];
        $id_pedido = request("id_pedido");
        
        $id_usuario = DB::select("SELECT tb_pedidos.id_usuario FROM tb_pedidos WHERE tb_pedidos.id = ?", 
        [$id_pedido]);
        $id_chat = $chat->createChat($id_cooperativa, $id_usuario[0]->id_usuario);

        return redirect("/chat?chat=".$id_chat);
    }
}