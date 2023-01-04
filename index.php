<?php 
session_start();

require "src/koneksi.php";

if(!isset($_SESSION['login_spk'])){
    header("Location: login_page.php");
    exit;
}


// Data Siswa
$banyakSiswa = countRows("SELECT COUNT(*) FROM siswa");
$siswaLaki = countRows("SELECT COUNT(*) FROM siswa WHERE jk = 'L'");
$siswaPerempuan = countRows("SELECT COUNT(*) FROM siswa WHERE jk = 'P'");

$bobot = query("SELECT * FROM bobot")[0];

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
                        <a href="hitung_saw.php" class="nav-link">Seleksi</a>
                    </li>
                    <li class="nav-item">
                        <a href="src/logout.php" class="nav-link">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- DASHBOARD -->
    <div class="container">
        <h4 class="pt-5 pb-3">Dashboard</h4>
        <div class="row">
            <div class="col">
                <div class="shadow rounded bg-white p-3">
                    <p class="fs-5 mb-4">Bobot</p>
                    <div class="row mb-2">
                        <div class="col">
                            <span>Rapot</span>
                        </div>
                        <div class="col text-primary">
                            <span>: <?= $bobot['nilai_rapot'] ?></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <span>Penghasilan</span>
                        </div>
                        <div class="col text-primary">
                            <span>: <?= $bobot['penghasilan'] ?></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <span>Tanggungan</span>
                        </div>
                        <div class="col text-primary">
                            <span>: <?= $bobot['tanggungan'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="shadow rounded bg-white p-3">
                    <p class="fs-5 mb-1">Total Siswa</p>
                    <span class="fs-3 text-primary"><?= $banyakSiswa ?></span>
                </div>
            </div>
            <div class="col">
                <div class="shadow rounded bg-white p-3">
                    <p class="fs-5 mb-1">Siswa Laki-laki</p>
                    <span class="fs-3 text-primary"><?= $siswaLaki ?></span>
                </div>
            </div>
            <div class="col">
                <div class="shadow rounded bg-white p-3">
                    <p class="fs-5 mb-1">Siswa Perempuan</p>
                    <span class="fs-3 text-primary"><?= $siswaPerempuan ?></span>
                </div>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>