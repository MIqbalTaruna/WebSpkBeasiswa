<?php 
$host = "localhost";
$username = "root";
$password = "";
$dbName = "spk_beasiswa";

$conn = mysqli_connect($host, $username, $password, $dbName);

function debug($out = ""){
    global $conn;
    echo $out . "<br>";
    echo mysqli_error($conn);
    exit;
}

function redirect(string $location){
    header("Location: ".$location);
    exit;
}

function stdValidation(string $input, bool $ws_trim = false){
    $input = htmlspecialchars($input);

    // jika ws_trim true maka rapihkan whitespace
    if($ws_trim){
        $input = preg_replace("/\s+/", " ", $input); // hapus whitespace berlebih diantara karakter
        $input = trim($input); // hapus whitespace depan dan belakang
    }
    return $input;
}

function isEmpty(array $inputs){
    foreach ($inputs as $input) {
        if(empty($input))
            return true;
    }
    return false;
}

function query(string $query){
    global $conn;

    $arr_hasil = [];
    $result = mysqli_query($conn, $query);
    while($data = mysqli_fetch_assoc($result))
        $arr_hasil[] = $data;

    return $arr_hasil;
}

function ambilKolom(string $nama_tabel, string $nama_kolom){
    global $conn;

    $arr_hasil = [];
    $result = mysqli_query($conn, "SELECT $nama_kolom FROM $nama_tabel ORDER BY id ASC");
    while($data = mysqli_fetch_row($result))
        $arr_hasil[] = $data[0];

    return $arr_hasil;
}

function ambilBaris(string $nama_tabel, string $where, string $value){
    global $conn;
    
    $result = mysqli_query($conn, "SELECT * FROM $nama_tabel WHERE $where = '$value'");
    $arr_hasil = mysqli_fetch_assoc($result);
    

    return $arr_hasil;
}

function ambilSatuData(string $nama_tabel, string $nama_kolom, string $where, string $value){
    global $conn;

    $result = mysqli_query($conn, "SELECT $nama_kolom FROM $nama_tabel WHERE $where = '$value'");
    $data = mysqli_fetch_row($result);

    return ($data === null)? false:"$data[0]";
}

function getNamaNegara(string $tim, $id_match){
    global $conn;
    $result = mysqli_query($conn, "SELECT negara.nama FROM negara INNER JOIN pertandingan ON pertandingan.".$tim." = negara.id AND pertandingan.id = '$id_match';");
    $data = mysqli_fetch_row($result);

    return ($data === null)? false:"$data[0]";
}

function showErrorMsg(string $msg){
    $open_tag = '<p class="text-danger mb-0 font-pt-sans">';
    return $open_tag . $msg . "</p>";
}

function countRows(string $countQuery){
    global $conn;
    $result = mysqli_query($conn, $countQuery);
    return mysqli_fetch_row($result)[0];
}

//membuat format rupiah dengan PHP
//tutorial www.malasngoding.com

function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah;

}
?>