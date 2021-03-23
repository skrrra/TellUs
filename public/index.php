<?php
if(isset($_SESSION['logged'])){
    session_start();
}
include_once 'inc/users.php';

$notification = "";

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $email = $_POST['email'];
    if($password == $repassword){
        $register = new Users();
        $notification = $register->register($username, $password, $email);
    } else{
        $notification = "Passwords does not match!";
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/styles.css">
    <link href="https://unpkg.com/tailwindcss@%5E2/dist/tailwind.min.css" rel="stylesheet">
    <title>Tell us</title>
</head>
<body>
    <header class="bg-gray-900">
        <div class="">
            <ul class="justify-center flex">
                <li class="mx-10 my-4 text-white border-b border-gray-200 hover:text-gray-300"><a href="index.php">Home</a></li>
                <li class="mx-10 my-4 text-white hover:text-gray-300"><a href="about.php">About</a></li>
                <li class="mx-10 my-4 text-white hover:text-gray-300"><a href="contact.php">Contact</a></li>
                <li class="mx-10 my-4 text-white hover:text-gray-300"><a href="login.php">Login</a></li>
            </ul>

        </div>   
    </header>
    <div>
        <div>
            <p class="font-mono text-white font-semibold text-4xl text-center mt-16">Welcome to Tell Us!</p>
        </div>
        <div class="text-center mt-20 font-lg text-xl">
            <p class="text-gray-500">Every individual should have right to say what they think.</p>
            <p class="text-gray-500">Join us now!</p>
        </div>
        <div class="my-10 p-10 text-lg font-mono shadow-2xl max-w-md mx-auto ">
            <p class="text-center text-2xl text-gray-700 pt-1 pb-3 border-b-2">REGISTER ACCOUNT</p>
            <p class="text-center pt-4 pb-1">Fill the form below</p>
            <form method="POST">
                <p><?php echo $notification; ?></p>
                <input class="flex mx-auto my-5 pl-3 shadow-md h-10 w-64 rounded-xl focus:outline-none" type="text" name="username" placeholder="Username">
                <input class="flex mx-auto my-5 pl-3 shadow-md h-10 w-64 rounded-xl focus:outline-none" type="password" name="password" placeholder="Password">
                <input class="flex mx-auto my-5 pl-3 shadow-md h-10 w-64 rounded-xl focus:outline-none" type="password" name="repassword" placeholder="Repeat password">
                <input class="flex mx-auto my-5 pl-3 shadow-md h-10 w-64 rounded-xl focus:outline-none" type="text" name="email" placeholder="Email">
                <button class="mt-6 py-2 px-4 border-2 border-gray-400 text-gray-600 flex mx-auto rounded-xl focus:border-none focus:outline-none hover:text-gray-900 hover:border-gray-900" type="submit" name="register">Register</button>
            </form>
        </div>
    </div>
</body>
</html>