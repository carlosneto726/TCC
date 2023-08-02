<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestsController extends Controller
{
    public function teste(){
        var_dump($this->ceps_proximos());
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
