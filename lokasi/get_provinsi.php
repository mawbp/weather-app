<?php
header('Content-Type: application/json');

$url = "https://wilayah.id/api/provinces.json";
$response = file_get_contents($url);

if ($response === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Gagal mengambil data provinsi']);
    exit;
}

echo $response;