<?php

include "../../../config/koneksi.php";

$pertanyaan = @$_POST["pertanyaan"];
$jawaban_a  = @$_POST["jawaban_a"];
$jawaban_b  = @$_POST["jawaban_b"];
$jawaban_c  = @$_POST["jawaban_c"];
$jawaban_d  = @$_POST["jawaban_d"];
$jawaban_e  = @$_POST["jawaban_e"];
$kunci      = @$_POST["kunci"];
$skor       = @$_POST["skor"];

$query = mysqli_query($kon, "INSERT INTO `soal`(`pertanyaan`, `jawaban_a`, `jawaban_b`, `jawaban_c`, `jawaban_d`, `jawaban_e`, `kunci`, `skor`) VALUES ('".$pertanyaan."', '".$jawaban_a."', '".$jawaban_b."','".$jawaban_c."','".$jawaban_d."','".$jawaban_e."', '".$kunci."', '".$skor."')");


if($query){
    $status = true;
    $pesan = "data berhasil disimpan";
}else{
    $status = false;
    $pesan = "data gagal disimpan";
}

$json = [
    "status" => $status,
    "pesan" => $pesan,
    "data" => $query
];

header("Content-Type: application/json");
echo json_encode($json);


?>