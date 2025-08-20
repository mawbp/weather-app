<?php
if (!isset($_GET['desa'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Parameter wilayah tidak ditemukan']);
    exit;
}

$wilayahCode = htmlspecialchars($_GET['desa']);
$url = "https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4=$wilayahCode";

$apiResult = file_get_contents($url);

if ($apiResult === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Gagal mengambil data dari API']);
    exit;
}

// Kirim ulang ke JS dengan header JSON
header('Content-Type: application/json');
echo $apiResult;
