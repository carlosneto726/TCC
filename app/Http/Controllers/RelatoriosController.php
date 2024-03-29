<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatoriosController extends Controller
{
    public $id_cooperativa;
    public function __construct() {
        $this->id_cooperativa = $_COOKIE['cooperativa'];
    }

    public function viewVendas(){
        
        $id_cooperativa = $this->id_cooperativa;
        $tipo = "Vendas";
    
        $labels = DB::select("  SELECT tb_vendas.data as vdata,
                                COUNT(tb_vendas.data) AS dataduplicada
                                FROM tb_vendas
                                INNER JOIN tb_pedidos ON tb_vendas.id_pedido = tb_pedidos.id
                                WHERE tb_pedidos.id IN 
                                    (SELECT tb_itens_pedido.id_pedido 
                                    FROM tb_itens_pedido WHERE tb_itens_pedido.id_produto IN
                                        (SELECT tb_produtos.id 
                                        FROM tb_produtos 
                                        WHERE tb_produtos.id_cooperativa = ?))
                                GROUP BY tb_vendas.data
                                HAVING COUNT(tb_vendas.data)>0;
                    ", [$id_cooperativa]);

        $data = count($labels);
        json_encode($labels);
        return view("reports.relatorios", compact('labels', 'data', 'tipo'));
    }


    public function viewMaisVendidos(){
        $id_cooperativa = $this->id_cooperativa;
        $labels = [];
        $data = [];
        $tipo = "Produtos Mais Vendidos";

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
            $qtd = 0;
            $qtd_vendida = DB::select(" SELECT tb_itens_pedido.quantidade AS qtd_venda_produto
                                        FROM tb_itens_pedido
                                        WHERE tb_itens_pedido.id_produto = ? AND tb_itens_pedido.id_pedido IN
                                            (SELECT tb_pedidos.id 
                                            FROM tb_pedidos WHERE tb_pedidos.id IN
                                                (SELECT tb_vendas.id_pedido 
                                                FROM tb_vendas))",
                                        [$produto->id]);
            foreach($qtd_vendida as $itens_pedido){
                $qtd += $itens_pedido->qtd_venda_produto;
            }
            array_push($labels, $produto);
            array_push($data, $qtd);
        }

        json_encode($labels);
        json_encode($data);
        return view("reports.relatorios", compact('labels', 'data', 'tipo'));
    }


    public function viewLocaisVendidos(){
        $id_cooperativa = $this->id_cooperativa;
        $labels = [];
        $data = [];
        $tipo = "Locais Mais Vendidos";
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
            $vendas = DB::select("  SELECT tb_vendas.preco_total as venda_pt,
                                        tb_vendas.data as venda_data
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
            $endereco = json_decode(file_get_contents('https://viacep.com.br/ws/'.$cep_venda->cep.'/json/', false, $context));
            array_push($labels, $endereco);
            array_push($data, $vendas);
        }
        json_encode($labels);
        json_encode($data);
        return view("reports.relatorios", compact('labels', 'data', 'tipo'));
    }


    public function viewReceita(){
        $id_cooperativa = $this->id_cooperativa;
        $tipo = "Receita";
        $data = 0;
        $labels = DB::select("  SELECT *, DATE(data) as data, SUM(preco_total) as preco_total 
                                FROM tb_vendas
                                WHERE tb_vendas.id_pedido IN 
                                (SELECT tb_pedidos.id FROM tb_pedidos WHERE tb_pedidos.id IN 
                                    (SELECT tb_itens_pedido.id_pedido FROM tb_itens_pedido WHERE tb_itens_pedido.id_produto IN 
                                        (SELECT tb_produtos.id FROM tb_produtos WHERE tb_produtos.id_cooperativa = ?)))
                                GROUP BY DATE(data) ORDER BY tb_vendas.data DESC;",
                                        [$id_cooperativa]);
        foreach($labels as $venda){
            $data += $venda->preco_total;
        }

        json_encode($labels);
        json_encode($data);
        return view("reports.relatorios", compact('labels', 'data', 'tipo'));
    }
}
