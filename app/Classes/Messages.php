<?php

namespace App\Classes;

class Messages {
    public $id;
    public $id_autor;
    public $id_forum;
    public $content;
    public $author;
    public $created;
    public $parentId;
    public $children = array();

    public function __construct($id, $id_autor, $id_forum, $content, $author, $created, $parentId=null) {
        $this->id = $id;
        $this->id_autor = $id_autor;
        $this->id_forum = $id_forum;
        $this->content = $content;
        $this->author = $author;
        $this->created = $created;
        $this->parentId = $parentId;
    }
}