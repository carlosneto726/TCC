<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AlertController;

session_start();

class PesquisaController extends Controller
{
    public function pesquisa(){
        $pesquisa = request("pesquisa");
        $produtos = DB::select("SELECT * FROM tb_produtos WHERE nome LIKE '%".$pesquisa."%'");
        return view('pesquisa.pesquisa', compact('pesquisa', 'produtos'));
    }
}
