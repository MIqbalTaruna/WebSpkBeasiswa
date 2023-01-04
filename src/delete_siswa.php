<?php 

require "koneksi.php";
session_start();

if(!isset($_SESSION['login_spk']))
    redirect("../login_page.php");

$idSiswa = $_GET['id-siswa'];

mysqli_query($conn, "DELETE FROM siswa WHERE id = '$idSiswa'");
redirect("../siswa_page.php#table-siswa");

?>