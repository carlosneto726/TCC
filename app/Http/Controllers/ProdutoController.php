<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AlertController;

session_start();

class ProdutoController extends Controller
{
    public function viewProduto(){
        $id_produto = request("id_produto");
        $produto = DB::select(" SELECT *, tb_cooperativas.nome as cnome, tb_cooperativas.id as cid, 
                                tb_cooperativas.descricao as cdescricao,
                                tb_produtos.nome as pnome, tb_produtos.id as pid, 
                                tb_produtos.descricao as pdescricao
                                FROM tb_produtos INNER JOIN tb_cooperativas
                                ON tb_produtos.id_cooperativa = tb_cooperativas.id
                                WHERE tb_produtos.id = ?
        ", [$id_produto]);

        $comentarios = DB::select(" SELECT *, tb_comentarios_produto.id as comentario_id, tb_usuarios.id as uid
                                    FROM tb_comentarios_produto 
                                    INNER JOIN tb_usuarios ON tb_comentarios_produto.id_usuario = tb_usuarios.id
                                    WHERE id_produto = ?", 
        [$id_produto]);

        return view('produto.produto', compact('produto', 'comentarios', 'id_produto'));
    }

    public function avaliarProduto(){
        $id_produto = request("id_produto");
        $id_usuario = $_COOKIE['usuario'];
        $titulo = request("titulo");
        $comentario = request("comentario");
        $data = date("Y-m-d");
        $avaliacao = request("avaliacao");
        $qtdavaliacoes = DB::select("SELECT likes, deslikes from tb_produtos WHERE id = ?", [$id_produto]);
        $likes = $qtdavaliacoes[0]->likes;
        $deslikes = $qtdavaliacoes[0]->deslikes;

        if($avaliacao == "like"){
            $likes++;
        }else if($avaliacao == "deslike"){
            $deslikes++;
        }

        DB::update("UPDATE tb_produtos SET likes = ?, deslikes = ? WHERE id = ?;",
            [$likes, $deslikes, $id_produto]);

        DB::insert("    INSERT INTO tb_comentarios_produto (titulo, comentario, id_produto, id_usuario, data) 
                        VALUES (?, ?, ?, ?, ?)", [$titulo, $comentario, $id_produto, $id_usuario, $data]);
        return redirect("produto?id_produto=".$id_produto);
    }
}
