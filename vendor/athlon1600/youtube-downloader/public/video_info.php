<?php

require('../vendor/autoload.php');
header("Access-Control-Allow-Origin: *");
$url = isset($_GET['url']) ? $_GET['url'] : null;

if (!$url) {
    die("No url provided");
}

$youtube = new \YouTube\YouTubeDownloader();
$links = $youtube->getDownloadLinks($url);

$error = $youtube->getLastError();

header('Content-Type: application/json');
 header("Access-Control-Allow-Origin: *");

echo json_encode([
    'links' => $links,
    'error' => $error
], JSON_PRETTY_PRINT);
