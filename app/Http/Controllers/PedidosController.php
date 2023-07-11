<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
    public function viewPedidos(){

        $id_cooperativa = $_COOKIE['cooperativa'];

        $pedidos = DB::select("    SELECT tb_itens_pedido.id_produto as idproduto
                        FROM tb_itens_pedido
                        INNER JOIN tb_pedidos ON tb_pedidos.id = tb_itens_pedido.id_pedido
                        INNER JOIN tb_usuarios ON tb_usuarios.id = tb_pedidos.id_usuario
                        INNER JOIN tb_produtos ON tb_itens_pedido.id_produto = tb_produtos.id
                        INNER JOIN tb_cooperativas ON tb_produtos.id_cooperativa = tb_cooperativas.id
                        WHERE tb_cooperativas.id = ?;
                        ", [$id_cooperativa]);

        return view('cooperativa.pedidos', compact('pedidos'));
    }
}
