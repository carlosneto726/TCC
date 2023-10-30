<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Classes\Messages;

class ForumController extends Controller{
    public $id;
    public $nome;
    public $id_cooperativa;
    public function __construct() {
        if(  isset($_COOKIE['associado']) && isset($_COOKIE['usuario']) && isset($_COOKIE['nome_usuario'])  ){
            $this->id = $_COOKIE['usuario'];
            $this->nome = $_COOKIE['nome_usuario'];
            $this->id_cooperativa = $_COOKIE['cooperativa'];
        }else if( isset($_COOKIE['cooperativa']) && isset($_COOKIE['nome_cooperativa']) ){
            $this->id = $_COOKIE['cooperativa'];
            $this->nome = $_COOKIE['nome_cooperativa'];
            $this->id_cooperativa = $_COOKIE['cooperativa'];

        }
    }




    public function addComment(){
        $comentario = request("comentario");
        $id_forum = request("id_forum");
        $id_cooperativa = NULL;
        $id_associado = NULL;

        if( isset($_COOKIE['cooperativa']) && isset($_COOKIE['nome_cooperativa']) ){
            $id_cooperativa = request("id_cooperativa");
        }
        
        if(isset($_COOKIE['associado']) && isset($_COOKIE['usuario']) && isset($_COOKIE['nome_usuario'])){
            $id_associado = request("id_associado");
        }
        $id_parent = request("id_parent");
        $data = date("Y-m-d");

        DB::insert("INSERT INTO tb_comentarios (comentario, id_forum, id_cooperativa, id_associado, id_parent, data) VALUES (?, ?, ?, ?, ?, ?)",
        [$comentario, $id_forum, $id_cooperativa, $id_associado, $id_parent, $data]);
        return redirect("/forum/".$id_forum);
    }



    public $messages = array();

    public function addMessage($id, $id_autor, $id_forum, $content, $author, $created, $parentId = null) {        
        $message = new Messages($id, $id_autor, $id_forum, $content, $author, $created, $parentId);
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
            'id_autor' => $message->id_autor,
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

    // public function viewForuns(){
    //     $orderby = request("orderby");
    //     $pesquisa = request("pesquisa");

    //     if($orderby == "comentarios"){
    //         $foruns = DB::select("  SELECT *, 
    //                                 tb_forum.id as fid, 
    //                                 tb_forum.descricao as fdescricao, 
    //                                 COUNT(tb_comentarios.id_forum) AS total_mensagens 
    //                                 FROM tb_forum 
    //                                 INNER JOIN tb_cooperativas ON tb_forum.id_cooperativa = tb_cooperativas.id 
    //                                 INNER JOIN tb_comentarios ON tb_forum.id = tb_comentarios.id_forum
    //                                 WHERE id_cooperativa = ? 
    //                                 GROUP BY tb_forum.id, tb_forum.titulo ORDER BY total_mensagens ASC;", [$this->id]);

    //     }else if($orderby == "data"){
    //         $foruns = DB::select("  SELECT *, 
    //                                 tb_forum.id as fid, 
    //                                 tb_forum.descricao as fdescricao 
    //                                 FROM tb_forum 
    //                                 INNER JOIN tb_cooperativas WHERE tb_forum.id_cooperativa = tb_cooperativas.id 
    //                                 WHERE id_cooperativa = ?
    //                                 ORDER BY tb_forum.data;", [$this->id]);

    //     }else if($orderby == "ordem_alfabetica"){
    //         $foruns = DB::select("  SELECT *, 
    //                                 tb_forum.id as fid, 
    //                                 tb_forum.descricao as fdescricao 
    //                                 FROM tb_forum 
    //                                 INNER JOIN tb_cooperativas WHERE tb_forum.id_cooperativa = tb_cooperativas.id 
    //                                 WHERE id_cooperativa = ?
    //                                 ORDER BY tb_forum.titulo ASC;", [$this->id]);

    //     }else if($pesquisa){
    //         $foruns = DB::select("  SELECT *, tb_forum.id as fid, tb_forum.descricao as fdescricao 
    //                                 FROM tb_forum INNER JOIN tb_cooperativas 
    //                                 WHERE tb_forum.id_cooperativa = tb_cooperativas.id 
    //                                 AND id_cooperativa = ?
    //                                 AND titulo LIKE '%".$pesquisa."%';", [$this->id]);
    //     }else{
    //         $foruns = DB::select("  SELECT *, 
    //                                 tb_forum.id as fid, 
    //                                 tb_forum.descricao as fdescricao 
    //                                 FROM tb_forum 
    //                                 INNER JOIN tb_cooperativas ON tb_forum.id_cooperativa = tb_cooperativas.id 
    //                                 WHERE tb_forum.id_cooperativa = ?
    //                                 ORDER BY tb_forum.data DESC;", [$this->id]);
    //     }
    //     return view("forum.foruns", compact('foruns', 'orderby'));
    // }








    public function viewForuns(){
        $orderby = request("orderby");
        $pesquisa = request("pesquisa");

        $foruns = DB::select("  SELECT *, 
                                tb_forum.id as fid, 
                                tb_forum.descricao as fdescricao 
                                FROM tb_forum 
                                INNER JOIN tb_cooperativas ON tb_forum.id_cooperativa = tb_cooperativas.id 
                                WHERE tb_forum.id_cooperativa = ?
                                ORDER BY tb_forum.data DESC;", [$this->id_cooperativa]);

        return view("forum.foruns", compact('foruns', 'orderby'));
    }







    public function viewForum(){
        $id_forum = request("id_forum");
        $forum_info = DB::select("SELECT *, tb_forum.id as fid, tb_forum.descricao as fdescricao FROM tb_forum INNER JOIN tb_cooperativas WHERE tb_forum.id_cooperativa = tb_cooperativas.id AND tb_forum.id = ?", [$id_forum]);

        $nome_cooperativa = $forum_info[0]->nome;
        $comentarios = DB::select("SELECT * FROM tb_comentarios WHERE id_forum = ?", [$id_forum]);
        foreach ($comentarios as $comentario) {
            $id = $comentario->id;
            $content = $comentario->comentario;

            $usuario = DB::select("SELECT nome FROM tb_usuarios WHERE id = ?;", [$comentario->id_associado]);
            $cooperativa = DB::select("SELECT nome FROM tb_cooperativas WHERE id = ?;", [$comentario->id_cooperativa]);
            $author = "";


            if(count($usuario) == 1){
                $author = $usuario[0]->nome;
            }else if(count($cooperativa) == 1){
                $author = $cooperativa[0]->nome;
            }else{
                $author = "???";
            }

            $created = $comentario->data;
            $id_parente = $comentario->id_parent;
            $this->addMessage($id, $author, $id_forum, $content, $author, $created, $id_parente);
        }
        $comments = $this->displayMessages();
        return view("forum.forum", compact('id_forum', 'comments', 'forum_info', 'nome_cooperativa'));
    }


        // Criar um Forum
        public function createTopic(){
            $titulo = request("titulo");
            $descricao = request("descricao");
            $data = date("Y-m-d");
    
            DB::insert("INSERT INTO tb_forum (titulo, descricao, id_cooperativa, data) VALUES (?, ?, ?, ?)", 
            [$titulo, $descricao, $this->id, $data]);
    
            AlertController::alert("Tópico criado com sucesso.", "success");
            return redirect("/foruns");
        }

}
