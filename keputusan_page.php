<?php 
require "src/koneksi.php";
session_start();

if(!isset($_SESSION['login_spk']))
    redirect("login_page.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB SPK</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    </style>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <a class="navbar-brand fs-3" href="index.php">SPK Penerimaan Beasiswa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="siswa_page.php">Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a href="bobot_page.php" class="nav-link">Bobot</a>
                    </li>
                    <li class="nav-item">
                        <a href="src/hitung_saw.php" class="nav-link">Seleksi</a>
                    </li>
                    <li class="nav-item">
                        <a href="src/logout.php" class="nav-link">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="rounded shadow bg-white p-3 mx-auto w-50">
            <form action="src/hitung_saw.php" method="POST" class="form text-center">
                <label for="kuota" class="form-label fs-3 mb-4">Kuota Penerima Beasiswa</label>
                <input type="number" step="1" id="kuota" name="kuota" class="form-control mb-4" required min="1">
                <button type="submit" name="submit" class="btn btn-primary w-100">SELEKSI</button>
            </form>
        </div>
    </div>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>