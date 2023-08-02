<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AlertController;
use App\Mail\PedidoEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

session_start();

class ContaController extends Controller
{
    public function entrar(){
        return view('conta.entrar');
    }
    public function cadastrar(){
        return view('conta.cadastrar');
    }

    public function sair(){
        setcookie("usuario", "", time() - 3600);
        setcookie("nome_usuario", "", time() - 3600);
        setcookie("cooperativa", "", time() - 3600);
        setcookie("nome_cooperativa", "", time() - 3600);
        return redirect("/");
    }

    public function validarLogin(){
        $email = request("email");
        $senha = request("senha");
        $tipo_login = request("tipo_login");

        if($tipo_login == "usuario"){
            $usuarios = DB::select("SELECT * FROM tb_usuarios WHERE email = ? AND ativa = 1;", 
            [$email]);

            if(count($usuarios) > 0){
                if(Hash::check($senha, $usuarios[0]->senha)){
                    setcookie("usuario", $usuarios[0]->id, time() + (86400 * 30), "/");
                    setcookie("nome_usuario", $usuarios[0]->nome, time() + (86400 * 30), "/");
                    AlertController::alert("Login efetuado com sucesso!", "success");
                    return redirect("/");

                }else{
                    AlertController::alert("E-mail ou senha incorreto(s)", "warning");
                    return redirect("/entrar");
                }

            }else{
                AlertController::alert("E-mail ou senha incorreto(s)", "warning");
                return redirect("/entrar");
            }

        }else if($tipo_login == "cooperativa"){
            $cooperativas = DB::select("SELECT * FROM tb_cooperativas WHERE email = ? AND ativa = 1", 
            [$email]);

            if(count($cooperativas) > 0){    
                if(Hash::check($senha, $cooperativas[0]->senha)){
                    setcookie("cooperativa", $cooperativas[0]->id, time() + (86400 * 30), "/");
                    setcookie("nome_cooperativa", $cooperativas[0]->nome, time() + (86400 * 30), "/");
                    AlertController::alert("Login efetuado com sucesso!", "success");
                    return redirect("/");
                }else{
                    AlertController::alert("E-mail ou senha incorreto(s)", "warning");
                    return redirect("/entrar");
                }
            }else{
                AlertController::alert("E-mail ou senha incorreto(s)", "warning");
                return redirect("/entrar");
            }
        }
    }

    public function validarEmailUsuario(){
        $token = request("token");
        DB::update("UPDATE tb_usuarios SET ativa = 1, token = '' WHERE token = ?", [$token]);
        AlertController::alert("Conta validada com sucesso", "success");
        return redirect("/entrar");
    }

    public function validarEmailCooperativa(){
        $token = request("token");
        DB::update("UPDATE tb_cooperativas SET ativa = 1, token = '' WHERE token = ?", [$token]);
        AlertController::alert("Conta validada com sucesso", "success");
        return redirect("/entrar");
    }

    public function viewRedefinirSenha(){
        return view("conta.redefinirSenha");
    }

    public function redefinirSenhaEmail(){
        $email = request("email");
        $token = Str::random(60);

        $update_usuario = DB::update("UPDATE tb_usuarios SET token = ? WHERE email = ?", [$token, $email]);
        $update_cooperativa = DB::update("UPDATE tb_cooperativas SET token = ? WHERE email = ?", [$token, $email]);

        if($update_usuario == 0 && $update_cooperativa == 0){
            AlertController::alert("Ocorreu um erro","danger");
            return redirect("/redefinir-senha");
        }

        $this->enviarEmail($email, $token);
        AlertController::alert("Enviamos um e-mail para ".$email, "success");
        return redirect("/redefinir-senha");
    }

    public function viewAtualizarSenha(){
        $token = request("token");
        $usuario = DB::select("SELECT token FROM tb_usuarios WHERE token = ?", [$token]);
        $cooperativa = DB::select("SELECT token FROM tb_cooperativas WHERE token = ?", [$token]);
        if(count($usuario) == 0 && count($cooperativa) == 0){
            AlertController::alert("Ocorreu um erro","danger");
            return redirect("/redefinir-senha");
        }
        return view("conta.atualizarSenha", compact("token"));
    }

    public function redefinirSenha(){
        $token = request("token");
        $senha = Hash::make(request("senha"));
        $usuario = DB::select("SELECT * FROM tb_usuarios WHERE token = ?", [$token]);
        $cooperativa = DB::select("SELECT * FROM tb_cooperativas WHERE token = ?", [$token]);

        if(count($usuario) == 1){
            DB::update("UPDATE tb_usuarios SET senha = ?, token = 0 WHERE token = ?", [$senha, $token]);
            AlertController::alert("Senha atualizada com sucesso.","success");
            return redirect("/entrar");
        }else if(count($cooperativa) == 1){
            DB::update("UPDATE tb_cooperativa SET senha = ?, token = 0 WHERE token = ?", [$senha, $token]);
            AlertController::alert("Senha atualizada com sucesso.","success");
            return redirect("/entrar");
        }else{
            AlertController::alert("Ocorreu um erro","danger");
            return redirect("/redefinir-senha");
        }
    }

    public function enviarEmail($email, $token){
        $dados = [
        'link' => 'https://cooperativasunidas.online/atualizar-senha/'.$token
        ];
        
        Mail::to($email)->send(new PedidoEmail($dados, "redefinirSenha"));
    }
}
