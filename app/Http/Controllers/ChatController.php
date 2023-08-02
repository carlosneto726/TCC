<?php

namespace App\Http\Controllers;

use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AlertController;

class ChatController extends Controller
{    
    public function viewChats(){
        @$id_cooperativa = $_COOKIE['cooperativa'];
        @$id_usuario = $_COOKIE['usuario'];
        $id = null;
        $query_param = null;
        $orderby = request("orderby");
        $pesquisa = request("pesquisa");
        $orderbyQuery = "";
        $searchQuery = "";

        if($orderby == "ordem_alfabetica"){
            $orderbyQuery = " ORDER BY cnome ASC, unome ASC ";
        }else if($orderby == "data"){
            $orderbyQuery = " ORDER BY tb_chats.id DESC";
        }else if($pesquisa){
            if(isset($_COOKIE['cooperativa'])){
                $nome = "tb_usuarios.nome";
            }else if(isset($_COOKIE['usuario'])){
                $nome = "tb_cooperativas.nome";
            }
            $searchQuery = " AND ".$nome." LIKE '%".$pesquisa."%' ";
        }

        if(isset($id_cooperativa)){
            $id = $id_cooperativa;
            $query_param = "id_cooperativa";

        }else if(isset($id_usuario)){
            $id = $id_usuario;
            $query_param = "id_usuario";
        }

        $query = "  SELECT *, tb_chats.id as chid, 
                    tb_cooperativas.id as cid, tb_cooperativas.nome as cnome , 
                    tb_usuarios.id as uid, tb_usuarios.nome as unome
                    FROM tb_chats INNER JOIN tb_cooperativas ON 
                    tb_chats.id_cooperativa = tb_cooperativas.id 
                    INNER JOIN tb_usuarios ON tb_usuarios.id = tb_chats.id_usuario
                    AND tb_chats.".$query_param." = ?".$searchQuery.$orderbyQuery;

        $chats = DB::select($query, [$id]);
        return view("chat.chats", compact('chats', 'orderby'));
    }


    public function viewChat(){
        $id_chat = request("chat");
        $query = "";
        $id_cookie = "";
        if(isset($_COOKIE['cooperativa'])){
            $id_cookie = $_COOKIE['cooperativa'];
            $query = "AND tb_cooperativas.id = ".$id_cookie;

        }else if(isset($_COOKIE['usuario'])){
            $id_cookie = $_COOKIE['usuario'];
            $query = "AND tb_usuarios.id = ".$id_cookie;

        }else{
            AlertController::alert("Faça o login", "danger");
            return redirect("/entrar");
        }

        $chat = DB::select("SELECT *, 
                            tb_cooperativas.nome as cnome, 
                            tb_usuarios.nome as unome
                            FROM tb_chats 
                            INNER JOIN tb_cooperativas ON tb_chats.id_cooperativa = tb_cooperativas.id 
                            INNER JOIN tb_usuarios ON tb_chats.id_usuario = tb_usuarios.id 
                            WHERE tb_chats.id = ? ".$query, 
        [$id_chat]);
        $mensagens = DB::select("SELECT * FROM tb_mensagens WHERE id_chat = ?", [$id_chat]);

        if(count($chat) == 0){
            AlertController::alert("Acesso negado.", "danger");
            return redirect("/");
        }
        return view("chat.chat", compact('id_chat', 'chat', 'mensagens'));
    }

    public function addMessage(){

        $id_chat = request("id_chat");
        $canal = "chat-_".$id_chat;
        $evento = "mensagem";
        $id_cooperativa = request("id_cooperativa");
        $id_usuario = request("id_usuario");
        $mensagem = request("mensagem");
        $data = date("Y-m-d");

        DB::insert("   INSERT INTO tb_mensagens (id_chat, id_cooperativa, id_usuario, mensagem, data) 
                                VALUES (?, ?, ?, ?, ?)
        ",
        [$id_chat, $id_cooperativa, $id_usuario, $mensagem, $data]);

        event(new Message($mensagem, $canal, $evento));
        

        return redirect("/chat/".$id_chat."#footer");

    }

    public function createChat($id_cooperativa, $id_usuario){
        $chats = DB::select("SELECT id FROM tb_chats WHERE id_cooperativa = ? AND id_usuario = ?",
        [$id_cooperativa, $id_usuario]);

        if(count($chats) == 0){
            DB::insert("INSERT INTO tb_chats (id_cooperativa, id_usuario) VALUES (?, ?)", 
            [$id_cooperativa, $id_usuario]);
            $id_chat = DB::getPdo()->lastInsertId();
            return $id_chat;
        }else{
            return $chats[0]->id;
        }
    }

}
