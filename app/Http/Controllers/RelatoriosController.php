<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatoriosController extends Controller
{
    public function viewRelatorios(){

        DB::select("SELECT * FROM tb_pedidos");

        $data = [
            'type' => 'bar',
            'data' => [
                'labels' => ['Janeiro', 'Fevereiro', 'Março', 'Abril'],
                'datasets' => [
                    [
                        'label' => 'Vendas',
                        'data' => [120, 200, 150, 80],
                        'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                        'borderColor' => 'rgba(75, 192, 192, 1)',
                        'borderWidth' => 1,
                    ],
                ],
            ],
        ];
    
        $chartUrl = 'https://quickchart.io/chart?' . http_build_query(['c' => json_encode($data)]);

        return view("cooperativa.relatorios", compact('chartUrl'));
    }
}
