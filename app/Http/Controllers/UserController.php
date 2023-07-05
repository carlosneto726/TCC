<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        return view('home');
    }

    public function carrinho(){
        return view('carrinho');
    }

    public function pesquisa(){
        $pesquisa = request("pesquisa");
        return view('pesquisa', compact('pesquisa'));
    }

    public function login(){
        return view('login_cadastro.login');
    }

    public function cadastro(){
        return view('login_cadastro.cadastro');
    }


    public function cadastro_usuario(){
        return view('login_cadastro.cadastro_usuario');
    }

    public function cadastrar_usuario(){
        $nome = request("nome");
        $email = request("email");
        $endereco = request("endereco");
        $cep = request("cep");
        $cpf = request("cpf");
        $senha = request("senha");

        DB::insert('insert into tb_usuario (nome, email, endereco, CEP, senha, cpf) values (?, ?, ?, ?, ?, ?)', [$nome, $email, $endereco, $cep, $senha, $cpf]);
        return redirect("/");
    }



    
    public function cadastro_cooperativa(){
        return view('login_cadastro.cadastro_cooperativa');
    }

    public function cadastrar_cooperativa(){
        $nome = request("nome");
        $email = request("email");
        $cep = request("cep");
        $endereco = request("endereco");
        $tipo = request("tipo");
        $cnpj = request("cnpj");
        $senha = request("senha");
        $tel1 = request("tel1");
        $tel2 = request("tel2");
        $whatsapp = request("whatsapp");
        $instagram = request("instagram");
        $facebook = request("facebook");
        $descricao = request("descricao");
        $img = request("img");

        DB::insert('insert into tb_cooperativa (nome, email, cep, endereco, tipo, cnpj, senha, tel1, tel2, whatsapp, instagram, facebook, descricao, img) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
        [$nome, $email, $cep, $endereco, $tipo, $cnpj, $senha, $tel1, $tel2, $whatsapp, $instagram, $facebook, $descricao , $img]);
        return redirect("/");
    }

    public function pagina_produto(){
        $produto_id = request("produto_id");
        return view('produto', compact('produto_id'));
    }

    public function cooperativa(){
        $cooperativa_id = request("cooperativa_id");
        return view('cooperativa', compact('cooperativa_id'));
    }

}
