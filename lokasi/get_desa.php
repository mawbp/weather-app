<?php
if (!isset($_GET['kecamatan'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Parameter kecamatan tidak ditemukan']);
    exit;
}

$kecamatanCode = htmlspecialchars($_GET['kecamatan']);
$url = "https://wilayah.id/api/villages/$kecamatanCode.json";

$apiResult = file_get_contents($url);

if ($apiResult === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Gagal mengambil data dari API']);
    exit;
}

// Kirim ulang ke JS dengan header JSON
header('Content-Type: application/json');
echo $apiResult;
