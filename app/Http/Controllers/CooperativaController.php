<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\AlertController;
use App\Traits\EmailsTrait;
use App\Traits\PedidosCoopTrait;



session_start();

class CooperativaController extends Controller
{
    use EmailsTrait, PedidosCoopTrait;
    public $id_cooperativa;
    public $nome_cooperativa;
    public function __construct() {
        $this->id_cooperativa = @$_COOKIE["cooperativa"];
        $this->nome_cooperativa = @$_COOKIE["nome_cooperativa"];
    }


    public function viewCooperativa(){
        $nome_cooperativa = request("cooperativa");
        $cooperativa = DB::select("SELECT * FROM tb_cooperativas WHERE nome = ?", [$nome_cooperativa]);
        $produtos = DB::select("SELECT * FROM tb_produtos WHERE id_cooperativa = ? ORDER BY id DESC;", [$cooperativa[0]->id]);
        $coop_info = array(
            $cooperativa[0]->historico,
            $cooperativa[0]->missao,
            $cooperativa[0]->visao,
            $cooperativa[0]->valores,
            $cooperativa[0]->endereco,
            $cooperativa[0]->tel1
        );
        $count = 0;
        foreach ($coop_info as $info) {
            if($info){
                $count++;
            }
        }
        $impar = false;
        if($count % 2 == 0){
            $impar = false;
        }else{
            $impar = true;
        }
        return view('cooperativa.view.cooperativa', compact('cooperativa', 'produtos', 'impar'));
    }

    public function updateCooperativa(Request $request): string{
        $id = $this->id_cooperativa;
        $nome = request("nome");
        setcookie("nome_cooperativa", $nome, time() + (86400 * 30), "/");
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
        $types = array("png", "jpg", "jpeg", "webp", "avif", "jfif");

        if($request->file('outdoor')){
            if(in_array($request->file('outdoor')->extension(), $types)){
                $img = DB::select("SELECT outdoor FROM tb_cooperativas WHERE id = ?;", [$id])[0]->outdoor;
                @unlink("storage/".$img);
                $outdoor = $request->file('outdoor')->storeAs('images/coopertivas', "outdoor".$nome.".".$request->file('outdoor')->extension(), 'public');
            }else{
                AlertController::alert("Formato de arquivo inválido", "danger");
                return redirect("/cooperativa/".$nome); 
            }
        }
        if($request->file('perfil')){
            if(in_array($request->file('perfil')->extension(), $types)){
                $img = DB::select("SELECT perfil FROM tb_cooperativas WHERE id = ?;", [$id])[0]->perfil;
                @unlink("storage/".$img);
                $perfil = $request->file('perfil')->storeAs('images/coopertivas', "perfil".$nome.".".$request->file('perfil')->extension(), 'public');
                setcookie("perfil_img", $perfil, time() + (86400 * 30), "/");
            }else{
                AlertController::alert("Formato de arquivo inválido", "danger");
                return redirect("/cooperativa/".$nome); 
            }
        }

        DB::update("UPDATE tb_cooperativas SET nome = ?, descricao = ?, historico = ?, missao = ?, visao = ?, valores = ?, endereco = ?, cep = ?, tel1 = ?, tel2 = ?, whatsapp = ?, instagram = ?, facebook = ?, outdoor = ?, perfil = ? WHERE id = ?;", 
        [$nome, $descricao, $historico, $missao, $visao, $valores, $endereco, $cep, $tel1, $tel2, $whatsapp, $instagram, $facebook, $outdoor, $perfil, $id]);

        AlertController::alert("Cooperativa atualizada com sucesso.", "success");
        return redirect("/cooperativa/".$nome);
    }



    public function viewAssociados(){
        $associados = DB::select("SELECT * FROM tb_usuarios WHERE id_cooperativa = ?;", [$this->id_cooperativa]);
        foreach ($associados as $associado) {
            $produtos = DB::select("SELECT * FROM tb_produtos WHERE tb_produtos.id_associado = ?;", [$associado->id]);
            $associado->produtos = $produtos;
        }
        return view("cooperativa.associados.view", compact("associados"));
    }

    public function addAssociado(){
        $email = request("email");
        $token = Str::random(60);
        $usuario = DB::select("SELECT id FROM tb_usuarios WHERE email = ? AND ativa = 1;", [$email]);
        if(count($usuario) > 0 ){
            DB::update("UPDATE tb_usuarios SET  token = ? WHERE id = ?;", [$token, $usuario[0]->id]);

            $dados = [
                'link' => 'https://cooperativasunidas.online/adicionar/associado/'.$this->id_cooperativa.'/'.$token,
                'nome_cooperativa' => $this->nome_cooperativa
            ];

            $this->enviarEmail($email, "Convite de Associação", $dados, "addAssociado");
            
            AlertController::alert("Email de associção enviado com sucesso.", "success");
            return redirect("/associados");
        }
    }

    public function deleteAssociado(){
        $id_associado = request("id_associado");
        DB::update("UPDATE tb_produtos SET status = 0 WHERE id_associado = ?;", [$id_associado]);
        DB::update("UPDATE tb_usuarios SET id_cooperativa = NULL WHERE id = ?;", [$id_associado]);
        
    }
}
