<?php

use YouTubeDownloader;

$yt = new YouTubeDownloader();

$links = $yt->getDownloadLinks("https://www.youtube.com/watch?v=LJzCYSdrHMI");

var_dump($links);


?>
