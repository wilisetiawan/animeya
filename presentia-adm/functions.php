<?php
require "../config/koneksi.php";

function query($query) {
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambah($data) {
  global $conn;
  // get data from each form element
  $namapt = htmlspecialchars(filter_var($data["nama_pt"], FILTER_SANITIZE_STRING));
  $penanggungjawab = htmlspecialchars(filter_var($data["penanggungjawab"], FILTER_SANITIZE_STRING));
  $email = strtolower(htmlspecialchars(filter_var($data["email"], FILTER_SANITIZE_EMAIL)));
  $telp = htmlspecialchars(filter_var($data["telp"], FILTER_SANITIZE_NUMBER_INT));

  // query insert
  $query = "INSERT INTO perguruan_tinggi VALUES('', '$namapt', '$penanggungjawab', '$email', '$telp', '', '', 0)";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function hapus($id) {
  global $conn;
  mysqli_query($conn, "DELETE FROM perguruan_tinggi WHERE id = $id");

  return mysqli_affected_rows($conn);
}

function ubah($data) {
  global $conn;
  // get data from each form element
  $id = $data["id"];
  $namapt = htmlspecialchars(filter_var($data["nama_pt"], FILTER_SANITIZE_STRING));
  $penanggungjawab = htmlspecialchars(filter_var($data["penanggungjawab"], FILTER_SANITIZE_STRING));
  $email = strtolower(htmlspecialchars(filter_var($data["email"], FILTER_SANITIZE_EMAIL)));
  $telp = htmlspecialchars(filter_var($data["telp"], FILTER_SANITIZE_NUMBER_INT));

  // query update
  $query = "UPDATE perguruan_tinggi set nama_pt = '$namapt', 
                penanggungjawab = '$penanggungjawab', email = '$email', 
                telp = '$telp' WHERE id = $id";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function generateKeyClient($id) {
  global $conn;
  $keyLength = 10;
  $str = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ()/$";
  $randStr = substr(str_shuffle($str), 0, $keyLength);

  $query = "UPDATE perguruan_tinggi set uniqid_client='$randStr' WHERE id = $id";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function generateKeyDiscord($id) {
  global $conn;
  $keyLength = 10;
  $str = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ()/$";
  $randStr = substr(str_shuffle($str), 0, $keyLength);

  $query = "UPDATE perguruan_tinggi set uniqid_discord='$randStr' WHERE id = $id";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function ubahStatus($id) {
  global $conn;
  $status = $id['status'];

  if (!$status) {
    header("location: index.php");
    exit;
    return true;
  }

  $query = "UPDATE perguruan_tinggi set status=1 WHERE id = $id";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
};
