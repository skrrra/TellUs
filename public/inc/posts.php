<?php

class Posts{

    private $conn;

    public function __construct(){
        $dbc = new Dbc();
        $this->conn = $dbc->getConn();
    }

    public function createPost(string $author, string $content){
        if($content > 0){
            $query = $this->conn->prepare("INSERT INTO posts (content, author) VALUES (?, ?)");
            $query->bind_param('ss', $content, $author);
            $query->execute();
            return "Post has been created!";
        } else{
            return "You can't create empty post!";
        }
    }
    
    public function getPosts(){
        $query = $this->conn->prepare("SELECT * FROM posts");
        $query->execute();
        $row = $query->get_result();
        while($content = mysqli_fetch_array($row)){
            return $content['content'];
        }
    }

    public function getAuthor(){
        $query = $this->conn->prepare("SELECT * FROM posts");
        $query->execute();
        $row = $query->get_result();
        while($content = mysqli_fetch_array($row)){
            return $content['author'];
        }
    }

}