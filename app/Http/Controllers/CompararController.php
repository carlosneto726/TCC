<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AlertController;

session_start();

class CompararController extends Controller
{
    public function viewComparar(){
        return view("comparar.comparar");
    }

    public function addComparacao(){
        $id_produto = request("id_produto");
        if(!(@$_SESSION["produto1"])){
            $_SESSION["produto1"] = $id_produto;
            AlertController::alert("Produto adicionado para comparação, adicione mais um para ver a comparação.", "success");
            return redirect(url("/produto/".$id_produto));
        }else{
            $produto1 = DB::select("SELECT *,
            tb_cooperativas.id as cid,
            tb_cooperativas.nome as cnome,
            tb_produtos.id as pid,
            tb_produtos.nome as pnome
            FROM tb_produtos 
            INNER JOIN tb_cooperativas ON tb_cooperativas.id = tb_produtos.id_cooperativa
            WHERE tb_produtos.id = ?", [$_SESSION["produto1"]]);

            $produto2 = DB::select("SELECT *,
            tb_cooperativas.id as cid,
            tb_cooperativas.nome as cnome,
            tb_produtos.id as pid,
            tb_produtos.nome as pnome
            FROM tb_produtos 
            INNER JOIN tb_cooperativas ON tb_cooperativas.id = tb_produtos.id_cooperativa
            WHERE tb_produtos.id = ?", [$id_produto]);
                        
            return view("comparar.comparar", compact("produto1", "produto2"));
        }
    }
}
