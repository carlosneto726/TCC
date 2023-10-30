<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AlertController;
use Illuminate\Support\Str;
use App\Mail\EnviarEmail;
use Illuminate\Support\Facades\Mail;
use App\Traits\PedidosUsuarioTrait;

session_start();

class UsuarioController extends Controller
{
    use PedidosUsuarioTrait;

    public $id_usuario;
    public $nome_usuario;

    public function __construct() {
        $this->id_usuario = $_COOKIE['usuario'];
        $this->nome_usuario = $_COOKIE['nome_usuario'];
    }



    public function viewPerfil(){
        $usuario = DB::select("SELECT * FROM tb_usuarios WHERE id = ?", [$this->id_usuario])[0];
        return view("usuario.perfil", compact("usuario"));
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


    public function validarAssociado(){
        $token = request("token");
        $id_cooperativa = request("id_cooperativa");
        $id_usuario = DB::select("SELECT id FROM tb_usuarios WHERE token = ?", [$token])[0]->id;

        if($id_usuario == $this->id_usuario){
            DB::update("UPDATE tb_usuarios SET id_cooperativa = ?, token = null WHERE id = ?;", [$id_cooperativa, $id_usuario]);
            AlertController::alert("Associação efetuada com sucesso, faça login novamente.", "success");
            return redirect("/sair");
        }else{
            AlertController::alert("Ocorreu algum erro.", "danger");
            return redirect("/");
        }
    }
}
