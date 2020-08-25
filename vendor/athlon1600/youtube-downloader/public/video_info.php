<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require('/var/www/html/dexteroot/music/vendor/autoload.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");
$url = isset($_GET['url']) ? $_GET['url'] : null;

if (!$url) {
    die("No url provided");
}

$youtube = new \YouTube\YouTubeDownloader();
$links = $youtube->getDownloadLinks($url);

$error = $youtube->getLastError();

header('Content-Type: application/json');
echo json_encode([
    'links' => $links,
    'error' => $error
], JSON_PRETTY_PRINT);
