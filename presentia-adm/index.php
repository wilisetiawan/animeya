<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions.php';

$cari = '';
if (isset($_POST['tombolCari'])) {
    $cari = $_POST['cari'];
    $_SESSION['cari'] = $cari;
} else {
    error_reporting(0);
    $cari = '';
}

$ambilData = mysqli_query($conn, "SELECT * FROM perguruan_tinggi WHERE 
nama_pt LIKE '%$cari%' OR
penanggungjawab LIKE '%$cari%' OR
email LIKE '%$cari%' OR
telp LIKE '%$cari%' OR 
uniqid_client LIKE '%$cari%'
OR uniqid_discord LIKE '%$cari%'");

$jumlahTerdaftar = count(query("SELECT * FROM perguruan_tinggi WHERE status=1"));

// Konfig Pagination
$jumlahData = 5;
$totalData = mysqli_num_rows($ambilData);
$jumlahPagination = ceil($totalData / $jumlahData);
$jumlahDataPT = count(query("SELECT * FROM perguruan_tinggi"));

if (isset($_GET['halaman'])) {
    $halamanAktif = $_GET['halaman'];
} else {
    $halamanAktif = 1;
}

$dataAwal = ($halamanAktif * $jumlahData) - $jumlahData;

$jumlahLink = 2;
if ($halamanAktif > $jumlahLink) {
    $start_number = $halamanAktif - $jumlahLink;
} else {
    $start_number = 1;
}

if ($halamanAktif < $jumlahPagination - $jumlahLink) {
    $end_number = $halamanAktif + $jumlahLink;
} else {
    $end_number = $jumlahPagination;
}

$ambilData_Perhalaman = mysqli_query($conn, "SELECT * FROM perguruan_tinggi WHERE 
nama_pt LIKE '%$cari%' OR
penanggungjawab LIKE '%$cari%' OR
email LIKE '%$cari%' OR
telp LIKE '%$cari%' OR 
uniqid_client LIKE '%$cari%'
OR uniqid_discord LIKE '%$cari%' 
ORDER BY id DESC LIMIT $dataAwal, $jumlahData");

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
    <title>Admin Presentia</title>
</head>
<body class="antialiased font-sarabun" style="background-color: #1F2937;">
    <div class="container mx-auto py-8">
        <div class="float-right text-white">
            <button class="border-2 border-white rounded-full font-bold text-white px-6 py-2 
            transition duration-50 ease-out hover:bg-white hover:text-black mr-6">
                <a href="logout.php">Logout</a>
            </button>
        </div>
        <div class="float-left text-white">
            <button class="border-2 border-white rounded-full font-bold text-white px-6 
            py-2 transition duration-50 ease-out hover:bg-white hover:text-black ml-6">
                <a href="index.php">Home</a>
            </button>
        </div>
        <div>
            <div class="container w-full flex flex-wrap flex-col items-center text-center content-center pt-10">
                <h1 class="font-bold text-4xl md:text-5xl max-w-xl leading-tiyght">
                    <span class="outliner">Data Presentia</span>
                </h1>
                <p class="text-2xl leading-relaxed mt-6 font-semibold text-white">
                    Jumlah Pendaftar = <span style="color: #F8E81C"><?php echo "$jumlahDataPT"; ?></span>
                </p>
                <p class="text-2xl leading-relaxed mt-2 font-semibold text-white">
                    Jumlah Terdaftar = <span style="color: #F8E81C"><?php echo "$jumlahTerdaftar"; ?></span>
                </p>
            </div>
        </div>
        <!-- pencarian -->
        <div class="container w-full flex justify-center mt-6">
            <div class="w-auto sm:w-80 inline-block relative ">
                <form action="" method="POST">
                    <input class="border-2 border-gray-500 bg-white h-10 px-5 pr-24 rounded-lg text-sm 
                    focus:outline-none" type="text" name="cari" size="30" autofocus 
                    placeholder="Masukkan keyword pencarian" autocomplete="off">
                    <button type="submit" name="tombolCari" class="absolute right-0 top-0 mt-3 mr-6 sm:mr-4">
                        <svg class="text-black h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" 
                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" 
                        viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" 
                        xml:space="preserve" width="512px" height="512px">
                            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,
                            10.318-23,23 s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,
                            0.92,2.162,0.92 c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z
                            M23.984, 6c9.374,0,17,7.626,17,17s-7.626,17-17,17
                            s-17-7.626-17-17S14.61,6,23.984,6z" />
                        </svg>
                    </button>
                    <div class="container w-full flex flex-wrap flex-col items-center text-center content-center pt-4">
                        <p class="text-2xl leading-relaxed font-semibold text-white">
                            Pencarian Ditemukan = <span style="color: #F8E81C"><?php echo "$totalData"; ?></span>
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-2 container mx-auto px-6 pt-10">
            <div class="flex justify-start text-white">
                <button class="border-2 border-white rounded font-bold text-white px-6 py-2 transition 
                duration-50 ease-out hover:bg-white hover:text-black mr-6"><a href="tambah.php">Tambah</a>
                </button>
            </div>
            <div class="flex justify-end">
                <div class="flex justify-center items-center text-white font-semibold text-xl lg:text-2xl">
                    <!-- NAVIGASI -->
                    <?php if ($halamanAktif > 1) : ?>
                        <a href="?halaman=<?= $halamanAktif - 1; ?>" class="m-2 bg-SteelBlue px-3
                    rounded-xl pb-1 hover:bg-white hover:text-black">&laquo;</a>
                    <?php endif; ?>

                    <?php for ($i = $start_number; $i <= $end_number; $i++) : ?>
                        <?php if ($i == $halamanAktif) : ?>
                            <button class="m-1 bg-red px-3 py-1 rounded-xl hover:bg-white hover:text-black">
                                <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                            </button>
                        <?php else : ?>
                            <a href="?halaman=<?= $i; ?>" class="m-1"><?= $i; ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($halamanAktif < $jumlahPagination) : ?>
                        <a href="?halaman=<?= $halamanAktif + 1; ?>" class="m-2 bg-SteelBlue px-3
                    rounded-xl pb-1 hover:bg-white hover:text-black">&raquo;</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-6 pt-6">
            <table class="shadow-2xl table-auto border-collapse border-2 p-10 border-white w-full" 
            style="box-shadow: 5px 5px 8px rgba(255,255,255,0.25)">
                <thead>
                    <tr>
                        <th class="p-2 font-bold text-white border border-white hidden lg:table-cell">
                            No.
                        </th>
                        <th class="p-2 font-bold text-white border border-white hidden lg:table-cell">
                            Nama Perguruan Tinggi
                        </th>
                        <th class="p-2 font-bold text-white border border-white hidden lg:table-cell">
                            Penanggungjawab
                        </th>
                        <th class="p-2 font-bold text-white border border-white hidden lg:table-cell">
                            Email
                        </th>
                        <th class="p-2 font-bold text-white border border-white hidden lg:table-cell">
                            Telp
                        </th>
                        <th class="p-2 font-bold text-white border border-white hidden lg:table-cell">
                            UID Client
                        </th>
                        <th class="p-2 font-bold text-white border border-white hidden lg:table-cell">
                            UID Discord
                        </th>
                        <th class="p-2 font-bold text-white border border-white hidden lg:table-cell">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 0 + $dataAwal;
                    while ($row = mysqli_fetch_assoc($ambilData_Perhalaman)) {
                        $nomor++;
                    ?>

                        <tr class="flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0
                            <?php
                            if ($row['status']) {
                                echo 'bg-Teal hover:bg-TealHover text-white';
                            } else {
                                echo 'bg-gray-500 lg:hover:bg-gray-600';
                            }
                            ?>">

                            <td class="w-full lg:w-auto p-3 border border-b block lg:table-cell relative lg:static 
                                text-right lg:text-center pt-6 border-black">
                                <span class="text-white lg:hidden absolute top-0 left-0 bg-black px-2 py-1
                                text-xs font-bold uppercase">No.</span>
                                <?= $nomor ?>
                            </td>

                            <td class="w-full lg:w-auto p-3 text-right border border-b block lg:table-cell relative
                            lg:static lg:text-left pt-6 border-black">
                                <span class="text-white lg:hidden absolute top-0 left-0 bg-black px-2 py-1
                                text-xs font-bold uppercase">Perguruan Tinggi</span>
                                <?= $row["nama_pt"]; ?>
                            </td>

                            <td class="w-full lg:w-auto p-3 text-right border border-b block lg:table-cell relative 
                            lg:static lg:text-left pt-6 border-black">
                                <span class="text-white lg:hidden absolute top-0 left-0 bg-black px-2 py-1 
                                text-xs font-bold uppercase">Penanggungjawab</span>
                                <?= $row["penanggungjawab"]; ?>
                            </td>

                            <td class="w-full lg:w-auto p-3 text-right border border-b block lg:table-cell relative 
                            lg:static lg:text-left pt-6 border-black">
                                <span class="text-white lg:hidden absolute top-0 left-0 bg-black px-2 py-1 text-xs 
                                font-bold uppercase">Email</span>
                                <?= $row["email"]; ?>
                            </td>

                            <td class="w-full lg:w-auto p-3 text-right border border-b block lg:table-cell relative 
                            lg:static lg:text-left pt-6 border-black">
                                <span class="text-white lg:hidden absolute top-0 left-0 bg-black px-2 py-1 text-xs 
                                font-bold uppercase">Telp</span>
                                <?= $row["telp"]; ?>
                            </td>

                            <td class="w-full lg:w-auto p-3 text-right border border-b block lg:table-cell relative 
                            lg:static lg:text-center pt-6 border-black">
                                <span class="text-white lg:hidden absolute top-0 left-0 bg-black px-2 py-1 text-xs 
                                font-bold uppercase">UID Client</span>
                                <?= $row["uniqid_client"]; ?>
                            </td>

                            <td class="w-full lg:w-auto p-3 text-right border border-b block lg:table-cell relative 
                            lg:static lg:text-center pt-6 border-black">
                                <span class="text-white lg:hidden absolute top-0 left-0 bg-black px-2 py-1 text-xs 
                                font-bold uppercase">UID Discord</span>
                                <?= $row["uniqid_discord"]; ?>
                            </td>

                            <td class="w-full lg:w-auto p-3 text-right border border-b block lg:table-cell relative 
                            lg:static lg:text-center pt-6 border-black">
                                <span class="text-white lg:hidden absolute top-0 left-0 bg-black px-2 py-1 text-xs 
                                font-bold uppercase">Action</span>
                                <button class="rounded-lg font-bold bg-SteelBlue text-white px-2 m-1 py-px 
                                hover:bg-white hover:text-black mr-0 text-sm">
                                    <a href="ubah.php?halaman=<?= $halamanAktif ?>&id=<?= $row["id"]; ?>">Ubah</a>
                                </button>

                                <span class="text-white lg:hidden absolute top-0 left-0 bg-black px-2 py-1 text-xs 
                                font-bold uppercase">Action</span>
                                <button class="rounded-lg font-bold bg-IndianRed text-white px-2 py-px 
                                hover:bg-white hover:text-black mr-0 text-sm">
                                    <a onclick="hapusData('<?= $halamanAktif ?>', '<?= $row['id'] ?>')">Hapus</a>
                                </button>

                                <span class="text-white lg:hidden absolute top-0 left-0 bg-black px-2 py-1 text-xs 
                                font-bold uppercase">Action</span>
                                <button type="submit" name="submit" class="rounded-lg font-bold bg-Mantis text-white 
                                px-2 py-px hover:bg-white hover:text-black mr-0 text-sm">
                                    <a href="send-email.php?halaman=<?= $halamanAktif ?>&id=<?= $row["id"]; ?>"> 
                                        Email
                                    </a>
                                </button>
                                <br>

                                <span class="text-white lg:hidden absolute top-0 left-0 bg-black px-2 py-1 text-xs 
                                font-bold uppercase">Action</span>
                                <button class="rounded-lg font-bold bg-IndianYellow text-white px-2 py-px 
                                hover:bg-white hover:text-black mr-0 text-sm">
                                    <a onclick="generateIdBaru('<?= $halamanAktif ?>', '<?= $row['id'] ?>')">Generate</a>
                                </button>

                                <span class="text-white lg:hidden absolute top-0 left-0 bg-black px-2 py-1 text-xs 
                                font-bold uppercase">Action</span>
                                <button id="<?= $row['uniqid_client']; ?>" class="hidden">
                                    <a href="ubahStatus.php?id=<?= $row['id']; ?>"></a>
                                </button>
                                <button type="submit" name="submit" class="rounded-lg font-bold bg-gray-700  
                                text-white px-2 py-px hover:bg-white hover:text-black mr-0 text-sm">
                                    <a onclick="daftarkan('<?= $row['nama_pt'] ?>', '<?= $row['uniqid_client'] ?>',
                                    '<?= $row['uniqid_discord'] ?>', <?= $row['status'] ?>, '<?= $row['id'] ?>' );">
                                        Register
                                    </a>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="grid container mx-auto px-6 pt-10">
            <div class="flex justify-end text-white">
                <button class="border-2 border-white rounded font-bold text-white px-6 py-2 transition 
                duration-50 ease-out hover:bg-white hover:text-black">
                    <a href="laporan-excel.php">Export to Excel</a>
                </button>
            </div>
        </div>

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

        <script src="../js/index.js"></script>
        <script src='https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js'></script>
        <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-auth.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-firestore.js"></script>
        <script src='https://www.gstatic.com/firebasejs/8.6.8/firebase-analytics.js'></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            var firebaseConfig = {
                apiKey: 'AIzaSyB-QgRCpeIuu8yW5mbjOu-eP1kStiZSNGo',
                authDomain: 'presentia-ca8ff.firebaseapp.com',
                projectId: 'presentia-ca8ff',
                storageBucket: 'presentia-ca8ff.appspot.com',
                messagingSenderId: '751141696653',
                appId: '1:751141696653:web:f03b3e430b929b26025ec4',
                measurementId: 'G-DGLE98332P'
            };

            firebase.initializeApp(firebaseConfig);
            firebase.analytics();
        </script>

        <script>
            const daftarkan = (pt, uc, ud, st, id) => {

                if (pt.length == 0 || uc.length == 0 || ud.length == 0) {
                    Swal.fire({
                        icon: "error",
                        title: "Data ID masih kosong!",
                        text: "Silahkan generate ID terlebih dahulu",
                    });
                    return false;
                }

                if (st) {
                    Swal.fire({
                        icon: "error",
                        title: "Sudah terdaftar!",
                    });
                    return false;
                }

                firebase.auth().signInAnonymously()
                    .then(async () => {
                        await firebase.firestore().collection('instance').doc(uc).set({
                            name: pt,
                            instanceId: uc,
                            discordClient: ud,
                            areaCoords: [],
                            admin: '',
                            dateRegistered: new Date().toLocaleDateString('id')
                        })
                    
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil mendaftarkan instansi!',
                        }).then(function() {
                            window.location = `ubahStatus.php?id=${id}`;
                        });                        
                        return true;

                    })
                    .catch((error) => {
                        console.log(error.message);
                    });
            }
        </script>
        <script>
            const hapusData = (hl, id) => {
                Swal.fire({
                title: 'Yakin?',
                text: 'Ingin menghapus data ini?',
                icon: 'warning',
                footer: 'Harap pikirkan kembali tindakan ini.',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        window.location = `hapus.php?halaman=${hl}&id=${id}`;
                    }
                })
            }

            const generateIdBaru = (hl, id) => {
                Swal.fire({
                title: 'Yakin?',
                text: 'Ingin membuat ID baru?',
                icon: 'warning',
                footer: 'Jika ada ID lama maka akan tertimpa ID baru.',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, buat!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        window.location = `generate.php?halaman=${hl}&id=${id}`;
                    }
                })
            }            
        </script>
</body>
</html>