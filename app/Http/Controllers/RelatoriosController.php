<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatoriosController extends Controller
{
    public function gerarGrafico($labels, $data, $titulo, $tipo){
        $data = [
            'type' => $tipo,
            'data' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => $titulo,
                        'data' => $data,
                        'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                        'borderColor' => 'rgba(75, 192, 192, 1)',
                        'borderWidth' => 1,
                    ],
                ],
            ],
        ];        
        $grafico = 'https://quickchart.io/chart?' . http_build_query(['c' => json_encode($data)]);
        return $grafico;

    }

    public function viewMaisVendidos(){
        $id_cooperativa = $_COOKIE['cooperativa'];
        $labels = [];
        $data = [];

        $produtos = DB::select("SELECT * 
                                FROM tb_produtos
                                WHERE tb_produtos.id_cooperativa = ? AND 
                                tb_produtos.id IN
                                    (SELECT tb_itens_pedido.id_produto
                                    FROM tb_itens_pedido WHERE tb_itens_pedido.id_pedido IN
                                        (SELECT tb_pedidos.id
                                        FROM tb_pedidos WHERE tb_pedidos.id IN 
                                            (SELECT tb_vendas.id_pedido
                                            FROM tb_vendas)));", 
        [$id_cooperativa]);

        foreach ($produtos as $produto) {
            $qtd_vendida = DB::select(" SELECT COUNT(tb_itens_pedido.quantidade) as qtd_produto
                                        FROM tb_itens_pedido
                                        WHERE tb_itens_pedido.id_produto = ? AND tb_itens_pedido.id_pedido IN
                                            (SELECT tb_pedidos.id 
                                            FROM tb_pedidos WHERE tb_pedidos.id IN
                                                (SELECT tb_vendas.id_pedido 
                                                FROM tb_vendas))",
                                        [$produto->id]);
                                        
            array_push($labels, $produto->nome);
            array_push($data, $qtd_vendida[0]->qtd_produto);
        }

        $grafico = $this->gerarGrafico($labels, $data, 'Produtos mais vendidos', 'bar');

        return view("cooperativa.relatorios", compact('grafico'));
    }



    public function viewVendas(){
        $id_cooperativa = $_COOKIE['cooperativa'];
        $labels = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
        $data = [];

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

            array_push($data, count($vendas));
        }
       
        $grafico = $this->gerarGrafico($labels, $data, 'Vendas do ano', 'line');
        return view("cooperativa.relatorios", compact('grafico'));
    }

    public function viewLocaisVendidos(){
        $id_cooperativa = $_COOKIE['cooperativa'];
        $labels = [];
        $data = [];
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "Accept: application/json"
            ]
        ];
        $cep_vendas = DB::select("  SELECT DISTINCT tb_usuarios.cep
                                    FROM tb_usuarios
                                    WHERE tb_usuarios.id IN 
                                        (SELECT tb_pedidos.id_usuario
                                        FROM tb_pedidos WHERE tb_pedidos.id IN
                                            (SELECT tb_itens_pedido.id_pedido
                                            FROM tb_itens_pedido WHERE tb_itens_pedido.id_produto IN
                                                (SELECT tb_produtos.id 
                                                FROM tb_produtos WHERE tb_produtos.id_cooperativa = ?)));",
        [$id_cooperativa]);

        foreach ($cep_vendas as $cep_venda) {
            $vendas = DB::select("  SELECT COUNT(*) as qtd
                                        FROM tb_vendas
                                        WHERE tb_vendas.id_pedido IN
                                            (SELECT tb_pedidos.id 
                                            FROM tb_pedidos WHERE tb_pedidos.id IN
                                                (SELECT tb_itens_pedido.id_pedido
                                                FROM tb_itens_pedido WHERE tb_itens_pedido.id_produto IN
                                                    (SELECT tb_produtos.id
                                                    FROM tb_produtos WHERE tb_produtos.id_cooperativa = ?))
                                            AND tb_pedidos.id_usuario IN 
                                                (SELECT tb_usuarios.id 
                                                FROM tb_usuarios WHERE tb_usuarios.cep = ?));",
            [$id_cooperativa, $cep_venda->cep]);

            $context = stream_context_create($opts);
            $endereco = json_decode(file_get_contents('http://cep.la/'.$cep_venda->cep, false, $context));
            array_push($labels, $endereco->bairro);
            array_push($data, $vendas[0]->qtd);
        }
        $grafico = $this->gerarGrafico($labels, $data, 'Locais mais vendidos', 'bar');
        return view("cooperativa.relatorios", compact('grafico'));
    }



    public function viewReceita(){
        $id_cooperativa = $_COOKIE['cooperativa'];
        $labels = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
        $data = [];

        for ($i=1; $i < 13; $i++) { 
            $preco_total = 0;
            $vendas = DB::select("  SELECT *
                                    FROM tb_vendas 
                                    INNER JOIN tb_pedidos ON tb_vendas.id_pedido = tb_pedidos.id
                                    WHERE tb_pedidos.id IN 
                                        (SELECT tb_itens_pedido.id_pedido 
                                        FROM tb_itens_pedido WHERE tb_itens_pedido.id_produto IN
                                            (SELECT tb_produtos.id 
                                            FROM tb_produtos 
                                            WHERE tb_produtos.id_cooperativa = ?)) 
                                            AND MONTH(tb_vendas.data) = ? 
                                            AND YEAR(tb_vendas.data) = YEAR(NOW());
                        ", [$id_cooperativa, $i]);

            foreach ($vendas as $venda) {
                $preco_total += $venda->preco_total;
            }
            array_push($data, $preco_total);
        }
       
        $grafico = $this->gerarGrafico($labels, $data, 'Receita de vendas do ano', 'line');
        return view("cooperativa.relatorios", compact('grafico'));
    }
}
