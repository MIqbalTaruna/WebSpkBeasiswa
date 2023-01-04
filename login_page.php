<?php 
session_start();

require "src/koneksi.php";

// jika sudah login kembali ke halaman index
if(isset($_SESSION['login_spk'])){
    header("Location: index.php");
    exit;
}

$login_error = (isset($_GET['login_error']))? 1:0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <div class="container my-container">
        <div id="login-card" class="shadow rounded">
            <h2 class="mb-3">Login</h2>
            <?php if($login_error == 1): ?>
            <p class="text-danger">*Username atau password salah</p>
            <?php endif; ?>

            <form action="src/proses_login.php" method="POST" class="form">
                <label for="username" class="form-label">Username</label>
                <div class="input-group mb-3">
                    <i id="icon" class="bi-person-circle input-group-text"></i>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>

                <label for="password" class="form-label">Password</label>
                <div class="input-group mb-3">
                    <i id="icon" class="bi-lock-fill input-group-text"></i>
                    <input type="password" id="password" name="password" class="form-control" required>
                    <i id="icon" class="input-group-text bi-eye-slash-fill cursor-pointer ic-eye"></i>
                </div>

                <button type="submit" name="submit" class="btn btn-primary w-100 mt-3">Login</button>
            </form>
        </div>
    </div>
</body>

</html>