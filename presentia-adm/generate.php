<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions.php';

?>
<html>
<head>
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/icons/favicon-16x16.png">
    <link rel="manifest" href="../assets/icons/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <title>Generate ID</title>
    <style>
        .swal2-popup {
            font-family: 'Segoe UI', sans-serif !important;
        }
    </style>
</head>
<body class="antialiased font-sarabun" style="background-color: #1F2937;">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    $id = $_GET["id"];
    $halaman = $_GET['halaman'];

    if (generateKeyClient($id) && generateKeyDiscord($id) > 0) {
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil membuat ID',
            }).then(function() {
                window.location = 'index.php?halaman=" . $halaman . "';
            });
        </script>
        ";
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal membuat ID',
            }).then(function() {
                window.location = 'index.php?halaman=" . $halaman . "';
            });
        </script>
        ";
    }
?>
</body>
</html>