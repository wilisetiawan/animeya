<?php
session_start();
if ( !isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions.php';
    header("Content-type:application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=[Presentia] Data Perguruan Tinggi.xls");
?>


<h3>DATA PERGURUAN TINGGI</h3>
<table border="1">
    <tr>
        <th>Perguruan Tinggi</th>
        <th>Penanggungjawab</th>
        <th>Email</th>
        <th>Telp</th>
        <th>Status</th>
    </tr>
    <?php
    $data = mysqli_query($conn, "SELECT * FROM perguruan_tinggi");
    while($pt = mysqli_fetch_array($data)){
    ?>
    <tr>
        <td><?= $pt['nama_pt'] ?></td>
        <td><?= $pt['penanggungjawab'] ?></td>
        <td><?= $pt['email'] ?></td>
        <td style="mso-number-format:\@;"><?= $pt['telp'] ?></td>
        <td><?php 
        if ($pt['status'] == 1) {
           echo "Terdaftar";
        } else {
           echo "Belum terdaftar";
        }
         ?></td>
    </tr>
    <?php
        }
    ?>
</table>