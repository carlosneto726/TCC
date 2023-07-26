<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AlertController;


session_start();

class UsuarioController extends Controller
{

    public function viewUsuarioCadastro(){
        return view('usuario.cadastro');
    }

    public function viewPerfil(){
        $id_usuario = $_COOKIE["usuario"];
        $usuario = DB::select("SELECT * FROM tb_usuarios WHERE id = ?", [$id_usuario])[0];
        return view("usuario.perfil", compact("usuario"));
    }

    public function addUsuario(){
        $nome = request("nome");
        $email = request("email");
        $endereco = request("endereco");
        $cep = request("cep");
        $cpf = request("cpf");
        $senha = Hash::make(request("senha"));

        $usuarios = DB::select("SELECT email, cpf FROM tb_usuarios WHERE email = ? AND cpf = ?;", [$email, $cpf]);

        if(count($usuarios) > 0){
            AlertController::alert("E-mail ou CPF já cadastrado, tente novamente", "warning");
            return redirect("/cadastro/usuario");
        }else{
            DB::insert('INSERT INTO tb_usuarios (nome, email, endereco, CEP, senha, cpf) 
                        VALUES (?, ?, ?, ?, ?, ?);', 
            [$nome, $email, $endereco, $cep, $senha, $cpf]);
            AlertController::alert("Usuário cadastrado com sucesso", "success");
            return redirect("/entrar");
        }
    }


    public function updateUsuario(){
        $id_usuario = $_COOKIE["usuario"];
        $nome = request("nome");
        $email = request("email");
        $endereco = request("endereco");
        $cep = request("cep");
        $cpf = request("cpf");
        $senha = request("senha");
        if($senha == ""){
            $senha = DB::select("SELECT senha FROM tb_usuarios WHERE id = ?", [$id_usuario])[0]->senha;
        }else{
            $senha = Hash::make(request("senha"));
        }

        DB::update("UPDATE tb_usuarios SET nome = ?, email = ?, endereco = ?, CEP = ?, CPF = ?, senha = ? WHERE id = ?", 
                    [$nome, $email, $endereco, $cep, $cpf, $senha, $id_usuario]);
        
        AlertController::alert("Usuário atualizado com sucesso", "success");
        return redirect("/perfil");
        
    }
}
