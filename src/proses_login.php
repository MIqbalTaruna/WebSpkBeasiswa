<?php 
session_start();

require "koneksi.php";

// jika sudah login kembali ke halaman index
if(isset($_SESSION['login_spk']))
    redirect("../index.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);

    $tbl_admin = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' AND password = '$password'");

    // jika username dan password salah
    // tampilkan pesan kesalahan
    if(mysqli_num_rows($tbl_admin) == 0)
        redirect("../login_page.php?login_error=1");

    // jika login berhasil
    // buka halaman index
    $_SESSION['login_spk'] = true;
    redirect("../index.php");

} else 
    redirect("../index.php");

?>