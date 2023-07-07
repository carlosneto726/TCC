<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AlertController;
use Events\MyEvent;
use App\Events\forum;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Storage;
use View;

session_start();

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

    public function validar_login(){
        $email = request("email");
        $senha = request("senha");
        error_log(Hash::make($senha));
        $tipo_login = request("tipo_login");

        if($tipo_login == "usuario"){
            $usuarios = DB::select("select * from tb_usuarios where email = ?;", 
            [$email]);

            if(count($usuarios) > 0){
                if(Hash::check($senha, $usuarios[0]->senha)){
                    setcookie("usuario", $usuarios[0]->id, time() + (86400 * 30), "/");
                    AlertController::alert("Login efetuado com sucesso!", "success");
                    return redirect("/");

                }else{
                    AlertController::alert("E-mail ou senha incorreto(s)", "warning");
                    return redirect("/login");
                }
            }

        }else if($tipo_login == "cooperativa"){
            $cooperativas = DB::select("select * from tb_cooperativas where email = ?", 
            [$email]);

            if(count($cooperativas) > 0){    
                if(Hash::check($senha, $cooperativas[0]->senha)){
                    setcookie("cooperativa", $cooperativas[0]->id, time() + (86400 * 30), "/");
                    AlertController::alert("Login efetuado com sucesso!", "success");
                    return redirect("/");
                }else{
                    AlertController::alert("E-mail ou senha incorreto(s)", "warning");
                    return redirect("/login");
                }
            }
        }
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
        $senha = Hash::make(request("senha"));

        $usuarios = DB::select("select email, cpf from tb_usuarios where email = ? and cpf = ?;", [$email, $cpf]);

        if(count($usuarios) > 0){
            AlertController::alert("E-mail ou CPF já cadastrado, tente novamente", "warning");
            return redirect("/cadastro/usuario");
        }else{
            DB::insert('insert into tb_usuarios (nome, email, endereco, CEP, senha, cpf) values (?, ?, ?, ?, ?, ?);', 
            [$nome, $email, $endereco, $cep, $senha, $cpf]);
            AlertController::alert("Usuário cadastrado com sucesso", "success");
            return redirect("/login");
        }
    }

    
    public function cadastro_cooperativa(){
        return view('login_cadastro.cadastro_cooperativa');
    }

    // Função de que cadastra e valida a cooperativa
    public function cadastrar_cooperativa(Request $request): string{
        $nome = request("nome");
        $email = request("email");
        $cep = request("cep");
        $endereco = request("endereco");
        $tipo = request("tipo");
        $cnpj = request("cnpj");
        $senha = Hash::make(request("senha"));
        $tel1 = request("tel1");
        $tel2 = request("tel2");
        $whatsapp = request("whatsapp");
        $instagram = request("instagram");
        $facebook = request("facebook");
        $descricao = request("descricao");
        $perfil = $request->file('img')->storeAs('images/'.$nome, "perfil", 'public');

        $cooperativas = DB::select("select email, cnpj from tb_cooperativas where email = ? and cnpj = ?;", [$email, $cnpj]);

        if(count($cooperativas) > 0){
            AlertController::alert("E-mail ou CNPJ já cadastrado, tente novamente", "warning");
            return redirect("/cadastro/cooperativa");
        }else{
            DB::insert('insert into tb_cooperativas (nome, email, cep, endereco, tipo, cnpj, senha, tel1, tel2, whatsapp, instagram, facebook, descricao, perfil) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', 
            [$nome, $email, $cep, $endereco, $tipo, $cnpj, $senha, $tel1, $tel2, $whatsapp, $instagram, $facebook, $descricao , $perfil]);
            AlertController::alert("Cooperativa cadastrada com sucesso.", "success");
            return redirect("/login");
        }

    }

    public function pagina_produto(){
        $produto_id = request("produto_id");
        return view('produto', compact('produto_id'));
    }

    public function cooperativa(){
        $cooperativa_id = request("cooperativa_id");
        $produtos = DB::select("select * from tb_produtos where id_cooperativa = ?", [$cooperativa_id]);
        $cooperativa = DB::select("select * from tb_cooperativas where id = ?", [$cooperativa_id]);
        return view('cooperativa', compact('cooperativa', 'produtos'));
    }


    public function sair(){
        setcookie("usuario", "", time() - 3600);
        setcookie("cooperativa", "", time() - 3600);
        return redirect("/");
    }

    public function cadastrar_produto(Request $request): string{
        $id_cooperativa = $_COOKIE["cooperativa"];
        $nome = request("nome");
        $descricao = request("descricao");
        $preco = request("preco");
        $quantidade = request("quantidade");
        $path = $request->file('imagem')->storeAs('images/produtos', "produto_img".$nome, 'public');


        DB::insert("insert into tb_produtos (id_cooperativa, nome, descricao, preco, quantidade, imagem) values (?, ?, ? ,?, ?, ?)", 
        [$id_cooperativa, $nome, $descricao, $preco, $quantidade, $path]);

        AlertController::alert("Produto cadastrado com sucesso.", "success");
        return redirect("/cooperativa?cooperativa_id=".$_COOKIE["cooperativa"]);

    }


    public function atualizar_produto(Request $request): string{
        $id = request("id");
        $nome = request("nome");
        $descricao = request("descricao");
        $preco = request("preco");
        $quantidade = request("quantidade");
        $acao = request("acao");

        if($acao == "deletar"){
            DB::delete("delete from tb_produtos where id = ?", [$id]);
            AlertController::alert("Produto deletado com sucesso.", "warning");
        }else if($acao == "atualizar"){
            $path = $request->file('imagem')->storeAs('images/produtos', "produto_img".$nome, 'public');
            DB::update("update tb_produtos set nome = ?, descricao = ?, preco = ?, quantidade = ?, imagem= ? where id = ?;", 
            [$nome, $descricao, $preco, $quantidade, $path ,$id]);
            AlertController::alert("Produto atualizado com sucesso.", "success");
        }
        return redirect("/cooperativa?cooperativa_id=".$_COOKIE["cooperativa"]);

    }


    public function atualizar_cooperativa(Request $request): string{
        $id = $_COOKIE["cooperativa"];
        $nome = request("nome");
        $descricao = request("descricao");
        $historico = request("historico");
        $missao = request("missao");
        $visao = request("visao");
        $valores = request("valores");
        $endereco = request("endereco");
        $cep = request("cep");
        $tel1 = request("tel1");
        $tel2 = request("tel2");
        $whatsapp = request("whatsapp");
        $instagram = request("instagram");
        $facebook = request("facebook");
        $outdoor = $request->file('outdoor')->storeAs('images/'.$nome, "outdoor", 'public');
        $perfil = $request->file('perfil')->storeAs('images/'.$nome, "perfil", 'public');

        DB::update("update tb_cooperativas set nome = ?, descricao = ?, historico = ?, missao = ?, visao = ?, valores = ?, endereco = ?, cep = ?, tel1 = ?, tel2 = ?, whatsapp = ?, instagram = ?, facebook = ?, outdoor = ?, perfil = ? where id = ?;", 
        [$nome, $descricao, $historico, $missao, $visao, $valores, $endereco, $cep, $tel1, $tel2, $whatsapp, $instagram, $facebook, $outdoor, $perfil, $id]);

        AlertController::alert("Cooperativa atualizada com sucesso.", "success");
        return redirect("/cooperativa?cooperativa_id=".$_COOKIE["cooperativa"]);
    }



}
