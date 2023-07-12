<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatoriosController extends Controller
{
    public function viewRelatorios(){
        $id_cooperativa = $_COOKIE['cooperativa'];

        $data = [
            'type' => 'bar',
            'data' => [
                'labels' => ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                'datasets' => [
                    [
                        'label' => 'Vendas',
                        'data' => [],
                        'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                        'borderColor' => 'rgba(75, 192, 192, 1)',
                        'borderWidth' => 1,
                    ],
                ],
            ],
        ];

        for ($i=1; $i < 13; $i++) { 
            
        $vendas = DB::select("  SELECT *,
                                tb_vendas.id as vid,
                                tb_vendas.data as vdata,
                                tb_pedidos.id as pid,
                                tb_pedidos.data as pdata
                                FROM tb_vendas 
                                INNER JOIN tb_pedidos ON tb_vendas.id_pedido = tb_pedidos.id
                                WHERE tb_pedidos.id IN 
                                    (SELECT tb_itens_pedido.id_pedido 
                                    FROM tb_itens_pedido WHERE tb_itens_pedido.id_produto IN
                                        (SELECT tb_produtos.id 
                                        FROM tb_produtos 
                                        WHERE tb_produtos.id_cooperativa = ?)) AND MONTH(tb_vendas.data) = ?;
                        ", [$id_cooperativa, $i]);

            array_push($data['data']['datasets'][0]['data'], count($vendas));
        }
       
        $chartUrl = 'https://quickchart.io/chart?' . http_build_query(['c' => json_encode($data)]);
        return view("cooperativa.relatorios", compact('chartUrl'));
    }
}
