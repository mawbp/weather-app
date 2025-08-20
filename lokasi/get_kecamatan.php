<?php
if (!isset($_GET['kota'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Parameter kota tidak ditemukan']);
    exit;
}

$kotaCode = htmlspecialchars($_GET['kota']);
$url = "https://wilayah.id/api/districts/$kotaCode.json";

$apiResult = file_get_contents($url);

if ($apiResult === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Gagal mengambil data dari API']);
    exit;
}

// Kirim ulang ke JS dengan header JSON
header('Content-Type: application/json');
echo $apiResult;
