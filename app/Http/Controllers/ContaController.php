<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AlertController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Traits\EmailsTrait;

session_start();

class ContaController extends Controller
{
    use EmailsTrait;
    public function entrar(){
        if(isset($_COOKIE['usuario']) || isset($_COOKIE['cooperativa'])){
            AlertController::alert("Você precisa sair da sua conta antes de entrar em outra.", "danger");
            return redirect("/");
        }else{
            return view('conta.entrar');
        }
    }
    public function cadastrar(){
        if(isset($_COOKIE['usuario']) || isset($_COOKIE['cooperativa'])){
            AlertController::alert("Você precisa sair da sua conta antes de cadastrar outra.", "danger");
            return redirect("/");
        }else{
            return view('conta.cadastrar');
        }
    }

    public function sair(){
        setcookie("usuario", "", time() - 3600, "/");
        setcookie("nome_usuario", "", time() - 3600, "/");
        setcookie("cooperativa", "", time() - 3600, "/");
        setcookie("nome_cooperativa", "", time() - 3600, "/");
        setcookie("perfil_img", "", time() - 3600, "/");
        setcookie("associado", "", time() - 3600, "/");
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
                    if($usuarios[0]->id_cooperativa != null){
                        $cooperativa = DB::select("SELECT nome, id FROM tb_cooperativas WHERE id = ?;", [$usuarios[0]->id_cooperativa])[0];
                        setcookie("associado", "true", time() + (86400 * 30), "/");
                        setcookie("cooperativa", $cooperativa->id, time() + (86400 * 30), "/");
                        setcookie("nome_cooperativa", $cooperativa->nome, time() + (86400 * 30), "/");
                    }
                    setcookie("usuario", $usuarios[0]->id, time() + (86400 * 30), "/");
                    setcookie("nome_usuario", explode(" ", $usuarios[0]->nome)[0], time() + (86400 * 30), "/");
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
                    setcookie("perfil_img", $cooperativas[0]->perfil, time() + (86400 * 30), "/");
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

        $dados = [
             'link' => 'https://cooperativasunidas.online/atualizar-senha/'.$token
        ];

        $this->enviarEmail($email, "Redefinir senha", $dados, "redefinirSenha");
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
            DB::update("UPDATE tb_cooperativas SET senha = ?, token = 0 WHERE token = ?", [$senha, $token]);
            AlertController::alert("Senha atualizada com sucesso.","success");
            return redirect("/entrar");
        }else{
            AlertController::alert("Ocorreu um erro","danger");
            return redirect("/redefinir-senha");
        }
    }

    public function viewUsuarioCadastro(){
        if(isset($_COOKIE['usuario']) || isset($_COOKIE['cooperativa']) || isset($_COOKIE['associado'])){
            AlertController::alert("Você precisa sair da sua conta antes de cadastrar outra.", "danger");
            return redirect("/");
        }else{
            return view('usuario.cadastro');
        }
    }

    public function addUsuario(){
        $nome = request("nome");
        $email = request("email");
        $endereco = request("endereco");
        $cep = request("cep");
        $cpf = request("cpf");

        if(!$this->validarCPF($cpf)){
            AlertController::alert("CPF Inválido", "danger");
            return redirect("/cadastrar/usuario");
        }

        $senha = Hash::make(request("senha"));
        $token = Str::random(60);

        $usuarios = DB::select("SELECT email, cpf FROM tb_usuarios WHERE email = ? AND cpf = ?;", [$email, $cpf]);

        if(count($usuarios) > 0){
            AlertController::alert("E-mail ou CPF já cadastrado, tente novamente", "warning");
            return redirect("/cadastro/usuario");
        }else{
            DB::insert('INSERT INTO tb_usuarios (id, nome, email, endereco, CEP, senha, cpf, token, ativa) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0);', 
            [Str::uuid(), $nome, $email, $endereco, $cep, $senha, $cpf, $token]);

            $dados = [
                'link' => 'https://cooperativasunidas.online/validar/usuario/'.$token
            ];

            $this->enviarEmail($email, "Ativar Conta", $dados, "confirmarEmail");
            AlertController::alert("Confirme o endereço de email para ultilizar a conta", "warning");
            return redirect("/entrar");
        }
    }


    public function viewCadastroCooperativa(){
        if(isset($_COOKIE['usuario']) || isset($this->id_cooperativa)){
            AlertController::alert("Você precisa sair da sua conta antes de cadastrar outra.", "danger");
            return redirect("/");
        }else{
            return view('cooperativa.cadastro');
        }
    }
    public function addCooperativa(Request $request): string{
        $nome = request("nome");
        $email = request("email");
        $cep = request("cep");
        $endereco = request("endereco");
        $tipo = request("tipo");
        $cnpj = request("cnpj");
        if(!$this->validarCNPJ($cnpj)){
            AlertController::alert("CNPJ Inválido", "danger");
            return redirect("/cadastrar/cooperativa");
        }
        $senha = Hash::make(request("senha"));
        $tel1 = request("tel1");
        $tel2 = request("tel2");
        $whatsapp = request("whatsapp");
        $instagram = request("instagram");
        $facebook = request("facebook");
        $descricao = request("descricao");
        $outdoor = NULL;
        $token = Str::random(60);
        $types = array("png", "jpg", "jpeg", "webp", "avif", "jfif");

        if($request->file('perfil')){
            if(in_array($request->file('perfil')->extension(), $types)){
                $perfil = $request->file('perfil')->storeAs('images/coopertivas', "perfil".$nome.".".$request->file('perfil')->extension(), 'public');
            }else{
                AlertController::alert("Formato de arquivo inválido", "danger");
                return redirect("/cadastrar/cooperativa");
            }
        }else{
            $perfil = "images/produtos/default_template.jpg";
        }

        $cooperativas = DB::select("SELECT email, cnpj FROM tb_cooperativas WHERE email = ? OR cnpj = ?;", [$email, $cnpj]);

        if(count($cooperativas) > 0){
            AlertController::alert("E-mail ou CNPJ já cadastrado, tente novamente", "warning");
            return redirect("/cadastrar/cooperativa");
        }else{
            DB::insert('INSERT INTO tb_cooperativas 
            (id, nome, email, cep, endereco, tipo, cnpj, senha, tel1, tel2, whatsapp, instagram, facebook, descricao, perfil, outdoor, token, ativa)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0);', 
            [Str::uuid(), $nome, $email, $cep, $endereco, $tipo, $cnpj, $senha, $tel1, $tel2, $whatsapp, $instagram, $facebook, $descricao , $perfil, $outdoor, $token]);

            $dados = [
                'link' => 'https://cooperativasunidas.online/validar/cooperativa/'.$token,
                'nome_cooperativa' => $nome
            ];

            $this->enviarEmail($email, "Ativar conta", $dados, "confirmarEmail");
            AlertController::alert("Confirme o endereço de email para ultilizar a conta", "warning");
            return redirect("/entrar");
        }

    }


    public function validarCPF($cpf){
        if ($cpf == '00000000000' || 
            $cpf == '11111111111' || 
            $cpf == '22222222222' || 
            $cpf == '33333333333' || 
            $cpf == '44444444444' || 
            $cpf == '55555555555' || 
            $cpf == '66666666666' || 
            $cpf == '77777777777' || 
            $cpf == '88888888888' || 
            $cpf == '99999999999') {
            return false;

        }else{
            $desc = 10;
            $soma = 0;
            for($i = 0; $i < 9; $i++){
                $soma += $cpf[$i] * $desc;
                $desc --;
            }

            $resto = (($soma * 10) % 11);
            if($resto == 10){
                $resto = 0;
            }

            if($resto == $cpf[9]){

                $desc = 11;
                $soma = 0;
                for($i = 0; $i < 10; $i++){
                    $soma += $cpf[$i] * $desc;
                    $desc --;
                }
        
                $resto = (($soma * 10) % 11);
                if($resto == 10){
                    $resto = 0;
                }

                if($resto == $cpf[10]){
                    return true;
                }else{
                    return false;
                }

            }else{
                return false;
            }
        }
    }

    function validarCNPJ($cnpj) {
        if ($cnpj == '00000000000000' || 
            $cnpj == '11111111111111' || 
            $cnpj == '22222222222222' || 
            $cnpj == '33333333333333' || 
            $cnpj == '44444444444444' || 
            $cnpj == '55555555555555' || 
            $cnpj == '66666666666666' || 
            $cnpj == '77777777777777' || 
            $cnpj == '88888888888888' || 
            $cnpj == '99999999999999') {
            return false;
    
        } else {   
             
                $j = 5;
                $k = 6;
                $soma1 = 0;
                $soma2 = 0;
        
                for ($i = 0; $i < 13; $i++) {
        
                    $j = $j == 1 ? 9 : $j;
                    $k = $k == 1 ? 9 : $k;
        
                    $soma2 += ($cnpj[$i] * $k);
        
                    if ($i < 12) {
                        $soma1 += ($cnpj[$i] * $j);
                    }
                    $k--;
                    $j--;
                }
        
                $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
                $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;
        
                return (($cnpj[12] == $digito1) and ($cnpj[13] == $digito2));
             
        }
    }
}
