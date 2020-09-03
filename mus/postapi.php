<?php 

// From URL to get webpage contents.
$journalName = $_GET['query'];
$journalName = preg_replace('/\s+/', '-', $journalName);
$url = "http://127.0.0.1:5000/result/?query=".$journalName; 
//
// // Initialize a CURL session. 
$ch = curl_init(); 
//
// // Return Page contents. 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
//
// //grab URL and pass it to the variable. 
 curl_setopt($ch, CURLOPT_URL, $url); 

$result = json_decode(curl_exec($ch), true);
foreach ($result as $song)
{
 echo $song['album'];	
}
?>
