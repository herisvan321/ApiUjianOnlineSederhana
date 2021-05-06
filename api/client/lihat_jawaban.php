<?php

include "../../config/koneksi.php";

$token = @$_POST['token'];

// 
$dataArray = [];

// cek user

$cekuser = mysqli_fetch_row(mysqli_query($kon, "SELECT * FROM `peserta`
 WHERE `token` = '".$token."'"));

if($cekuser > 0){
    $query = mysqli_query($kon, "SELECT kondisi_jawaban,
     COUNT(kondisi_jawaban) AS jumlah, SUM(skor_jawaban) AS skor
      FROM `jawaban_peserta`
       WHERE `nins` = '".$cekuser[0]."'
        GROUP BY`kondisi_jawaban`  ");

    while($row = mysqli_fetch_assoc($query)){
        array_push($dataArray, $row);
    }

    if($query){
        $status = true;
        $pesan = "data Oke";
    }else{
        $status = false;
        $pesan = "data error";
    }
}else{
    $status = false;
    $pesan = "token tidak dikenali";
}

$json = [
    "status" => $status,
    "pesan" => $pesan,
    "data" => $dataArray
];

header("Content-Type: application/json");
echo json_encode($json);

?>