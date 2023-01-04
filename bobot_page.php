<?php 
require "src/koneksi.php";
session_start();

if(!isset($_SESSION['login_spk']))
    redirect("login_page.php");

$fieldError = (isset($_GET['field_error']))? 1:0;
$bobotError = (isset($_GET['bobot_error']))? 1:0;

// Ambil data dari tabel bobot
$tbl_bobot = mysqli_query($conn, "SELECT * FROM bobot");
$tbl_bobot1 = mysqli_query($conn, "SELECT * FROM bobot");
$idBobot = (isset($_GET['id-bobot']))? $_GET['id-bobot']:"";

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

    <!-- FORM BOBOT -->
    <?php if(!empty($idBobot)): ?>
    <div class="container mt-5">
        <h4 class="mb-3">Edit Bobot</h4>
        <?php if($fieldError != 0): ?>
        <p class="text-danger">*Terdapat Field Kosong</p>
        <?php endif ?>
        <?php if($bobotError != 0): ?>
        <p class="text-danger">*Total Bobot Harus 1</p>
        <?php endif ?>
        <form action="src/edit_bobot.php" id="form-bobot" class="form rounded shadow" method="POST">
            <?php while($data = mysqli_fetch_assoc($tbl_bobot1)): ?>
            <input type="hidden" name="id_bobot" value="<?= $data['id'] ?>">
            <div class="row row-cols-3">
                <div class="col">
                    <label for="nilai_rapot" class="form-label">Nilai Rapot</label>
                    <input type="number" id="nilai_rapot" name="nilai_rapot" class="form-control" required min="0"
                        max="1" step="0.01" value="<?= $data['nilai_rapot'] ?>">
                </div>
                <div class="col">
                    <label for="penghasilan" class="form-label">Penghasilan</label>
                    <input type="number" id="penghasilan" name="penghasilan" class="form-control" required min="0"
                        max="1" step="0.01" value="<?= $data['penghasilan'] ?>">
                </div>
                <div class="col">
                    <label for="tanggungan" class="form-label">Tanggungan</label>
                    <input type="number" id="tanggungan" name="tanggungan" class="form-control" required min="0" max="1"
                        step="0.01" value="<?= $data['tanggungan'] ?>">
                </div>
            </div>
            <?php endwhile ?>
            <div class="row mb-0">
                <div class="col-4">
                    <a href="bobot_page.php" class="btn btn-secondary w-100">Batal</a>
                </div>
                <div class="col-4">
                    <button type="submit" name="submit" class="btn btn-primary w-100">Edit</button>
                </div>
            </div>
        </form>
    </div>
    <?php endif ?>

    <!-- TABLE BOBOT -->
    <div class="container mt-5">
        <h4 class="mb-3">Table Bobot</h4>
        <table class="table table-bordered shadow">
            <thead class="bg-primary text-white text-center">
                <th>Nilai Rapot</th>
                <th>Penghasilan</th>
                <th>Tanggungan</th>
                <th>Edit</th>
            </thead>
            <tbody class="bg-white">
                <?php while($data = mysqli_fetch_assoc($tbl_bobot)): ?>
                <tr class="text-center align-middle">
                    <td><?= $data['nilai_rapot'] ?></td>
                    <td><?= $data['penghasilan'] ?></td>
                    <td><?= $data['tanggungan'] ?></td>
                    <td>
                        <a href="bobot_page.php?id-bobot=<?= $data['id'] ?>"
                            class="bi-pencil-square text-success fs-4 cursor-pointer"></a>
                    </td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>



    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>