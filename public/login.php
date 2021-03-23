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
                <li class="mx-10 my-4 text-white hover:text-gray-300"><a href="index.php">Home</a></li>
                <li class="mx-10 my-4 text-white hover:text-gray-300"><a href="#">About</a></li>
                <li class="mx-10 my-4 text-white hover:text-gray-300"><a href="#">Contact</a></li>
                <li class="mx-10 my-4 text-white border-b border-gray-200 hover:text-gray-300"><a href="login.php">Login</a></li>
            </ul>

        </div>   
    </header>
    <div>
        <div>
            <p class="font-mono text-white font-semibold text-4xl text-center mt-16">Welcome back!</p>
        </div>
        <div class="text-center mt-20 font-lg text-xl">
            <p class="text-gray-500">We are glad to have you back,</p>
            <p class="text-gray-500">Login to your account and start sharing your thoughts!</p>
        </div>
        <div class="my-10 p-10 text-lg font-mono shadow-2xl max-w-md mx-auto ">
            <p class="text-center text-2xl text-gray-700 pt-1 pb-3 border-b-2">LOGIN TO YOUR ACCOUNT</p>
            <p class="text-center pt-4 pb-1"></p>
            <form method="POST">
                <input class="flex mx-auto my-5 pl-3 shadow-md h-10 w-64 rounded-xl focus:outline-none" type="text" name="username" placeholder="Username">
                <input class="flex mx-auto my-5 pl-3 shadow-md h-10 w-64 rounded-xl focus:outline-none" type="password" name="password" placeholder="Password">
                <button class="mt-6 py-2 px-4 border-2 border-gray-400 text-gray-600 flex mx-auto rounded-xl focus:border-none focus:outline-none hover:text-gray-900 hover:border-gray-900"type="submit" name="register">Login</button>
            </form>
            <p class="text-s text-center mt-5">You are not registred?</p>
            <p class="mt-2 font-xs text-center text-black">Register <a class="border-b border-black text-gray-500" href="index.php">here</a>.</p>
        </div>
    </div>
</body>
</html>