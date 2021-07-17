<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions.php';

$id = $_GET["id"];
ubahStatus($id);
header("location: index.php");
exit;
