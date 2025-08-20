<?php
if (!isset($_GET['provinsi'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Parameter provinsi tidak ditemukan']);
    exit;
}

$provCode = htmlspecialchars($_GET['provinsi']);
$url = "https://wilayah.id/api/regencies/$provCode.json";

$apiResult = file_get_contents($url);

if ($apiResult === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Gagal mengambil data dari API']);
    exit;
}

// Kirim ulang ke JS dengan header JSON
header('Content-Type: application/json');
echo $apiResult;
