<?php 
require "koneksi.php";

session_start();

if(!isset($_SESSION['login_spk'])){
    redirect("../login_page.php");
}


if($_SERVER["REQUEST_METHOD"] == "POST"){

    // ambil inputan admin dari var post
    $idSiswa = stdValidation($_POST['id-siswa'], true);
    $namaSiswa = stdValidation($_POST['nama'], true);
    $nisSiswa = stdValidation($_POST['nis'], true);
    $kelas = stdValidation($_POST['kelas'], true);
    $jk = $_POST['jk'];
    $nilaiRapot = stdValidation($_POST['nilai'], true);
    $tanggungan = stdValidation($_POST['tanggungan'], true);
    $penghasilan = stdValidation($_POST['penghasilan'], true);
    $alamat = stdValidation($_POST['alamat'], true);

    // jika ada inputan yang kosong
    if(isEmpty(array($idSiswa, $namaSiswa, $nisSiswa, $kelas, $jk, $nilaiRapot, $tanggungan, $penghasilan, $alamat)))
    redirect("../siswa_page.php?field_error=1");

    // Edit data siswa
    mysqli_query($conn, "UPDATE siswa SET 
        id = '$idSiswa',
        nama = '$namaSiswa',
        nis = '$nisSiswa',
        jk = '$jk',
        alamat = '$alamat',
        kelas = '$kelas',
        nilai_rapot = '$nilaiRapot',
        penghasilan = '$penghasilan',
        tanggungan = '$tanggungan'
        WHERE id = '$idSiswa'
        ");

    redirect("../siswa_page.php#table-siswa");

} else {    
    redirect("../siswa_page.php");
}
?>