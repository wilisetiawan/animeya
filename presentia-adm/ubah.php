<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: login.php");
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/icons/favicon-16x16.png">
    <link rel="manifest" href="../assets/icons/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <title>Edit - Presentia</title>
</head>
<body class="font-sarabun" style="background-color: #1F2937;">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    // get id on URL
    $id = $_GET["id"];
    $halaman = $_GET['halaman'];
    // query data perguruan_tinggi by id
    $perguruan = query("SELECT * FROM perguruan_tinggi WHERE id=$id")[0];

    // check the data has been entered or not
    if (isset($_POST["submit"])) {
        // check the data whether it was successfully edited or not
        if (ubah($_POST) > 0) {
            echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Data berhasil diedit!',
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
                        title: 'Data gagal diedit!',
                    }).then(function() {
                        window.location = 'index.php?halaman=" . $halaman . "';
                    });
                </script>
            ";
        }
    }
?>
    <div class="container mx-auto py-8">
        <!-- navbar -->
        <div class="float-right text-white">
            <button class="border-2 border-white rounded-full font-bold text-white px-6 
            py-2 transition duration-50 ease-out hover:bg-white hover:text-black mr-6">
                <a href="logout.php">Logout</a>
            </button>
        </div>
        <div class="float-left text-white">
            <button class="border-2 border-white rounded-full font-bold text-white px-6 
            py-2 transition duration-50 ease-out hover:bg-white hover:text-black ml-6">
                <a href='index.php?halaman=<?= $halaman ?>'>Kembali</a>
            </button>
        </div>
        <!-- end navbar -->

        <!-- title -->
        <div class="container w-full flex flex-wrap flex-col items-center text-center 
        content-center pt-10">
            <h1 class="font-bold text-4xl md:text-5xl max-w-xl leading-tiyght">
                <span class="outliner"> Ubah Data</span>
            </h1>
        </div>
        <!-- end title -->

        <!-- form ubah -->
        <div class="container w-full grid justify-items-center">
            <form name="my-form" action="" method="POST" onsubmit="return validateForm()">
                <div class="mt-8 max-w-md">
                    <div class="grid grid-cols-1 gap-6">
                        <label class="block">
                            <input type="hidden" class="mt-2 block p-2 w-80 rounded-md 
                            border-gray-500 shadow-sm focus:border-gray-500 
                            focus:ring focus:ring-gray-500 focus:ring-opacity-50" placeholder="" 
                            name="id" value="<?= $perguruan["id"]; ?>" />
                        </label>

                        <label for="nama_pt" class="block">
                            <span class="text-white">Nama Perguruan Tinggi</span>
                            <input type="text" class="mt-2 block p-2 w-80 rounded-md border-gray-500 
                            shadow-sm focus:border-gray-500 focus:ring focus:ring-gray-500 
                            focus:ring-opacity-50" placeholder="" name="nama_pt" id="nama_pt" 
                            value="<?= $perguruan["nama_pt"]; ?>" autocomplete="off" required />
                        </label>

                        <label for="penanggungjawab" class="block">
                            <span class="text-white">Nama Unit Penanggungjawab</span>
                            <input type="text" class="mt-2 block p-2 w-80 rounded-md border-gray-500 
                            shadow-sm focus:border-gray-500 focus:ring focus:ring-gray-500 
                            focus:ring-opacity-50" placeholder="" name="penanggungjawab" id="penanggungjawab" 
                            value="<?= $perguruan["penanggungjawab"]; ?>" autocomplete="off" required />
                        </label>

                        <label for="email" class="block">
                            <span class="text-white">Email Unit</span>
                            <input type="email" class="mt-2 block p-2 w-80 rounded-md border-gray-500 
                            shadow-sm focus:border-gray-500 focus:ring focus:ring-gray-500 
                            focus:ring-opacity-50" placeholder="" name="email" id="email" 
                            value="<?= $perguruan["email"]; ?>" autocomplete="off" required />
                        </label>

                        <label for="telp" class="block">
                            <span class="text-white">Telp. Unit</span>
                            <input type="text" class="mt-2 block p-2 w-80 rounded-md border-gray-500 
                            shadow-sm focus:border-gray-500 focus:ring focus:ring-gray-500 
                            focus:ring-opacity-50" placeholder="" name="telp" id="telp" 
                            value="<?= $perguruan["telp"]; ?>" autocomplete="off" required />
                        </label>

                        <label for="" class="grid items-center mt-4">
                            <button type="submit" name="submit" class="border-2 border-white 
                            rounded-full font-bold text-white px-6 py-2 transition duration-50 
                            ease-out hover:bg-white hover:text-black">Ubah
                            </button>
                        </label>
                    </div>
                </div>
            </form>
        </div>
        <!-- end form -->

        <!-- footer -->
        <div class="pt-4">
            <footer class="flex flex-wrap items-center justify-between p-3 m-auto">
                <div class="container mx-auto flex flex-col flex-wrap items-center justify-between">
                    <div class="flex mx-auto text-white text-center font-semibold">
                        Presented by. Sulaimu
                    </div>
                </div>
            </footer>
        </div>
        <!-- end footer -->
    </div>
<script src="../js/index.js"></script>
</body>
</html>