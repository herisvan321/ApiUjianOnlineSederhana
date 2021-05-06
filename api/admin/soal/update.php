<?php

include "../../../config/koneksi.php";

$id_soal =  @$_POST["id_soal"];
$pertanyaan = @$_POST["pertanyaan"];
$jawaban_a  = @$_POST["jawaban_a"];
$jawaban_b  = @$_POST["jawaban_b"];
$jawaban_c  = @$_POST["jawaban_c"];
$jawaban_d  = @$_POST["jawaban_d"];
$jawaban_e  = @$_POST["jawaban_e"];
$kunci      = @$_POST["kunci"];
$skor       = @$_POST["skor"];

$query = mysqli_query($kon, "UPDATE `soal` SET `pertanyaan`='". $pertanyaan ."',`jawaban_a`='". $jawaban_a ."',`jawaban_b`='". $jawaban_b ."',`jawaban_c`='". $jawaban_c ."',`jawaban_d`='". $jawaban_d ."',`jawaban_e`='". $jawaban_e ."',`kunci`='". $kunci ."',`skor`='". $skor ."' WHERE `id_soal`='".$id_soal."'");


if($query){
    $status = true;
    $pesan = "data berhasil diedit";
}else{
    $status = false;
    $pesan = "data gagal diedit";
}

$json = [
    "status" => $status,
    "pesan" => $pesan,
    "data" => $query
];

header("Content-Type: application/json");
echo json_encode($json);

?>