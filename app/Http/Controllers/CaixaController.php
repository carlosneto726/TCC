<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaixaController extends Controller
{
    public function getCaixa($data){
        $id_cooperativa = $_COOKIE["cooperativa"];
        $total = 0;
        $vendas = DB::select("  SELECT * 
                                FROM tb_vendas
                                WHERE ".$data." tb_vendas.id_pedido IN 
                                (SELECT tb_pedidos.id FROM tb_pedidos WHERE tb_pedidos.id IN 
                                    (SELECT tb_itens_pedido.id_pedido FROM tb_itens_pedido WHERE tb_itens_pedido.id_produto IN 
                                        (SELECT tb_produtos.id FROM tb_produtos WHERE tb_produtos.id_cooperativa = ?)))
                                ORDER BY tb_vendas.data DESC;",
                                        [$id_cooperativa]);
        foreach($vendas as $venda){
            $total += $venda->preco_total;
        }

        return [$vendas, $total];
    }

    public function viewCaixaTotal(){
        $caixa = $this->getCaixa("");
        $vendas = $caixa[0];
        $total = $caixa[1];
        $ordenado = "Caixa Total";
        return view("caixa.caixa", compact('vendas', 'total', 'ordenado'));
    }

    public function viewCaixaAno(){
        $caixa = $this->getCaixa("YEAR(tb_vendas.data) = YEAR(NOW()) AND");
        $vendas = $caixa[0];
        $total = $caixa[1];
        $ordenado = "Caixa do ano";
        return view("caixa.caixa", compact('vendas', 'total', 'ordenado'));
    }

    public function viewCaixaMes(){
        $caixa = $this->getCaixa("MONTH(tb_vendas.data) = MONTH(NOW()) AND");
        $vendas = $caixa[0];
        $total = $caixa[1];
        $ordenado = "Caixa do Mês";
        return view("caixa.caixa", compact('vendas', 'total', 'ordenado'));
    }

    public function viewCaixaDia(){
        $caixa = $this->getCaixa("DAY(tb_vendas.data) = DAY(NOW()) AND");
        $vendas = $caixa[0];
        $total = $caixa[1];
        $ordenado = "Caixa do dia";
        return view("caixa.caixa", compact('vendas', 'total', 'ordenado'));
    }
}
