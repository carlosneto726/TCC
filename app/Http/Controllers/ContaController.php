<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AlertController;
use App\Mail\PedidoEmail;
use Illuminate\Support\Facades\Mail;


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
            $usuarios = DB::select("SELECT * FROM tb_usuarios WHERE email = ? AND status = 1;", 
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
            $cooperativas = DB::select("SELECT * FROM tb_cooperativas WHERE email = ? AND status = 1", 
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
        DB::update("UPDATE tb_usuarios SET status = 1, token = '' WHERE token = ?", [$token]);
        AlertController::alert("Conta validada com sucesso", "success");
        return redirect("/entrar");
    }

    public function validarEmailCooperativa(){
        $token = request("token");
        DB::update("UPDATE tb_cooperativas SET status = 1, token = '' WHERE token = ?", [$token]);
        AlertController::alert("Conta validada com sucesso", "success");
        return redirect("/entrar");
    }
    
}
