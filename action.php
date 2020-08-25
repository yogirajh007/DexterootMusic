<?php 

// From URL to get webpage contents.
$journalName = $_GET['query'];
$journalName = preg_replace('/\s+/', '_', $journalName);
$url = "https://jiosaavnapi.bhadoo.uk/result/?query=".$journalName; 
//
// // Initialize a CURL session. 
$ch = curl_init(); 
//
// // Return Page contents. 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
//
// //grab URL and pass it to the variable. 
 curl_setopt($ch, CURLOPT_URL, $url); 

 $result = json_decode(curl_exec($ch), true);; 

 foreach ($result as $song) 
 {
	 $artist = $song['singers'];
	 $img_url = $song['image_url'];
	 echo "<img src='$img_url' width='200' height='200' >";
	 echo $song['title']."\t".$artist."\n";
	 $surl = $song['url'];
	 echo "<a href='$surl' >Link</a>"."<br>";
 }

 ?> 

