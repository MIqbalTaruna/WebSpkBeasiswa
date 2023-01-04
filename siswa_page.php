<?php 
session_start();

require "src/koneksi.php";

if(!isset($_SESSION['login_spk'])){
    header("Location: login_page.php");
    exit;
}

$fieldError = (isset($_GET['field_error']))? 1:0;

// ambil data siswa dari database
if(isset($_GET['keyword'])){
    $key = $_GET['keyword'];
    $tbl_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE
        nis         LIKE '%$key%' OR
        nama        LIKE '%$key%' OR
        jk          LIKE '%$key%' OR
        kelas       LIKE '%$key%' OR
        nilai_rapot LIKE '%$key%' OR
        penghasilan LIKE '%$key%' OR
        tanggungan  LIKE '%$key%'
    ");
} else {
    $tbl_siswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY id ASC");
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

    <!-- FORM -->
    <div class="container mt-5">
        <div class="row row-cols-1">
            <div class="col">
                <h4 class="mb-3">Input Data Siswa</h4>
                <?php if($fieldError != 0): ?>
                <p class="text-danger">*Terdapat Field Kosong</p>
                <?php endif ?>
                <form action="src/input_siswa.php" method="POST" class="form rounded shadow" id="form-siswa">
                    <div class="row row-cols-1 row-cols-md-3">
                        <div class="col-">
                            <label for="nama" class="form-label">Nama Siswa</label>
                            <input type="text" id="nama" name="nama" class="form-control">
                        </div>
                        <div class="col">
                            <label for="nis" class="form-label">NIS Siswa</label>
                            <input type="text" id="nis" name="nis" class="form-control">
                        </div>
                        <div class="col">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" id="kelas" name="kelas" class="form-control">
                        </div>
                    </div>
                    <div class="row row-cols-3">
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" id="jk-l" value="L">
                                <label class="form-check-label" for="jk-l">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" id="jk-p" value="P">
                                <label class="form-check-label" for="jk-p">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <label for="nilai" class="form-label">Nilai Rapot</label>
                            <input type="number" id="nilai" name="nilai" class="form-control" step="1" max="100"
                                min="0">
                        </div>
                        <div class="col">
                            <label for="tanggungan" class="form-label">Tanggungan</label>
                            <input type="number" step="1" id="tanggungan" min="0" name="tanggungan"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <label for="penghasil" class="form-label">Penghasilan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="number" name="penghasilan" id="penghasilan" class="form-control" min="0">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" id="alamat" name="alamat" class="form-control">
                        </div>
                    </div>
                    <div class="row row-cols-2 mb-0">
                        <div class="col">
                            <button type="reset" class="btn btn-secondary w-100">Reset</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- TABLE SISWA -->
    <div id="table-siswa" class="container my-5">
        <h4 class="mb-3">Table Siswa</h4>
        <form action="siswa_page.php#table-siswa" method="GET" class="row">
            <div class="col-6">
                <div class="input-group">
                    <i class="input-group-text bi-search"></i>
                    <input type="text" name="keyword" class="form-control" placeholder="Cari mahasiswa">
                </div>
            </div>
        </form>
        <table class="table table-striped table-hover table-bordered shadow">
            <thead class="bg-primary text-white text-center">
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>JK</th>
                <th>Kelas</th>
                <th>Alamat</th>
                <th>Rapot</th>
                <th>Penghasilan</th>
                <th>Tanggungan</th>
                <th>Aksi</th>
            </thead>
            <tbody class="table-light">
                <?php $i = 1; ?>
                <?php while($data = mysqli_fetch_assoc($tbl_siswa)): ?>
                <tr>
                    <td class="text-center"><?= $i++ ?></td>
                    <td><?= $data['nis'] ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['jk'] ?></td>
                    <td><?= $data['kelas'] ?></td>
                    <td><?= $data['alamat'] ?></td>
                    <td><?= $data['nilai_rapot'] ?></td>
                    <td><?= rupiah($data['penghasilan']) ?></td>
                    <td><?= $data['tanggungan'] ?></td>
                    <td class="fs-5 text-center">
                        <a class="bi-pencil-square me-1 cursor-pointer text-success"
                            href="edit_siswa_page.php?id-siswa=<?= $data['id'] ?>"></a>
                        <a class="bi-trash3-fill cursor-pointer text-danger"
                            href="src/delete_siswa.php?id-siswa=<?= $data['id'] ?>"></a>
                    </td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>

    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>