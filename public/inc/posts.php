<?php

include_once 'inc/dbc.php';

class Posts{

    private $conn;

    public function __construct(){
        $dbc = new Dbc();
        $this->conn = $dbc->getConn();
    }

    // creating post
    public function createPost(string $author, string $content){
        if(strlen($content) >= 10){
            $query = $this->conn->prepare("INSERT INTO posts (content, author) VALUES (?, ?)");
            $query->bind_param('ss', $content, $author);
            $query->execute();
            return "Post has been created!";
        } else{
            return "Post must contain more than 10 characters!";
        }
    }

    // get author of post
    public function getAuthor(): array{
        $query = $this->conn->prepare("SELECT author FROM posts");
        $query->execute();
        $row = $query->get_result();
        $item = [];
        while($content = mysqli_fetch_array($row)){
            $item[] = $content['author'];
        }
        return $item;
    }

    // get post
    public function getPosts(){
        $query = $this->conn->prepare("SELECT * FROM posts");
        $query->execute();
        $row = $query->get_result();
        $items = [];
        while($content = mysqli_fetch_array($row)){
            $items[] = $content['content'];
        }
        return $items;
    }


}