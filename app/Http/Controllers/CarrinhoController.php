<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AlertController;
use App\Mail\PedidoEmail;
use Illuminate\Support\Facades\Mail;

session_start();

class CarrinhoController extends Controller
{
    public function viewCarrinho(){
        $id_usuario = $_COOKIE['usuario'];
        $produtos = DB::select("    SELECT *, 
                                    tb_carrinhos.quantidade as qtd, 
                                    tb_carrinhos.id as carrinhoid, 
                                    tb_produtos.id as pid ,
                                    tb_produtos.quantidade as pqtd 
                                    FROM tb_carrinhos 
                                    INNER JOIN tb_produtos ON tb_carrinhos.id_produto = tb_produtos.id
                                    WHERE id_usuario = ?"
        , [$id_usuario]);
        $total = 0;
        $quantidade_produtos = 0;

        foreach($produtos as $produto){
            $total += ($produto->preco * $produto->qtd);
            $quantidade_produtos += $produto->qtd;
        }
        
        return view('carrinho.carrinho', compact('produtos', 'total', 'quantidade_produtos'));
    }

    public function addProduto(){
        $id_produto = request("id_produto");
        $id_usuario = $_COOKIE['usuario'];
        $flag = true;

        $produtos = DB::select("SELECT * FROM tb_carrinhos WHERE id_usuario = ?", [$id_usuario]);
        
        foreach ($produtos as $produto) {
            if($produto->id_produto == $id_produto){
                DB::update("UPDATE tb_carrinhos SET quantidade = ? WHERE id_produto = ?", 
                [($produto->quantidade + 1), $produto->id_produto]);
                $flag = false;
            }
        }

        if($flag){
            DB::insert("INSERT INTO tb_carrinhos (id_produto, id_usuario, quantidade) VALUES (?, ?, ?)", [$id_produto, $id_usuario, 1]);
        }

        return redirect("/carrinho");
    }


    public function updateQuantidade(){
        $id_produto = request("id_produto");
        $id_usuario = $_COOKIE['usuario'];
        $quantidade = request("quantidade");
            
        DB::update("UPDATE tb_carrinhos SET quantidade = ? WHERE id_produto = ? AND id_usuario = ?", 
        [$quantidade, $id_produto, $id_usuario]);
        return redirect("/carrinho");

    }

    public function delProduto(){
        $id_produto = request("id_produto");
        $id_usuario = $_COOKIE['usuario'];

        DB::delete("DELETE FROM tb_carrinhos WHERE id_produto = ? AND id_usuario = ?", [$id_produto, $id_usuario]);
        AlertController::alert("Produto deletado do carrinho com sucesso.", "warning");
        return redirect("/carrinho");
        
    }

    public function endCarrinho(){
        $id_usuario = $_COOKIE['usuario'];

        $id_cooperativas = DB::select(" SELECT tb_cooperativas.id
                                        FROM tb_cooperativas
                                        WHERE tb_cooperativas.id IN 
                                            (SELECT tb_produtos.id_cooperativa 
                                            FROM tb_produtos WHERE tb_produtos.id IN
                                                (SELECT tb_carrinhos.id_produto 
                                                FROM tb_carrinhos WHERE tb_carrinhos.id_usuario = ?)
                                                );
        ", [$id_usuario]);

        foreach ($id_cooperativas as $id_cooperativa) {
            $produtos = DB::select("    SELECT *, 
                                        tb_carrinhos.quantidade as qtd, 
                                        tb_carrinhos.id as carrinhoid, 
                                        tb_produtos.id as pid 
                                        FROM tb_carrinhos 
                                        INNER JOIN tb_produtos ON tb_carrinhos.id_produto = tb_produtos.id
                                        WHERE id_usuario = ? AND id_cooperativa = ?;", 
            [$id_usuario, $id_cooperativa->id]);

            DB::insert("INSERT INTO tb_pedidos (id_usuario, status, data) VALUES (?, ?, NOW())", 
            [$id_usuario, 0]);

            $id_pedido = DB::getPdo()->lastInsertId();

            foreach ($produtos as $produto) {
                DB::insert("INSERT INTO tb_itens_pedido (id_produto, id_pedido, quantidade) VALUES (?, ?, ?)", 
                [$produto->pid, $id_pedido, $produto->qtd]);
            }
            $this->enviarEmail($id_pedido);
        }

        DB::delete("DELETE FROM tb_carrinhos WHERE id_usuario = ?", [$id_usuario]);
        return redirect("/");
    }


    public function enviarEmail($id_pedido){
        $cooperativa = DB::select(" SELECT * 
                                    FROM tb_cooperativas
                                    WHERE tb_cooperativas.id IN
                                    (SELECT tb_produtos.id_cooperativa
                                    FROM tb_produtos WHERE tb_produtos.id IN
                                        (SELECT tb_itens_pedido.id_produto
                                        FROM tb_itens_pedido WHERE tb_itens_pedido.id_pedido = ?))",
        [$id_pedido]);

        $nome_cooperativa = $cooperativa[0]->nome;
        $email_cooperativa = $cooperativa[0]->email;

        $produtos_pedido = DB::select(" SELECT tb_produtos.nome as pnome, 
                                        tb_produtos.imagem as pimg, 
                                        tb_produtos.preco as ppreco,
                                        tb_produtos.id as pid,
                                        tb_itens_pedido.quantidade as pqtd
                                        FROM tb_itens_pedido
                                        INNER JOIN tb_produtos ON tb_itens_pedido.id_produto = tb_produtos.id
                                        WHERE tb_itens_pedido.id_pedido = ?", 
        [$id_pedido]);

        $dados = [
            'nome' => $nome_cooperativa,
            'chat' => 'http://cooperativasunidas.online/pedidos/chat/'.$id_pedido,
            'produtos_pedido' => [$produtos_pedido],
        ];

        Mail::to($email_cooperativa)->send(new PedidoEmail($dados, 'enviarPedido'));
    }
}
