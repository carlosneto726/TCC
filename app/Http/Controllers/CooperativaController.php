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
        $cooperativa_id = request("cooperativa_id");
        $produtos = DB::select("SELECT * FROM tb_produtos WHERE id_cooperativa = ?", [$cooperativa_id]);
        $cooperativa = DB::select("SELECT * FROM tb_cooperativas WHERE id = ?", [$cooperativa_id]);
        return view('cooperativa.view.cooperativa', compact('cooperativa', 'produtos'));
    }


    public function addProduto(Request $request): string{
        $id_cooperativa = $_COOKIE["cooperativa"];
        $nome = request("nome");
        $descricao = request("descricao");
        $preco = request("preco");
        $quantidade = request("quantidade");
        $path = $request->file('imagem')->storeAs('images/produtos', "produto_img".$nome, 'public');

        if($quantidade == 0){
            $status = 0;
        }else{
            $status = 1;
        }
        
        DB::insert("INSERT INTO 
                    tb_produtos (id_cooperativa, nome, descricao, preco, quantidade, imagem, status) 
                    VALUES (?, ?, ? ,?, ?, ?, ?)", 
                    [$id_cooperativa, $nome, $descricao, $preco, $quantidade, $path, $status]);

        AlertController::alert("Produto cadastrado com sucesso.", "success");
        return redirect("/cooperativa?cooperativa_id=".$_COOKIE["cooperativa"]);
    }


    public function updateProduto(Request $request): string{
        $id = request("id");
        $nome = request("nome");
        $descricao = request("descricao");
        $preco = request("preco");
        $quantidade = request("quantidade");
        $acao = request("acao");

        if($quantidade == 0){
            $status = 0;
        }else{
            $status = 1;
        }

        if($acao == "deletar"){
            DB::delete("DELETE FROM tb_produtos WHERE id = ?", [$id]);
            AlertController::alert("Produto deletado com sucesso.", "warning");
        }else if($acao == "atualizar"){
            $path = $request->file('imagem')->storeAs('images/produtos', "produto_img".$nome, 'public');
            DB::update("UPDATE tb_produtos SET nome = ?, descricao = ?, preco = ?, quantidade = ?, imagem = ?, status = ? where id = ?;", 
            [$nome, $descricao, $preco, $quantidade, $path, $status, $id]);
            AlertController::alert("Produto atualizado com sucesso.", "success");
        }
        return redirect("/cooperativa?cooperativa_id=".$_COOKIE["cooperativa"]);
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
        $outdoor = $request->file('outdoor')->storeAs('images/'.$nome, "outdoor", 'public');
        $perfil = $request->file('perfil')->storeAs('images/'.$nome, "perfil", 'public');

        DB::update("update tb_cooperativas set nome = ?, descricao = ?, historico = ?, missao = ?, visao = ?, valores = ?, endereco = ?, cep = ?, tel1 = ?, tel2 = ?, whatsapp = ?, instagram = ?, facebook = ?, outdoor = ?, perfil = ? where id = ?;", 
        [$nome, $descricao, $historico, $missao, $visao, $valores, $endereco, $cep, $tel1, $tel2, $whatsapp, $instagram, $facebook, $outdoor, $perfil, $id]);

        AlertController::alert("Cooperativa atualizada com sucesso.", "success");
        return redirect("/cooperativa?cooperativa_id=".$_COOKIE["cooperativa"]);
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
        $perfil = $request->file('img')->storeAs('images/'.$nome, "perfil", 'public');

        $cooperativas = DB::select("select email, cnpj from tb_cooperativas where email = ? and cnpj = ?;", [$email, $cnpj]);

        if(count($cooperativas) > 0){
            AlertController::alert("E-mail ou CNPJ já cadastrado, tente novamente", "warning");
            return redirect("/cadastro/cooperativa");
        }else{
            DB::insert('insert into tb_cooperativas (nome, email, cep, endereco, tipo, cnpj, senha, tel1, tel2, whatsapp, instagram, facebook, descricao, perfil) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);', 
            [$nome, $email, $cep, $endereco, $tipo, $cnpj, $senha, $tel1, $tel2, $whatsapp, $instagram, $facebook, $descricao , $perfil]);
            AlertController::alert("Cooperativa cadastrada com sucesso.", "success");
            return redirect("/entrar");
        }

    }
}
