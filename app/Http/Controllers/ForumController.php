<?php

namespace App\Http\Controllers;

use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AlertController;

session_start();
class Messages {
    public $id;
    public $id_cooperativa;
    public $id_forum;
    public $content;
    public $author;
    public $created;
    public $parentId;
    public $children = array();

    public function __construct($id, $id_cooperativa, $id_forum, $content, $author, $created, $parentId = null) {
        $this->id = $id;
        $this->id_cooperativa = $id_cooperativa;
        $this->id_forum = $id_forum;
        $this->content = $content;
        $this->author = $author;
        $this->created = $created;
        $this->parentId = $parentId;
    }
}

class ForumController extends Controller{
    public $messages = array();
    public function addMessage($id, $id_cooperativa, $id_forum, $content, $author, $created, $parentId = null) {        
        $message = new Messages($id, $id_cooperativa, $id_forum, $content, $author, $created, $parentId);
        $this->messages[$id] = $message;
        
        if ($parentId !== null) {
            $this->messages[$parentId]->children[] = $message;
        }
    }
    
    public function displayMessages() {
        $topLevelMessages = $this->getTopLevelMessages();
        $formattedMessages = array();
        
        foreach ($topLevelMessages as $message) {
            $formattedMessages[] = $this->formatMessageAndReplies($message);
        }
        
        return $formattedMessages;
    }
    
    private function formatMessageAndReplies($message) {
        $formattedMessage = array(
            'id' => $message->id,
            'id_cooperativa' => $message->id_cooperativa,
            'id_forum' => $message->id_forum,
            'content' => $message->content,
            'author' => $message->author,
            'created' => $message->created,
            'replies' => array()
        );
        
        foreach ($message->children as $reply) {
            $formattedMessage['replies'][] = $this->formatMessageAndReplies($reply);
        }
        
        return $formattedMessage;
    }
    
    private function getTopLevelMessages() {
        $topLevelMessages = array();
        
        foreach ($this->messages as $message) {
            if ($message->parentId === null) {
                $topLevelMessages[] = $message;
            }
        }
        
        return $topLevelMessages;
    }


    public function viewForum(){
        $id_forum = request("forum");
        $forum_info = DB::select("SELECT *, tb_forum.id as fid, tb_forum.descricao as fdescricao FROM tb_forum INNER JOIN tb_cooperativas WHERE tb_forum.id_cooperativa = tb_cooperativas.id AND tb_forum.id = ?", [$id_forum]);

        $nome_cooperativa = $forum_info[0]->nome;
        $comentarios = DB::select("SELECT * FROM tb_comentarios WHERE id_forum = ?", [$id_forum]);
        foreach ($comentarios as $comentario) {
            $id = $comentario->id;
            $content = $comentario->comentario;
            $author = DB::select("SELECT * FROM tb_cooperativas WHERE id = ?", [$comentario->id_cooperativa])[0]->nome;
            $created = $comentario->data;
            $id_parente = $comentario->id_parent;
            $this->addMessage($id, $comentario->id_cooperativa, $id_forum, $content, $author, $created, $id_parente);
        }
        $comments = $this->displayMessages();
        return view("forum.forum", compact('id_forum', 'comments', 'forum_info', 'nome_cooperativa'));
    }


    public function viewForuns(){
        $orderby = request("orderby");
        $pesquisa = request("pesquisa");
        $id_cooperativa = $_COOKIE['cooperativa'];

        if($orderby == "comentarios"){
            $foruns = DB::select("  SELECT *, 
                                    tb_forum.id as fid, 
                                    tb_forum.descricao as fdescricao, 
                                    COUNT(tb_comentarios.id_forum) AS total_mensagens 
                                    FROM tb_forum 
                                    INNER JOIN tb_cooperativas ON tb_forum.id_cooperativa = tb_cooperativas.id 
                                    INNER JOIN tb_comentarios ON tb_forum.id = tb_comentarios.id_forum 
                                    GROUP BY tb_forum.id, tb_forum.titulo ORDER BY total_mensagens ASC;");

        }else if($orderby == "cooperativas"){
            $foruns = DB::select("  SELECT *, 
                                    tb_forum.id as fid, 
                                    tb_forum.descricao as fdescricao 
                                    FROM tb_forum 
                                    INNER JOIN tb_cooperativas WHERE tb_forum.id_cooperativa = tb_cooperativas.id 
                                    ORDER BY tb_forum.id_cooperativa");

        }else if($orderby == "data"){
            $foruns = DB::select("  SELECT *, 
                                    tb_forum.id as fid, 
                                    tb_forum.descricao as fdescricao 
                                    FROM tb_forum 
                                    INNER JOIN tb_cooperativas WHERE tb_forum.id_cooperativa = tb_cooperativas.id 
                                    ORDER BY tb_forum.data");

        }else if($orderby == "ordem_alfabetica"){
            $foruns = DB::select("  SELECT *, 
                                    tb_forum.id as fid, 
                                    tb_forum.descricao as fdescricao 
                                    FROM tb_forum 
                                    INNER JOIN tb_cooperativas WHERE tb_forum.id_cooperativa = tb_cooperativas.id 
                                    ORDER BY tb_forum.titulo ASC");

        }else if($orderby == "foruns_usuario"){
            $foruns = DB::select("  SELECT *, 
                                    tb_forum.id as fid, 
                                    tb_forum.descricao as fdescricao 
                                    FROM tb_forum 
                                    INNER JOIN tb_cooperativas WHERE tb_forum.id_cooperativa = tb_cooperativas.id 
                                    AND id_cooperativa = ?", [$id_cooperativa]);

        }else if($pesquisa){
            $foruns = DB::select("  SELECT *, tb_forum.id as fid, tb_forum.descricao as fdescricao 
                                    FROM tb_forum INNER JOIN tb_cooperativas 
                                    WHERE tb_forum.id_cooperativa = tb_cooperativas.id 
                                    AND titulo LIKE '%".$pesquisa."%'");
        }else{
            $foruns = DB::select("  SELECT *, 
                                    tb_forum.id as fid, 
                                    tb_forum.descricao as fdescricao 
                                    FROM tb_forum 
                                    INNER JOIN tb_cooperativas WHERE tb_forum.id_cooperativa = tb_cooperativas.id 
                                    ORDER BY tb_forum.data DESC");
        }        
        return view("forum.foruns", compact('foruns', 'orderby'));
    }


    public function createTopic(){
        $titulo = request("titulo");
        $descricao = request("descricao");
        $data = date("Y-m-d");

        DB::insert("INSERT INTO tb_forum (titulo, descricao, id_cooperativa, data) VALUES (?, ?, ?, ?)", 
        [$titulo, $descricao, $_COOKIE["cooperativa"], $data]);

        AlertController::alert("Tópico criado com sucesso.", "success");
        return redirect("/foruns");
    }



    public function addComment(){
        $comentario = request("comentario");
        $id_forum = request("id_forum");
        $id_cooperativa = request("id_cooperativa");
        $id_parent = request("id_parent");
        $data = date("Y-m-d");

        DB::insert("INSERT INTO tb_comentarios (comentario, id_forum, id_cooperativa, id_parent, data) VALUES (?, ?, ?, ?, ?)",
        [$comentario, $id_forum, $id_cooperativa, $id_parent, $data]);
        return redirect("/forum?forum=".$id_forum);
    }


}

