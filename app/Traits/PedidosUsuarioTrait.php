<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\ChatController;

trait PedidosUsuarioTrait {

    public function viewPedidos(){
        $id_usuario = $_COOKIE["usuario"];
        $pedidos = $this->getPedidosUsuario($id_usuario);
        return view("usuario.pedidos", compact("pedidos"));
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


    public function chatCooperativa(){
        $chat = new ChatController();
        $id_pedido = request("id_pedido");
        $id_usuario = $this->id_usuario;
        $id_cooperativa = DB::select(" SELECT id FROM tb_cooperativas WHERE tb_cooperativas.id IN
                                        (SELECT tb_produtos.id_cooperativa FROM tb_produtos WHERE tb_produtos.id IN
                                            (SELECT tb_itens_pedido.id_produto FROM tb_itens_pedido WHERE id_pedido = ?));",
                                            [$id_pedido])[0]->id;

        $id_chat = $chat->createChat($id_cooperativa, $id_usuario);
        return redirect("/chat/".$id_chat);
    }
}