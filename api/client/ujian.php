<?php

include "../../config/koneksi.php";

$token = @$_POST['token'];
$action = @$_GET['action'];

// validasi

$data = null;
$linkNext = null;
$linkPrev = null;
$statusNext = null;
$statusPrev = null;

// cek user

$cekuser = mysqli_fetch_row(mysqli_query($kon, "SELECT * FROM `peserta`
 WHERE `token` = '".$token."'"));

if($cekuser > 0){
    $status = true;
    $pesan = "data berhasil didapatkan";

    if($action != ""){
        $query = mysqli_query($kon, "SELECT * FROM `soal`
         WHERE id_soal = '".$action."'  ORDER BY id_soal ASC limit 1");
    }else{
        $query = mysqli_query($kon, "SELECT * FROM `soal` ORDER BY id_soal ASC limit 1");
    }
    $data = mysqli_fetch_assoc($query);

    $queryNext = mysqli_query($kon, "SELECT * FROM `soal`
     WHERE id_soal > '".$data['id_soal']."'  ORDER BY id_soal ASC limit 1");

    $dataNext = mysqli_fetch_row($queryNext);

    $queryPrev = mysqli_query($kon, "SELECT * FROM `soal`
     WHERE id_soal < '".$data['id_soal']."'  ORDER BY id_soal DESC limit 1");

    $dataPrev = mysqli_fetch_row($queryPrev);

    if($dataNext > 0){
        $statusNext = true;
        $linkNext = 
        "http://".$_SERVER["HTTP_HOST"].
        "/pbd_2019_c/api/client/ujian.php?action=".$dataNext[0];
    }else{
        $statusNext = false;
        $linkNext = null;
    }

    if($dataPrev > 0){
        $statusPrev = true;
        $linkPrev = 
        "http://".$_SERVER["HTTP_HOST"].
        "/pbd_2019_c/api/client/ujian.php?action=".$dataPrev[0];
    }else{
        $statusPrev = false;
        $linkPrev = null;
    }
        
}else{
    $status = false;
    $pesan = "data gagal didapatkan";
}

$json = [
    "status" => $status,
    "pesan" => $pesan,
    "data" => [
        "soal" => $data,
        "prev" => [
            "statusPrev" => $statusPrev,
            "linkPrev" => $linkPrev
        ],
        "next" => [
            "statusNext" => $statusNext,
            "linkNext" => $linkNext
        ]
    ]
];

header("Content-Type: application/json");
echo json_encode($json);

?>