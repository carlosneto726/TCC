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
    public function addUsuario(){
        $nome = request("nome");
        $email = request("email");
        $endereco = request("endereco");
        $cep = request("cep");
        $cpf = request("cpf");
        $senha = Hash::make(request("senha"));

        $usuarios = DB::select("select email, cpf from tb_usuarios where email = ? and cpf = ?;", [$email, $cpf]);

        if(count($usuarios) > 0){
            AlertController::alert("E-mail ou CPF já cadastrado, tente novamente", "warning");
            return redirect("/cadastro/usuario");
        }else{
            DB::insert('insert into tb_usuarios (nome, email, endereco, CEP, senha, cpf) values (?, ?, ?, ?, ?, ?);', 
            [$nome, $email, $endereco, $cep, $senha, $cpf]);
            AlertController::alert("Usuário cadastrado com sucesso", "success");
            return redirect("/entrar");
        }
    }
}
