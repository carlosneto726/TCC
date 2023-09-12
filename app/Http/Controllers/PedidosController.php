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
        if(isset($_COOKIE["cooperativa"])){
            $pedidos_pendentes = $this->getPedidosCooperativa("= 0");
            $pedidos_concluidos = $this->getPedidosCooperativa("!= 0");
            return view('pedidos.pedidos', compact('pedidos_pendentes', 'pedidos_concluidos'));

        }else if(isset($_COOKIE["usuario"])){
            $id_usuario = $_COOKIE["usuario"];
            $pedidos = $this->getPedidosUsuario($id_usuario);
            return view("usuario.pedidos", compact("pedidos"));
        }
    }

    public function concluirPedido(){
        $id_pedido = request("id_pedido");
        $query = "AND tb_pedidos.id =".$id_pedido;
        $pedido = $this->getPedidosCooperativa("= 0", $query);
        $alerta = "";
        $tipo_alerta = "success";

        foreach ($pedido[0]->produtos as $pedido_produto) {
            $produto = DB::select("SELECT * FROM tb_produtos WHERE tb_produtos.id = ?", [$pedido_produto->pid]);
            $qtd = $produto[0]->quantidade;
            $qtd_pedido_produto = $pedido_produto->pqtd;

            if(($qtd - $qtd_pedido_produto) < 0 && $qtd == true){
                AlertController::alert("Parece que você não possui estoque o suficiente.", "danger");
                return redirect("/pedidos");
            }else{
                if($qtd == false){
                    $new_qtd = NULL;
                }else{
                    $new_qtd = ($qtd - $qtd_pedido_produto);
                }
                DB::update("UPDATE tb_produtos SET quantidade = ? WHERE id = ?", [$new_qtd, $produto[0]->id]);
                DB::update("UPDATE tb_pedidos SET status = ? WHERE id = ?", [1, $id_pedido]);
                if(($qtd - $qtd_pedido_produto) <= 10){
                    $alerta = $alerta."\n".$produto[0]->nome." com estoque baixo!";
                    $tipo_alerta = "warning";
                }
            }
        }
        DB::insert("INSERT INTO tb_vendas (id_pedido, data, preco_total) VALUES (?, NOW(), ?);", [$id_pedido, $pedido[0]->preco_total]);

        AlertController::alert("Pedido concluído.".$alerta, $tipo_alerta);
        $numero = DB::select("SELECT tel1 FROM tb_cooperativas WHERE id = ?", [$_COOKIE['cooperativa']])[0]->tel1;
        $this->enviarEmail($id_pedido, $numero, "finalizarPedido", "Concluído");
        return redirect("/pedidos");
    }

    public function cancelarPedido(){
        $id_pedido = request("id_pedido");
        DB::update("UPDATE tb_pedidos SET status = ? WHERE id = ?", [2, $id_pedido]);

        AlertController::alert("Produto cancelado.", "warning");
        $numero = DB::select("SELECT tel1 FROM tb_cooperativas WHERE id = ?", [$_COOKIE['cooperativa']])[0]->tel1;
        $this->enviarEmail($id_pedido, $numero, "finalizarPedido", "Cancelado");
        return redirect("/pedidos");
        
    }

    public function getPedidosUsuario($id_usuario){
        $preco_total_pedido = 0;

        $pedidos = DB::select(" SELECT * FROM tb_pedidos 
                                WHERE tb_pedidos.id_usuario = ?
                                ORDER BY id DESC;",
            [$id_usuario]);

        foreach ($pedidos as $pedido) {
            $produtos_pedido = DB::select(" SELECT tb_produtos.nome as pnome, 
                                            tb_produtos.imagem as pimg, 
                                            tb_produtos.preco as ppreco,
                                            tb_produtos.id as pid,
                                            tb_cooperativas.id as coopid,
                                            tb_cooperativas.nome as coopnome,
                                            tb_itens_pedido.quantidade as pqtd
                                            FROM tb_itens_pedido
                                            INNER JOIN tb_produtos ON tb_itens_pedido.id_produto = tb_produtos.id
                                            INNER JOIN tb_cooperativas ON tb_cooperativas.id = tb_produtos.id_cooperativa
                                            WHERE tb_itens_pedido.id_pedido = ?;",
                [$pedido->id]);

                foreach ($produtos_pedido as $produto) {
                    $preco_total_pedido += ($produto->ppreco * $produto->pqtd);
                    $pedido->preco_total = $preco_total_pedido;
                }
            $preco_total_pedido = 0;
            $pedido->produtos = $produtos_pedido;
        }
        return $pedidos;
    }

    public function getPedidosCooperativa($status_pedido, $id_pedido = null){
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
                                            tb_produtos.quantidade as pestoque,
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
            $preco_total_pedido = 0;
        }

        return $pedidos;
    }

    public function chatCliente(){
        $chat = new ChatController();
        $id_pedido = request("id_pedido");
        $id_cooperativa = "";
        $id_usuario = "";

        if(isset($_COOKIE['cooperativa'])){
            $id_cooperativa = $_COOKIE['cooperativa'];
            $usuario = DB::select("SELECT tb_pedidos.id_usuario FROM tb_pedidos WHERE tb_pedidos.id = ?", 
            [$id_pedido]);
            $id_usuario = $usuario[0]->id_usuario;
        }else if(isset($_COOKIE['usuario'])){
            $id_usuario = $_COOKIE['usuario'];
            $cooperativa = DB::select(" SELECT * FROM tb_cooperativas WHERE tb_cooperativas.id IN
                                            (SELECT tb_produtos.id_cooperativa FROM tb_produtos WHERE tb_produtos.id IN
                                                (SELECT tb_itens_pedido.id_produto FROM tb_itens_pedido WHERE id_pedido = ?));",
                                                [$id_pedido]);
            $id_cooperativa = $cooperativa[0]->id;
        }else{
            AlertController::alert("Faça login.", "danger");
            return redirect("/entrar");
        }
        $id_chat = $chat->createChat($id_cooperativa, $id_usuario);
        return redirect("/chat/".$id_chat);
    }


    public function enviarEmail($id_pedido, $numero, $tipo, $status){
        $id_cooperativa = $_COOKIE['cooperativa'];

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

        $nome_cooperativa = DB::select("SELECT tb_cooperativas.nome 
                                        FROM tb_cooperativas 
                                        WHERE tb_cooperativas.id = ?", 
        [$id_cooperativa]);
        
        $dados = [
        'nome' => $nome_cooperativa[0]->nome,
        'chat' => 'https://cooperativasunidas.online/pedidos/chat/'.$id_pedido,
        'whatsapp' => 'https://wa.me/55'.$numero,
        'status' => $status,
        'produtos_pedido' => $produtos_pedido,
        ];
        
        Mail::to($email_usuario[0]->email)->send(new PedidoEmail($dados, $tipo));
    }
}





