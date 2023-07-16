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
        $produtos = DB::select("SELECT * FROM tb_produtos WHERE nome LIKE '%".$pesquisa."%' AND quantidade > 100 AND status = 1 ORDER BY likes DESC");
        return view('pesquisa.pesquisa', compact('pesquisa', 'produtos'));
    }

    public function viewPesquisaCategoria(){
        $categoria = request("categoria");
        if($categoria == "agropecuaria"){ $pesquisa = 1; }
        if($categoria == "consumo"){ $pesquisa = 2; }
        if($categoria == "credito"){ $pesquisa = 3; }
        if($categoria == "educacao"){ $pesquisa = 4; }
        if($categoria == "especial"){ $pesquisa = 5; }
        if($categoria == "moradia"){ $pesquisa = 6; }
        if($categoria == "minerios"){ $pesquisa = 7; }
        if($categoria == "producao"){ $pesquisa = 8; }
        if($categoria == "infraestrutura"){ $pesquisa = 9; }
        if($categoria == "trabalho"){ $pesquisa = 10; }
        if($categoria == "saude"){ $pesquisa = 11; }
        if($categoria == "transporte"){ $pesquisa = 12; }
        if($categoria == "turismo-e-lazer"){ $pesquisa = 13; }

        $produtos = DB::select("SELECT * FROM tb_produtos WHERE tb_produtos.id_cooperativa IN 
                                    (SELECT tb_cooperativas.id FROM tb_cooperativas WHERE tipo = ?)
                                AND quantidade > 100 AND status = 1 ORDER BY likes DESC;", 
        [$pesquisa]);
        $pesquisa = $categoria;
        return view('pesquisa.pesquisa', compact('pesquisa', 'produtos'));
    }
}
