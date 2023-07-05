<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
session_start();

class UserController extends Controller
{

    public function alert(string $mensagem, string $tipo){
        $_SESSION["mensagem"] = $mensagem;
        $_SESSION["tipo"] = $tipo;
    }

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

        $usuarios = DB::select("select email, cpf from tb_usuarios where email = ? and cpf = ?;", [$email, $cpf]);

        if(count($usuarios) > 0){
            self::alert("E-mail ou CPF já cadastrado, tente novamente", "warning");
            return redirect("/cadastro/usuario");
        }else{
            DB::insert('insert into tb_usuarios (nome, email, endereco, CEP, senha, cpf) values (?, ?, ?, ?, ?, ?);', 
            [$nome, $email, $endereco, $cep, $senha, $cpf]);
            self::alert("Usuário cadastrado com sucesso", "success");
            return redirect("/login");
        }
    }



    
    public function cadastro_cooperativa(){
        return view('login_cadastro.cadastro_cooperativa');
    }

    // Função de que cadastra e valida a cooperativa
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

        $cooperativas = DB::select("select email, cnpj from tb_cooperativas where email = ? and cnpj = ?;", [$email, $cnpj]);

        if(count($cooperativas) > 0){
            self::alert("E-mail ou CNPJ já cadastrado, tente novamente", "warning");
            return redirect("/cadastro/cooperativa");
        }else{
            DB::insert('insert into tb_cooperativas (nome, email, cep, endereco, tipo, cnpj, senha, tel1, tel2, whatsapp, instagram, facebook, descricao, img) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', 
            [$nome, $email, $cep, $endereco, $tipo, $cnpj, $senha, $tel1, $tel2, $whatsapp, $instagram, $facebook, $descricao , $img]);
            self::alert("Cooperativa cadastrada com sucesso.", "success");
            return redirect("/login");
        }

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
