<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AlertController;

session_start();

class ProdutoController extends Controller
{
    public function viewProduto(){
        $id_produto = request("produto");
        $favorito = 0;

        if(isset($_COOKIE['usuario'])){
            $id_usuario = $_COOKIE['usuario'];
            $favoritos = DB::select("SELECT * FROM tb_favoritos WHERE id_usuario = ? AND id_produto = ?", 
            [$id_usuario, $id_produto]);
            if(count($favoritos) != 0){
                $favorito = $favoritos[0]->id;
            }
        }

        $produto = DB::select(" SELECT *, 
                                tb_cooperativas.nome as cnome, 
                                tb_cooperativas.id as cid, 
                                tb_cooperativas.descricao as cdescricao,
                                tb_produtos.nome as pnome, 
                                tb_produtos.id as pid, 
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

        return view('produto.produto', compact('produto', 'comentarios', 'id_produto', 'favorito'));
    }

    public function avaliarProduto(){
        $id_produto = request("id_produto");
        if(isset($_COOKIE["cooperativa"])){
            AlertController::alert("Por favor, entre como usuário comum para avaliar o produto", "warning");
            return redirect("/produto/".$id_produto);
        }
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
            
        DB::insert("    INSERT INTO tb_comentarios_produto (titulo, comentario, id_produto, id_usuario, data, avaliacao) 
                        VALUES (?, ?, ?, ?, ?, ?)", [$titulo, $comentario, $id_produto, $id_usuario, $data, $avaliacao]);
        return redirect("produto/".$id_produto);
    }

    public function viewFavoritos(){
        $orderby = request("orderby");
        $query = "";
        if($orderby == "preco"){ $orderby = "preco ASC"; }
        else if($orderby == "avaliacao-produto"){ $orderby = "likes DESC";}
        else if($orderby == "cooperativa"){ $orderby = "id_cooperativa DESC";}
        else if($orderby == "localizacao"){ $orderby = "likes DESC";
            $cep = substr(DB::select("SELECT cep FROM tb_usuarios WHERE id = ?", [$_COOKIE['usuario']])[0]->cep, 0, 3);
            $query = $query." tb_produtos.id_cooperativa IN 
                            (SELECT tb_cooperativas.id 
                            FROM tb_cooperativas 
                            WHERE cep like'%".$cep."%') AND"; }
        else{ $orderby = "likes DESC"; }

        $id_usuario = $_COOKIE['usuario'];
        $produtos = DB::select("SELECT *,
                                tb_favoritos.id AS fid,
                                tb_produtos.id  AS pid
                                FROM tb_produtos 
                                INNER JOIN tb_favoritos ON tb_favoritos.id_produto = tb_produtos.id
                                WHERE ".$query." id_usuario = ? ORDER BY ".$orderby, 
        [$id_usuario]);
        return view("produto.favoritos", compact("produtos", "orderby"));
    }

    public function favorito(){
        $id_usuario = $_COOKIE["usuario"];
        $id_produto = request("produto");
        $id_favorito = request("favorito");

        if ($id_favorito) {
            DB::delete("DELETE FROM tb_favoritos WHERE id = ?", [$id_favorito]);
            AlertController::alert("Produto removido dos favoritos", "warning");
        }else{
            DB::insert("INSERT INTO tb_favoritos (id_usuario, id_produto) VALUES (?, ?)", [$id_usuario, $id_produto]);
            AlertController::alert("Produto adicionado aos favoritos", "success");
        }
        return redirect("/produto/".$id_produto);
    }
}
