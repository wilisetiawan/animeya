<?php

include 'config/koneksi.php';

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
    <title>Registrasi</title>
    <style>
        .swal2-popup {
            font-family: 'Segoe UI', sans-serif !important;
        }
    </style>
</head>
<body class="antialiased font-sarabun" style="background-color: #1F2937;">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

	$nama_pt = htmlspecialchars(filter_var($_REQUEST["nama_pt"], FILTER_SANITIZE_STRING));
    $penanggungjawab = htmlspecialchars(filter_var($_REQUEST["penanggungjawab"], FILTER_SANITIZE_STRING));
    $email = strtolower(htmlspecialchars(filter_var($_REQUEST["email"], FILTER_SANITIZE_EMAIL)));
    $telp = htmlspecialchars(filter_var($_REQUEST["telp"], FILTER_SANITIZE_NUMBER_INT));

	$query = "INSERT INTO perguruan_tinggi VALUES (NULL, '$nama_pt', '$penanggungjawab', '$email', '$telp', '', '', 0)";
	$go = mysqli_query($conn, $query);

    if ($go > 0) {
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Pendaftaran Berhasil dikirimkan',
            }).then(function() {
                window.location = 'index.html#registrasi';
            });
        </script>
        ";
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Pendaftaran Gagal dikirimkan',
            }).then(function() {
                window.location = 'index.html#registrasi';
            });
        </script>
        ";
    }
    
?>
</body>
</html>
