<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();

class HomeController extends Controller
{
    public function index(){

        if(isset($_COOKIE["usuario"])){
            $id_usuario = $_COOKIE["usuario"];
            $cep = substr(DB::select("SELECT cep FROM tb_usuarios WHERE id = ?", [$id_usuario])[0]->cep, 0, 3);

            $produtos = DB::select("SELECT *,
                                    tb_produtos.id as pid,
                                    tb_produtos.nome as pnome,
                                    tb_cooperativas.id as cid,
                                    tb_cooperativas.nome as cnome
                                    FROM tb_produtos 
                                    INNER JOIN tb_cooperativas ON tb_produtos.id_cooperativa = tb_cooperativas.id
                                    WHERE quantidade > 100 
                                    AND status = 1 
                                    AND cep LIKE '%".$cep."%' 
                                    ORDER BY likes DESC");

            $produtos_carrossel = [];
            foreach ($produtos as $produto) {
                if($produto->likes > 9){
                    array_push($produtos_carrossel, $produto);
                }
                
            }
            
        }else{
            $produtos = DB::select("    SELECT *,
                                        tb_produtos.id as pid,
                                        tb_produtos.nome as pnome
                                        FROM tb_produtos 
                                        WHERE quantidade > 100 
                                        AND status = 1 
                                        ORDER BY likes DESC");

            $produtos_carrossel  = DB::select(" SELECT *,
                                                tb_produtos.id as pid,
                                                tb_produtos.nome as pnome
                                                FROM tb_produtos 
                                                WHERE quantidade > 100 
                                                AND status = 1 
                                                AND likes > 9 
                                                ORDER BY likes DESC");
        }
        
        return view('home.home', compact('produtos', 'produtos_carrossel'));
    }

    public function viewSobre(){
        return view("home.sobre");
    }
}
