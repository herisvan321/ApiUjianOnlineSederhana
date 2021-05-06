<?php

include "../../config/koneksi.php";

$email = @$_POST["email"];
$password = md5(@$_POST["password"]);

$query = mysqli_query($kon, "SELECT * FROM `peserta` 
   WHERE `email` = '".$email."' && `password` = '".$password."'");

$row = mysqli_fetch_row($query);
$token = "";

if($row > 0){
    $status = true;
    $pesan = "Anda berhasil Login";

    $rand = mt_rand(0, 60);
    $token = md5($rand . time());
    $queryUpdate = mysqli_query($kon, "UPDATE `peserta` SET 
    `token`='".$token."' WHERE `nisn`='".$row[0]."'");

}else{
    $status = false;
    $pesan = "Anda gagal Login";
}

$json = [
    "status" => $status,
    "pesan" => $pesan,
    "data" => [
        "token" => $token
    ]
];

header("Content-Type: application/json");
echo json_encode($json);

?>