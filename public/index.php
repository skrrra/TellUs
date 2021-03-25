<?php
if(isset($_SESSION['logged'])){
    session_start();
}

include_once 'inc/users.php';
include_once 'inc/posts.php';

$notification = "";
$error = "";

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $email = $_POST['email'];
    $register = new Users();
    if($username && $email){
        if(strlen($username) >= 4){
            if($password == $repassword){
                $notification = $register->register($username, $password, $email);
            } else{
                $notification = "Passwords does not match!";
            }
        } else{
            $notification = "Username must be longer than 4 characters!";
        }
    } else{
        $notification = $register->fieldsEmpty($username, $email);
    }
}

if(isset($_POST['createPost'])){
    $author = $_SESSION['username'];
    $content = $_POST['postContent'];
    $postCreate = new Posts();
    $error = $postCreate->createPost($author, $content);
}

if(isset($_POST['logout'])){
    session_destroy();
    header('location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://unpkg.com/tailwindcss@%5E2/dist/tailwind.min.css" rel="stylesheet">
    <title>Tell us</title>
</head>
<body>
    <?php if(!isset($_SESSION['logged'])){ ?>
    <header class="bg-gray-900">
        <div class="">
            <ul class="justify-center flex">
                <li class="mx-10 my-4 text-white border-b border-gray-200 hover:text-gray-300"><a href="index.php">Home</a></li>
                <li class="mx-10 my-4 text-white hover:text-gray-300"><a href="about.php">About</a></li>
                <li class="mx-10 my-4 text-white hover:text-gray-300"><a href="contact.php">Contact</a></li>
                <?php if(!isset($_SESSION['logged'])){ ?>
                <li class="mx-10 my-4 text-white hover:text-gray-300"><a href="login.php">Login</a></li>
                <?php } ?>
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
                <p class="text-center text-red-600"><?php echo $notification; ?></p>
                <input class="flex mx-auto my-5 pl-3 shadow-md h-10 w-64 rounded-xl focus:outline-none" type="text" name="username" placeholder="Username">
                <input class="flex mx-auto my-5 pl-3 shadow-md h-10 w-64 rounded-xl focus:outline-none" type="password" name="password" placeholder="Password">
                <input class="flex mx-auto my-5 pl-3 shadow-md h-10 w-64 rounded-xl focus:outline-none" type="password" name="repassword" placeholder="Repeat password">
                <input class="flex mx-auto my-5 pl-3 shadow-md h-10 w-64 rounded-xl focus:outline-none" type="email" name="email" placeholder="Email">
                <button class="mt-6 py-2 px-4 border-2 border-gray-400 text-gray-600 flex mx-auto rounded-xl focus:border-none focus:outline-none hover:text-gray-900 hover:border-gray-900" type="submit" name="register">Register</button>
            </form>
        </div>
    </div>

    <?php } else{ ?>
    <header class="bg-gray-900">
        <div class="">
            <ul class="justify-center flex">
                <li class="mx-10 my-4 text-white border-b border-gray-200 hover:text-gray-300"><a href="index.php">Home</a></li>
                <li class="mx-10 my-4 text-white hover:text-gray-300"><a href="about.php">About</a></li>
                <li class="mx-10 my-4 text-white hover:text-gray-300"><a href="contact.php">Contact</a></li>
                <form method="POST">
                    <button class="mx-10 my-4 text-white hover:text-gray-300 focus:outline-none" name="logout">Logout</button>
                </form>    
            </ul>
        </div>   
    </header>
        <div class="flex flex-col mx-auto max-w-2xl my-12 bg-indigo-50 p-4 shadow-xl">
            <p class="text-red-900"><?php echo $error; ?></p>
            <form method="POST">
                <p class="pb-3 text-gray-600">Post as: <span class="font-semibold text-gray-800"><?php echo $_SESSION['username']; ?></span></p>
                <textarea style="resize:none" class="shadow-lg text-lg border-1 border-red-800 py-2 px-4 text-gray-600 font-mono focus:outline-none" name="postContent" cols="59" rows="5" placeholder="What are you thinking?"></textarea>
                <button class="float-right block w-32 py-1 mt-4 text-gray-700 border-2 border-blue-100 bg-blue-300 rounded-lg ml-auto hover:bg-blue-400 hover:text-gray-200 focus:outline-none" name="createPost">Create post</button>
            </form>
        </div>
        <div class="flex flex-col mx-auto max-w-2xl my-12 bg-indigo-100 p-4 shadow-xl">
            <p class="text-center text-gray-600 text-xl">Keep up with others!</p>
            <div class="bg-white">
                <?php $auth = new Posts(); foreach($auth->getAuthor() as $test) {?>
                    <p><?php echo $test; ?></p>
                <?php } ?>
                <?php $post = new Posts(); foreach($auth->getPosts() as $test) {?>
                    <p><?php echo $test; ?></p>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</body>
</html>