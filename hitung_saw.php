<?php 
require "src/koneksi.php";

session_start();

if(!isset($_SESSION['login_spk'])){
    redirect("login_page.php");
}

function benefit($value, $max){
    return round($value/$max, 3);
}

function cost($value, $min){
    return round($min/$value, 3);
}
    
$tbl_siswa = query("SELECT * FROM siswa ORDER BY nilai_saw DESC");
$bobot = query("SELECT * FROM bobot");
$idSiswa = ambilKolom("siswa", "id");

// Simpan bobot per kriteria
$bobotRapot;
$bobotPenghasilan;
$bobotTanggungan;

foreach($bobot as $value){
    $bobotRapot = floatval($value['nilai_rapot']);
    $bobotPenghasilan = floatval($value['penghasilan']);
    $bobotTanggungan = floatval($value['tanggungan']);
}

// function untuk hitung pembobotan
function pembobotan($rapot, $penghasilan, $tanggungan){
    global $bobotRapot, $bobotPenghasilan, $bobotTanggungan;
    $a = $bobotRapot * $rapot;
    $b = $bobotPenghasilan * $penghasilan;
    $c = $bobotTanggungan * $tanggungan;
    return round($a + $b + $c, 4);
}

// Ambil Data Kriteria
$arrRapot = ambilKolom("siswa", "nilai_rapot");
$arrPenghasilan = ambilKolom("siswa", "penghasilan");
$arrTanggungan = ambilKolom("siswa", "tanggungan");

// array penghasilan akan dibagi 100,000
// agar angka-nya lebih kecil
$arrPenghasilanMin = array_map(function($penghasilan) {
    return $penghasilan / 100000;
}, $arrPenghasilan);

// Menggunakan perulangan lakukan normalisasi
// dan simpan ke dalam matrix
$matriks = array();
for($i = 0; $i < count($tbl_siswa); $i++){
    $arr = array();

    // Kriteria rapot
    array_push($arr, benefit($arrRapot[$i], max($arrRapot)));
    // Kriteria penghasilan
    array_push($arr, cost($arrPenghasilan[$i], min($arrPenghasilan)));
    // Kriteria tanggungan
    array_push($arr, benefit($arrTanggungan[$i], max($arrTanggungan)));

    // Simpan ke dalam matrix
    array_push($matriks, $arr);
}

$arrNilaiSaw = array();
foreach($matriks as $arr){
    array_push($arrNilaiSaw, pembobotan($arr[0], $arr[1], $arr[2]));
}

// Edit kolom nilai saw pada table siswa
foreach($idSiswa as $index => $id){
    mysqli_query($conn, "UPDATE siswa SET nilai_saw = '$arrNilaiSaw[$index]' WHERE id = '$id'");
}

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

    <div class="container mt-5">
        <div class="d-flex align-items-center">
            <h4 class="mb-0">Hasil Seleksi</h4>
            <i class="bi-arrow-clockwise rounded fs-3 ms-3 cursor-pointer text-primary" onclick="location.reload()"
                id="ic-refresh"></i>
        </div>
        <i class="text-muted">Jangan lupa direfresh!</i>

        <table class="table table-bordered table-striped table-hover shadow mt-3">
            <thead class="bg-primary text-white text-center">
                <th>NO</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Rapot</th>
                <th>Penghasilan</th>
                <th>Tanggungan</th>
                <th>Skor SAW</th>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach($tbl_siswa as $siswa): ?>
                <tr>
                    <td class="text-center"><?= $i++ ?></td>
                    <td><?= $siswa['nis'] ?></td>
                    <td><?= $siswa['nama'] ?></td>
                    <td><?= $siswa['nilai_rapot'] ?></td>
                    <td><?= rupiah($siswa['penghasilan']) ?></td>
                    <td><?= $siswa['tanggungan'] ?></td>
                    <td class="text-center"><?= $siswa['nilai_saw'] ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>