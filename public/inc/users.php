<?php

session_start();
include_once 'inc/dbc.php';

class Users
{
    private $conn;

    public function __construct(){
        $dbc = new Dbc();
        $this->conn = $dbc->getConn();
    }

    public function login(string $username, string $password): string
    {
        // checking if username and password field are filled
        if($username && $password){
            // validating username/password
            if ($this->getUser($username, $password)){
                $_SESSION['logged'] = true;
                $_SESSION['username'] = $username;
                return "Login successful!";
            } else{
                return "Login failed! Try again.";
            }
        } else{
            return $this->fieldCheck($username, $password);
        }
    }

    // checks if login credentials are supplied 
    private function fieldCheck(string $username, string $password)
    {
        if(!$username && !$password){
            return "Please enter username and password!";
        } elseif(!$username){
            return "Please enter username";
        } elseif(!$password){
            return "Please enter the password!";
        }
    }

    // gets username and password from database
    private function getUser($user, $pass): bool
    {
        $query = $this->conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $query->bind_param('ss', $user, $pass);
        $query->execute();
        $queryResult = $query->get_result();
        return $queryResult->num_rows > 0;
    }

    // Register of new user
    public function register(string $username, string $password, string $email): string
    {
        if ($this->userExists($username) == true){
            return "Username already exists!";
        } elseif ($this->emailExists($email) == true){
            return "Email already exists!";
        } else{
            if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username)){
                return "Username can not contain special characters! [A-Z/0-9]";
            } else{
                $role = "user";
                $query = $this->conn->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
                $query->bind_param('ssss', $username, $password, $email, $role);
                $query->execute();
                return "Registration successful!";
                echo '<meta http-equiv="refresh" content="2;URL=\'http://localhost/tellus/public/login.php\'">';
            }
        }
    }

    // check if username exists
    private function userExists(string $username): bool
    {
        $query = $this->conn->prepare("SELECT username FROM users WHERE username= ?");
        $query->bind_param('s', $username);
        $query->execute();
        $result = $query->get_result();
        if($result->num_rows > 0){
            return true;
        } else{
            return false;
        }
    }

    // check if email exists
    private function emailExists(string $email): bool
    {
        $query = $this->conn->prepare("SELECT email FROM users WHERE email= ?");
        $query->bind_param('s', $email);
        $query->execute();
        $result = $query->get_result();
        if($result->num_rows > 0){
            return true;
        } else{
            return false;
        }
    }

    // checks if username and email are empty
    public function fieldsEmpty(string $username, string $email)
    {
        if(!$username){
            return "Username can not be blank!";
        } elseif(!$email){
            return "Email can not be blank!";
        }
    }
}

?>