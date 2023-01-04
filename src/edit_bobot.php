<?php 
require "koneksi.php";

session_start();

if(!isset($_SESSION['login_spk'])){
    redirect("../login_page.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $idBobot = stdValidation($_POST['id_bobot']);
    $bobotRapot = stdValidation($_POST['nilai_rapot'], true);
    $bobotPenghasilan = stdValidation($_POST['penghasilan'], true);
    $bobotTanggungan = stdValidation($_POST['tanggungan'], true);

    // Jika ada inputan yang kosong
    if(isEmpty(array($bobotRapot, $bobotPenghasilan, $bobotTanggungan)))
        redirect("../bobot_page.php?field_error=1");

    // Jika total bobot tidak 1
    $totalBobot = floatval($bobotRapot) + floatval($bobotPenghasilan) + floatval($bobotTanggungan);
    if($totalBobot != 1)
        redirect("../bobot_page.php?bobot_error=1&id-bobot=$idBobot&total=$totalBobot");

    mysqli_query($conn, "UPDATE bobot SET
        nilai_rapot = '$bobotRapot',
        penghasilan = '$bobotPenghasilan',
        tanggungan = '$bobotTanggungan'
        WHERE id = '$idBobot'
        ");

    redirect("../bobot_page.php");

} else
    redirect("../bobot_page.php");

?>