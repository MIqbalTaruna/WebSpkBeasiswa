<?php 
require "src/koneksi.php";
session_start();

if(!isset($_SESSION['login_spk']))
    redirect("login_page.php");

$idSiswa = $_GET['id-siswa'];
$fieldError = (isset($_GET['field_error']))? 1:0;

// ambil data siswa
$tbl_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE id = '$idSiswa'");
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

    <div class="container mt-5">
        <div class="row row-cols-1">
            <div class="col">
                <h4 class="mb-3">Edit Data Siswa</h4>
                <?php if($fieldError != 0): ?>
                <p class="text-danger">*Terdapat Field Kosong</p>
                <?php endif ?>
                <form action="src/edit_siswa.php" method="POST" class="form rounded shadow" id="form-siswa">
                    <?php while($data = mysqli_fetch_assoc($tbl_siswa)): ?>
                    <input type="hidden" name="id-siswa" value="<?= $data['id'] ?>">
                    <div class="row row-cols-1 row-cols-md-3">
                        <div class="col-">
                            <label for="nama" class="form-label">Nama Siswa</label>
                            <input type="text" id="nama" name="nama" class="form-control" value="<?= $data['nama'] ?>">
                        </div>
                        <div class="col">
                            <label for="nis" class="form-label">NIS Siswa</label>
                            <input type="text" id="nis" name="nis" class="form-control" value="<?= $data['nis'] ?>">
                        </div>
                        <div class="col">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" id="kelas" name="kelas" class="form-control"
                                value="<?= $data['kelas'] ?>">
                        </div>
                    </div>
                    <div class="row row-cols-3">
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" id="jk-l" value="L"
                                    <?php if($data['jk'] == "L") echo "checked" ?>>
                                <label class="form-check-label" for="jk-l">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" id="jk-p" value="P"
                                    <?php if($data['jk'] == "P") echo "checked" ?>>
                                <label class="form-check-label" for="jk-p">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <label for="nilai" class="form-label">Nilai Rapot</label>
                            <input type="number" id="nilai" name="nilai" class="form-control" step="1" max="100" min="0"
                                value="<?= $data['nilai_rapot'] ?>">
                        </div>
                        <div class="col">
                            <label for="tanggungan" class="form-label">Tanggungan</label>
                            <input type="number" step="1" min="0" id="tanggungan" name="tanggungan" class="form-control"
                                value="<?= $data['tanggungan'] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <label for="penghasil" class="form-label">Penghasilan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="number" name="penghasilan" id="penghasilan" class="form-control" min="0"
                                    value="<?= $data['penghasilan'] ?>">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" id="alamat" name="alamat" class="form-control"
                                value="<?= $data['alamat'] ?>">
                        </div>
                    </div>
                    <div class="row row-cols-2 mb-0">
                        <div class="col">
                            <a href="siswa_page.php" class="btn btn-secondary w-100">Batal</a>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary w-100">Edit</button>
                        </div>
                    </div>
                    <?php endwhile ?>
                </form>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>