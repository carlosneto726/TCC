<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestsController extends Controller
{
    public function teste(){

        $produtos_pedido = DB::select(" SELECT tb_produtos.nome as pnome, 
                                        tb_produtos.imagem as pimg, 
                                        tb_produtos.preco as ppreco,
                                        tb_produtos.id as pid,
                                        tb_itens_pedido.quantidade as pqtd
                                        FROM tb_itens_pedido
                                        INNER JOIN tb_produtos ON tb_itens_pedido.id_produto = tb_produtos.id
                                        WHERE tb_itens_pedido.id_pedido = ?;", 
        [48]);

        $dados = [
            'nome' => 'NOME TESTE',
            'chat' => 'https://cooperativasunidas.online/pedidos/chat/',
            'status' => 'STATUS TESTE',
            'produtos_pedido' => [$produtos_pedido],
        ];

        return view("emails.enviarPedido", compact("dados"));
    }
}
