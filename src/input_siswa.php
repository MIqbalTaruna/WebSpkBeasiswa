<?php 
require "koneksi.php";

session_start();

if(!isset($_SESSION['login_spk'])){
    redirect("../login_page.php");
}


if($_SERVER["REQUEST_METHOD"] == "POST"){

    // ambil inputan admin dari var post
    $namaSiswa = stdValidation($_POST['nama'], true);
    $nisSiswa = stdValidation($_POST['nis'], true);
    $kelas = stdValidation($_POST['kelas'], true);
    $jk = $_POST['jk'];
    $nilaiRapot = stdValidation($_POST['nilai'], true);
    $tanggungan = stdValidation($_POST['tanggungan'], true);
    $penghasilan = stdValidation($_POST['penghasilan'], true);
    $alamat = stdValidation($_POST['alamat'], true);

    // jika ada inputan yang kosong
    if(isEmpty(array($namaSiswa, $nisSiswa, $kelas, $jk, $nilaiRapot, $tanggungan, $penghasilan, $alamat)))
    redirect("../siswa_page.php?field_error=1");

    // input data kedalam database
    mysqli_query($conn, "INSERT INTO siswa VALUES (
        null,
        '$namaSiswa',
        '$nisSiswa',
        '$jk',
        '$alamat',
        '$kelas',
        '$nilaiRapot',
        '$penghasilan',
        '$tanggungan',
        '0'
        )");

    redirect("../siswa_page.php#table-siswa");

} else {    
    redirect("../siswa_page.php");
}
?>