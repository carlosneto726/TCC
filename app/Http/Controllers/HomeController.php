<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();

class HomeController extends Controller
{
    public function viewHome(){
        if(isset($_COOKIE["usuario"])){
            $id_usuario = $_COOKIE["usuario"];
            $cep = substr(DB::select("SELECT cep FROM tb_usuarios WHERE id = ?", [$id_usuario])[0]->cep, 0, 3);
            $query = ", cep LIKE '%".$cep."%'";
            $home_data = $this->getProdutos($query);
            return view('home.home', compact('home_data'));

        }else{
            $home_data = $this->getProdutos();
            return view('home.home', compact('home_data'));
        }
    }

    public function viewSobre(){
        return view("home.sobre");
    }

    public function viewTermos(){
        return view("home.termos");
    }

    public function getProdutos($query=NULL){
        $categorias = [
            1 => "Agropecuária",
            2 => "Consumo",
            3 => "Crédito",
            4 => "Educação",
            5 => "Especial",
            6 => "Moradia",
            7 => "Minérios",
            8 => "Produção",
            9 => "Infraestrutura",
            10 => "Trabalho",
            11 => "Saúde",
            12 => "Transporte",
            13 => "Turismo e lazer"
        ];
        $home_data = [ "produtos" => [] ];
        $carrossel = [];
        for ($i=1; $i < 14; $i++) { 
            $produtos = DB::select("    SELECT tb_produtos.id as pid,
                                        tb_produtos.imagem,
                                        tb_produtos.likes,
                                        tb_produtos.nome,
                                        tb_produtos.preco
                                        FROM tb_produtos
                                        INNER JOIN tb_cooperativas ON tb_produtos.id_cooperativa = tb_cooperativas.id
                                        WHERE tb_produtos.id_cooperativa 
                                        IN (SELECT tb_cooperativas.id FROM tb_cooperativas WHERE tipo = $i) 
                                        AND quantidade > 100 
                                        AND status = 1 
                                        ORDER BY likes DESC".$query." LIMIT 30;
            ");

            foreach ($produtos as $produto) {
                if($produto->likes > 10){
                    array_push($carrossel, $produto);
                }
            }

            array_push($home_data['produtos'], 
                array(
                    "categoria" => $categorias[$i],
                    "produtos" => $produtos
                )
            );
        }
        $home_data['carrosel'] = $carrossel;
        return $home_data;
    }
}
