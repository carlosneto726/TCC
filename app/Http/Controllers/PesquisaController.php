<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AlertController;

session_start();

class PesquisaController extends Controller
{
    public function viewPesquisa(){
        $pesquisa = request("pesquisa");
        $orderby = request("orderby");
        $produtos = $this->pesquisa($pesquisa, $orderby);
        return view('pesquisa.pesquisa', compact('produtos', 'orderby'));
    }

    public function viewPesquisaCategoria(){
        $categoria = request("categoria");
        $orderby = request("orderby");
        if($categoria == "agropecuaria"){ $pesquisa = 1; }
        else if($categoria == "consumo"){ $pesquisa = 2; }
        else if($categoria == "credito"){ $pesquisa = 3; }
        else if($categoria == "educacao"){ $pesquisa = 4; }
        else if($categoria == "especial"){ $pesquisa = 5; }
        else if($categoria == "moradia"){ $pesquisa = 6; }
        else if($categoria == "minerios"){ $pesquisa = 7; }
        else if($categoria == "producao"){ $pesquisa = 8; }
        else if($categoria == "infraestrutura"){ $pesquisa = 9; }
        else if($categoria == "trabalho"){ $pesquisa = 10; }
        else if($categoria == "saude"){ $pesquisa = 11; }
        else if($categoria == "transporte"){ $pesquisa = 12; }
        else if($categoria == "turismo-e-lazer"){ $pesquisa = 13; }

        $query = " tb_produtos.id_cooperativa IN (SELECT tb_cooperativas.id FROM tb_cooperativas WHERE tipo = $pesquisa) AND ";
        $produtos = $this->pesquisa(request("pesquisa"), $orderby, $query);

        $pesquisa = $categoria;
        return view('pesquisa.pesquisa', compact('produtos', 'orderby'));
    }

    public function pesquisa($pesquisa, $orderby, $query = ""){

        if($orderby == "preco"){
            $orderby = "preco ASC";
        }else if($orderby == "avaliacao-produto"){
            $orderby = "likes DESC";
        }else if($orderby == "cooperativa"){
            $orderby = "id_cooperativa DESC";
        }else if($orderby == "localizacao"){
            $orderby = "likes DESC";
            isset($_COOKIE['usuario']) ? $cep = substr(DB::select("SELECT cep FROM tb_usuarios WHERE id = ?", [$_COOKIE['usuario']])[0]->cep, 0, 3) : $cep = substr(DB::select("SELECT cep FROM tb_cooperativas WHERE id = ?", [$_COOKIE['cooperativa']])[0]->cep, 0, 3);

            
            
            $query = $query." tb_produtos.id_cooperativa IN 
                            (SELECT tb_cooperativas.id 
                            FROM tb_cooperativas 
                            WHERE cep like'%".$cep."%') AND";
        }else{
            $orderby = "likes DESC";
        }

        $produtos = DB::select("SELECT tb_produtos.nome as pnome,
                                tb_produtos.id as pid,
                                tb_produtos.descricao as pdesc,
                                tb_produtos.imagem as pimg,
                                tb_produtos.likes,
                                tb_produtos.deslikes,
                                tb_produtos.preco,
                                tb_cooperativas.perfil as cimg,
                                tb_cooperativas.nome as cnome,
                                tb_cooperativas.endereco
                                FROM tb_produtos
                                INNER JOIN tb_cooperativas ON tb_cooperativas.id = tb_produtos.id_cooperativa
                                WHERE ".$query."
                                quantidade > 100 
                                AND status = 1 
                                AND tb_produtos.nome LIKE '%".$pesquisa."%' 
                                ORDER BY ".$orderby);
        return $produtos;
    }
}
