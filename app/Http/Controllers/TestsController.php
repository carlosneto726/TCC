<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestsController extends Controller
{
    public function teste(){
            // Exemplo de uso
            $cep = '73803130';
            $endereco = $this->obterEnderecoViaCEP($cep);
            
            if ($endereco) {
                echo var_dump($endereco)."<br/>";
                echo "CEP: " . $endereco['cep'] . PHP_EOL;
                echo "Logradouro: " . $endereco['logradouro'] . PHP_EOL;
                echo "Bairro: " . $endereco['bairro'] . PHP_EOL;
                echo "Cidade: " . $endereco['localidade'] . PHP_EOL;
                echo "Estado: " . $endereco['uf'] . PHP_EOL;
            } else {
                echo "CEP não encontrado." . PHP_EOL;
            }    

        //$produtos_pedido = DB::select(" SELECT tb_produtos.nome as pnome, 
        //                                tb_produtos.imagem as pimg, 
        //                                tb_produtos.preco as ppreco,
        //                                tb_produtos.id as pid,
        //                                tb_itens_pedido.quantidade as pqtd
        //                                FROM tb_itens_pedido
        //                                INNER JOIN tb_produtos ON tb_itens_pedido.id_produto = tb_produtos.id
        //                                WHERE tb_itens_pedido.id_pedido = ?;", 
        //[48]);
        //$dados = [
        //    'nome' => 'NOME TESTE',
        //    'chat' => 'https://cooperativasunidas.online/pedidos/chat/',
        //    'status' => 'STATUS TESTE',
        //    'produtos_pedido' => [$produtos_pedido],
        //];
        //return view("emails.enviarPedido", compact("dados"));
    }

    function obterEnderecoViaCEP($cep) {
        $url = "https://viacep.com.br/ws/$cep/json/";
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        if ($response) {
            $endereco = json_decode($response, true);
    
            if (isset($endereco['erro']) && $endereco['erro'] === true) {
                return null;
            } else {
                return $endereco;
            }
        } else {
            return null;
        }
    }
    

    
    

    

    
    

    

}
