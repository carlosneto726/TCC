<?php

namespace App\Http\Controllers;

use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    
    public function message(){

        $id_forum = request("id_forum");
        $comentario = request("comentario");
        $id_cooperativa = request("id_cooperativa");
        $data = date("Y-m-d");

        DB::insert("INSERT INTO tb_comentarios (comentario, id_forum, id_cooperativa, data) VALUES (?, ?, ?, ?)",
        [$comentario, $id_forum, $id_cooperativa, $data]);

        event(new Message($id_cooperativa, $comentario, $data));

        return redirect("/forum");
    }


}
