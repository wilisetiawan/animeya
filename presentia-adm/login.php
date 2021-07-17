<?php
session_start();

if (isset($_SESSION["login"])) {
    header("location: index.php");
    exit;
}

require 'functions.php';

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/icons/favicon-16x16.png">
    <link rel="manifest" href="../assets/icons/site.webmanifest">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <title>Login - Presentia</title>
</head>

<body class="font-sarabun">
    <div class="min-h-screen flex justify-center bg-gray-50 py-12 px-4 sm:px-6
    lg:px-8 bg-gray-500 bg-no-repeat bg-cover relative items-center" 
    style="background-image: url(../assets/image/bg/nature.jpg);">
        <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
        <div class="max-w-md w-full space-y-8 p-10 bg-white rounded-xl z-10">

            <!-- title form -->
            <div class="text-center">
                <h2 class="mt-6 text-3xl font-bold text-gray-900">
                    Selamat Datang
                </h2>
                <p class="mt-2 text-sm">Silahkan login ke akun anda</p>
            </div>

            <!-- form login -->
            <form name="form-login" class="mt-8 space-y-6" action="" method="POST" onsubmit="return validateLogin()">

                <div class="relative">
                    <label class="text-sm font-bold tracking-wide">
                        Username
                    </label>
                    <input class="w-full content-center text-base py-2 border-b border-black 
                    focus:outline-none focus:border-gray-600" type="text" name="username" 
                    id="username" placeholder="Masukkan username" value="" autocomplete="off" 
                    required autofocus>
                </div>

                <div class="mt-8 content-center">
                    <label class="text-sm font-bold tracking-wide">
                        Password
                    </label>
                    <input class="w-full content-center text-base py-2 border-b border-black 
                    focus:outline-none focus:border-gray-600" type="password" name="password" 
                    id="password" placeholder="Masukkan password" value="" autocomplete="off" 
                    required>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="tampil_password" name="tampil_password" type="checkbox" 
                        class="h-4 w-4 bg-indigo-500 focus:ring-indigo-400 border-gray-300 
                        rounded" onclick="tampilPassword()">
                        <label for="tampil_password" class="ml-2 block text-sm text-gray-900">
                            Tampilkan password
                        </label>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" name="login" id="login" class="w-full flex justify-center 
                    bg-green-500 text-white p-4 rounded-full tracking-wide font-semibold  
                    focus:outline-none focus:shadow-outline hover:bg-green-600 shadow-lg 
                    cursor-pointer transition ease-in duration-300">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- end form -->

    <script src="../js/index.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <?php 
 if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // cek username
    $result = mysqli_query($conn, "SELECT * FROM tbl_admin WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        // cek password sha256
        $row = mysqli_fetch_assoc($result);
        if (hash('sha256', $password) === $row["password"]) {
            // set session
            $_SESSION['login'] = true;
            echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Login berhasil',
                }).then(function() {
                    window.location = 'index.php';
                });
            </script>
            ";
            exit;
        }
    }
    $error = true;
    echo "
    <script>
    Swal.fire({
        icon: 'error',
        title: 'ERROR',
        text: 'Username atau password salah!',
      });
    </script>
    ";
}
?>

</body>
</html>
