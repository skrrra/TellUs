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
            header('Location: http://localhost/public/login.php');
        } else{
            return "Post must contain more than 10 characters!";
        }
    }

    // get post author, time of creation, content, id
    public function getPosts()
    {
        $query = $this->conn->prepare("SELECT author, time, content, id FROM posts");
        $query->execute();
        $row = $query->get_result();
        $items = [];
        while($content = mysqli_fetch_array($row)){
            $items[] = $content;
        }
        return $items;
    }

    public function deletePost($id)
    {
        $username = $_SESSION['username'];
        $query = $this->conn->prepare("SELECT author FROM posts WHERE id=?");
        $query->bind_param('s', $id);
        $query->execute();
        $row = $query->get_result();

        while($content = mysqli_fetch_array($row)){
            if($username === $content['author']){
                $query = $this->conn->prepare("DELETE FROM posts WHERE id=?");
                $query->bind_param('s', $id);
                $query->execute();
                return "Post has been deleted!";
            } else{
                return "You are not allowed to delete that post!";
            }
        }
    }

}