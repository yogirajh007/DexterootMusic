<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Music!</title>
  </head>
<link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <script src="/mus/audiojs/audio.min.js"></script>
    <script>
        $(function() {
            // Setup the player to autoplay the next track
            var a = audiojs.createAll({
                trackEnded: function() {
                    var next = $('table tr.playing').next();
                    if (!next.length) next = $('table tr').first();
                    next.addClass('playing').siblings().removeClass('playing');
                    audio.load($('a', next).attr('data-src'));
                    audio.play();
                }
            });

	    // Load in the first track
	    //document.getElementById('bigpic').style.display='block';
            var audio = a[0];
            first = $('tr a').attr('data-src');
            $('table tr').first().addClass('playing');
            audio.load(first);

            // Load in a track on click
	    $('table tr').click(function(e) {
                e.preventDefault();
                $(this).addClass('playing').siblings().removeClass('playing');
                audio.load($('a', this).attr('data-src'));
                audio.play();
            });
            // Keyboard shortcuts
        });
    </script>

  <body>


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

 $result = json_decode(curl_exec($ch), true);; 
?>

    <audio preload></audio>


<table class="table table-hover table-dark">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col"></th>
      <th scope="col">Song</th>
      <th scope="col">Artist</th>
      <th scope="col">Album</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($result as $song): ?>
    <tr>
      <th>1</th>
      <td><img id="bigpic" src="<?php echo $song['image']; ?>" style="width: 80px; height: 80px;"/>
</td>
  <td><?php echo $song['song']?></td>

      <td><a href="#" data-src="<?php 
 $url=$song['media_url'];
 //$url=substr($url, -4, -8);
 //$url=$url.".mp3";

 echo $url; ?>"></td>
      <td><?php echo $song['album'];?></td>
    </tr>
<?php endforeach ?>
  </tbody>
</table>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
