<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

session_start();

class CooperativaController extends Controller
{

    public function viewCadastroUsuario(){
        return view('cooperativa.cadastro');
    }

    public function viewCooperativa(){
        $nome_cooperativa = request("cooperativa");
        $cooperativa = DB::select("SELECT * FROM tb_cooperativas WHERE nome = ?", [$nome_cooperativa]);
        $produtos = DB::select("SELECT * FROM tb_produtos WHERE id_cooperativa = ?", [$cooperativa[0]->id]);
        return view('cooperativa.view.cooperativa', compact('cooperativa', 'produtos'));
    }


    public function addProduto(Request $request): string{
        $id_cooperativa = $_COOKIE["cooperativa"];
        $nome = request("nome");
        $descricao = request("descricao");
        $preco = request("preco");
        $quantidade = request("quantidade");
        $entrega = request("entrega");

        if($request->file('imagem')){
            $path = $request->file('imagem')->storeAs('images/produtos', "produto_img".$nome, 'public');
        }else{
            $path = "images/produtos/default_template.png";
        }

        if($quantidade == 0){
            $status = 0;
        }else{
            $status = 1;
        }
        
        DB::insert("INSERT INTO 
                    tb_produtos (id_cooperativa, nome, descricao, preco, quantidade, imagem, status, entrega) 
                    VALUES (?, ?, ? ,?, ?, ?, ?, ?)", 
                    [$id_cooperativa, $nome, $descricao, $preco, $quantidade, $path, $status, $entrega]);

        AlertController::alert("Produto cadastrado com sucesso.", "success");
        return redirect("/cooperativa/".$_COOKIE["nome_cooperativa"]);
    }

    public function updateProduto(Request $request): string{
        $id = request("id");
        $id_cooperativa = $_COOKIE["cooperativa"];
        $nome = request("nome");
        $descricao = request("descricao");
        $preco = request("preco");
        $quantidade = request("quantidade");
        $acao = request("acao");
        $entrega = request("entrega");

        if($quantidade == 0){
            $status = 0;
        }else{
            $status = 1;
        }

        if($acao == "deletar"){
            DB::delete("DELETE FROM tb_produtos WHERE id = ? AND id_cooperativa = ?", [$id, $id_cooperativa]);
            AlertController::alert("Produto deletado com sucesso.", "warning");
        }else if($acao == "atualizar"){
            if($request->file('imagem')){
                $path = $request->file('imagem')->storeAs('images/produtos', "produto_img".$nome, 'public');
                DB::update("UPDATE tb_produtos SET nome = ?, descricao = ?, preco = ?, quantidade = ?, imagem = ?, status = ?, entrega = ? WHERE id = ? AND id_cooperativa = ?;", 
                [$nome, $descricao, $preco, $quantidade, $path, $status, $entrega, $id, $id_cooperativa]);
            }else{
                DB::update("UPDATE tb_produtos SET nome = ?, descricao = ?, preco = ?, quantidade = ?, status = ?, entrega = ? WHERE id = ? AND id_cooperativa = ?;", 
                [$nome, $descricao, $preco, $quantidade, $status, $entrega, $id, $id_cooperativa]);
            }
            AlertController::alert("Produto atualizado com sucesso.", "success");
        }
        return redirect("/cooperativa/".$_COOKIE["nome_cooperativa"]);
    }


    public function updateCooperativa(Request $request): string{
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
        $cooperativa = DB::select("SELECT * FROM tb_cooperativas WHERE id = ?", [$id]);
        $outdoor = $cooperativa[0]->outdoor;
        $perfil = $cooperativa[0]->perfil;

        if($request->file('outdoor')){
            $outdoor = $request->file('imagem')->storeAs('images/produtos', "produto_img".$nome, 'public');
        }
        if($request->file('perfil')){
            $perfil = $request->file('perfil')->storeAs('images/'.$nome, "perfil", 'public');
        }
        

        DB::update("UPDATE tb_cooperativas SET nome = ?, descricao = ?, historico = ?, missao = ?, visao = ?, valores = ?, endereco = ?, cep = ?, tel1 = ?, tel2 = ?, whatsapp = ?, instagram = ?, facebook = ?, outdoor = ?, perfil = ? WHERE id = ?;", 
        [$nome, $descricao, $historico, $missao, $visao, $valores, $endereco, $cep, $tel1, $tel2, $whatsapp, $instagram, $facebook, $outdoor, $perfil, $id]);

        AlertController::alert("Cooperativa atualizada com sucesso.", "success");
        return redirect("/cooperativa/".$_COOKIE["nome_cooperativa"]);
    }


    public function addCooperativa(Request $request): string{
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

        if($request->file('outdoor') || $request->file('perfil')){
            $outdoor = $request->file('imagem')->storeAs('images/produtos', "produto_img".$nome, 'public');
            $perfil = $request->file('perfil')->storeAs('images/'.$nome, "perfil", 'public');
        }else{
            $outdoor = "images/produtos/default_template.png";
            $perfil = "images/produtos/default_template.png";
        }

        $cooperativas = DB::select("SELECT email, cnpj FROM tb_cooperativas WHERE email = ? OR cnpj = ?;", [$email, $cnpj]);

        if(count($cooperativas) > 0){
            AlertController::alert("E-mail ou CNPJ já cadastrado, tente novamente", "warning");
            return redirect("/cadastrar/cooperativa");
        }else{
            DB::insert('INSERT INTO tb_cooperativas 
            (nome, email, cep, endereco, tipo, cnpj, senha, tel1, tel2, whatsapp, instagram, facebook, descricao, perfil, outdoor)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', 
            [$nome, $email, $cep, $endereco, $tipo, $cnpj, $senha, $tel1, $tel2, $whatsapp, $instagram, $facebook, $descricao , $perfil, $outdoor]);
            AlertController::alert("Cooperativa cadastrada com sucesso.", "success");
            return redirect("/entrar");
        }

    }
}
