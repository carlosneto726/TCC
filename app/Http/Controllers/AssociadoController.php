<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AlertController;

class AssociadoController extends Controller
{
    private $id_associado;
    private $id_cooperativa;
    private $nome_cooperativa;
    private $nome_associado;
    public function __construct() {
        $this->id_associado = $_COOKIE['usuario'];
        $this->nome_associado = $_COOKIE['nome_usuario'];
        $this->id_cooperativa = DB::select("SELECT id_cooperativa FROM tb_usuarios WHERE id = ?;", [$this->id_associado])[0]->id_cooperativa;
        $this->nome_cooperativa = DB::select("  SELECT nome FROM tb_cooperativas 
                                                WHERE tb_cooperativas.id IN 
                                                (SELECT id_cooperativa FROM tb_usuarios WHERE tb_usuarios.id = ?);", 
                                                [$this->id_associado])[0]->nome;
    }

    public function viewProdutos(){
        $produtos = DB::select("SELECT * FROM tb_produtos WHERE id_associado = ? ORDER BY id DESC;", [$this->id_associado]);
        return view('cooperativa.produtos.meusprodutos', compact('produtos'));
    }

    public function addProduto(Request $request): string{
        $id_cooperativa = $this->id_cooperativa;
        $nome_cooperativa = $this->nome_cooperativa;
        $id_associado = $this->id_associado;
        $nome = request("nome");
        $descricao = request("descricao");
        $preco = request("preco");
        $quantidade = request("quantidade");
        $entrega = request("entrega");
        $types = array("png", "jpg", "jpeg", "webp", "avif", "jfif");

        $pnomes = DB::select("SELECT nome FROM tb_produtos WHERE tb_produtos.id_associado = ?;", [$id_associado]);
        foreach($pnomes as $pnome){
            if($pnome->nome == $nome){
                AlertController::alert("Você já tem um produto com esse nome.", "danger");
                return redirect("/meusprodutos");
            }
        }

        if($quantidade == 0){ $status = 0; }
        else{ $status = 1; }

        if(!$nome || $preco <= 0 || $quantidade < 0 || $entrega == NULL || !$request->file('imagem') || !in_array($request->file('imagem')->extension(), $types)){
            AlertController::alert("Algum campo inválido.", "danger");
            return redirect("/meusprodutos");
        }else{
            $path = $request->file('imagem')->storeAs('images/produtos', "pimg".$nome.$nome_cooperativa.".".$request->file('imagem')->extension(), 'public');
            DB::insert("INSERT INTO 
            tb_produtos (id_cooperativa, nome, descricao, preco, quantidade, imagem, status, entrega, id_associado) 
            VALUES (?, ?, ? ,?, ?, ?, ?, ?, ?)", 
            [$id_cooperativa, $nome, $descricao, $preco, $quantidade, $path, $status, $entrega, $id_associado]);

            AlertController::alert("Produto cadastrado com sucesso.", "success");
            return redirect("/meusprodutos");
        }
    }

    public function updateProduto(Request $request): string{
        $id = request("id");
        $id_associado = $this->id_associado;
        $nome = request("nome");
        $descricao = request("descricao");
        $preco = request("preco");
        $quantidade = request("quantidade");
        $acao = request("acao");
        $entrega = request("entrega");
        $types = array("png", "jpg", "jpeg", "webp", "avif", "jfif");

        if($quantidade == 0){$status = 0;}
        else{$status = 1;}

        if($acao == "deletar"){
            $img = DB::select("SELECT imagem FROM tb_produtos WHERE id_associado = ? AND id = ?;", [$id_associado, $id])[0]->imagem;
            @unlink("storage/".$img);
            DB::delete("DELETE FROM tb_produtos WHERE id = ? AND id_associado = ?", [$id, $id_associado]);
            AlertController::alert("Produto deletado com sucesso.", "warning");
        }else if($acao == "atualizar"){

            if($request->file('imagem')){
                if(!$nome || $preco <= 0 || $quantidade < 0 || $entrega == NULL || !in_array($request->file('imagem')->extension(), $types)){
                    AlertController::alert("Algum campo inválido.", "danger");
                    return redirect("/meusprodutos");
                }
                $img = DB::select("SELECT imagem FROM tb_produtos WHERE id_associado = ? AND id = ?;", [$id_associado, $id])[0]->imagem;
                @unlink("storage/".$img);
                $path = $request->file('imagem')->storeAs('images/produtos', "pimg".$nome.$this->nome_cooperativa.".".$request->file('imagem')->extension(), 'public');
                DB::update("UPDATE tb_produtos SET nome = ?, descricao = ?, preco = ?, quantidade = ?, imagem = ?, status = ?, entrega = ? WHERE id = ? AND id_associado = ?;", 
                [$nome, $descricao, $preco, $quantidade, $path, $status, $entrega, $id, $id_associado]);
            }else{
                if(!$nome || $preco <= 0 || $quantidade < 0 || $entrega == NULL){
                    AlertController::alert("Algum campo inválido.", "danger");
                    return redirect("/meusprodutos");
                }
                DB::update("UPDATE tb_produtos SET nome = ?, descricao = ?, preco = ?, quantidade = ?, status = ?, entrega = ? WHERE id = ? AND id_associado = ?;", 
                [$nome, $descricao, $preco, $quantidade, $status, $entrega, $id, $id_associado]);
            }
            AlertController::alert("Produto atualizado com sucesso.", "success");
        }
        return redirect("/meusprodutos");
    }
}
