<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>audio.js</title>
    <meta content="width=device-width, initial-scale=0.6" name="viewport">
    <style>
        body { color: #666; font-family: sans-serif; line-height: 1.4; }
        h1 { color: #444; font-size: 1.2em; padding: 14px 2px 12px; margin: 0px; }
        h1 em { font-style: normal; color: #999; }
        a { color: #888; text-decoration: none; }
        #wrapper { width: 400px; }

        ol { padding: 0px; margin: 0px; list-style: decimal-leading-zero inside; color: #ccc; width: 460px; border-top: 1px solid #ccc; font-size: 0.9em; }
        ol li { position: relative; margin: 0px; padding: 9px 2px 10px; border-bottom: 1px solid #ccc; cursor: pointer; }
        ol li a { display: block; text-indent: -3.3ex; padding: 0px 0px 0px 20px; }
        li.playing { color: #aaa; text-shadow: 1px 1px 0px rgba(255, 255, 255, 0.3); }
        li.playing a { color: #000; }
        li.playing:before { content: '♬'; width: 14px; height: 14px; padding: 3px; line-height: 14px; margin: 0px; position: absolute; top: 9px; color: #000; font-size: 13px; text-shadow: 1px 1px 0px rgba(0, 0, 0, 0.2); }

        #shortcuts { position: fixed; bottom: 0px; width: 100%; color: #666; font-size: 0.9em; margin: 60px 0px 0px; padding: 20px 20px 15px; background: #f3f3f3; background: rgba(240, 240, 240, 0.7); }
        @media screen and () {
            #wrapper { position: relative; }
            #shortcuts { display: none; }
        }

        .credit {
            text-align: center;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="/mus/audiojs/audio.min.js"></script>
    <script>
        $(function() {
            // Setup the player to autoplay the next track
            var a = audiojs.createAll({
                trackEnded: function() {
                    var next = $('ol li.playing').next();
                    if (!next.length) next = $('ol li').first();
                    next.addClass('playing').siblings().removeClass('playing');
                    audio.load($('a', next).attr('data-src'));
                    audio.play();
                }
            });

	    // Load in the first track
	    //document.getElementById('bigpic').style.display='block';
            var audio = a[0];
            first = $('ol a').attr('data-src');
            $('ol li').first().addClass('playing');
            audio.load(first);

            // Load in a track on click
	    $('ol li').click(function(e) {
                e.preventDefault();
                $(this).addClass('playing').siblings().removeClass('playing');
                audio.load($('a', this).attr('data-src'));
                audio.play();
            });
            // Keyboard shortcuts
            $(document).keydown(function(e) {
                var unicode = e.charCode ? e.charCode : e.keyCode;
                // right arrow
                if (unicode == 39) {
                    var next = $('li.playing').next();
                    if (!next.length) next = $('ol li').first();
                    next.click();
                    // back arrow
                } else if (unicode == 37) {
                    var prev = $('li.playing').prev();
                    if (!prev.length) prev = $('ol li').last();
                    prev.click();
                    // spacebar
                } else if (unicode == 32) {
                    audio.playPause();
                }
            })
        });
    </script>
</head>
<body style="text-align: center; background: #1a1e24; color:white;">
<div id="wrapper">
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

    <h1>Results:</h1>


    <audio preload></audio>
<?php foreach ($result as $song): ?>
   <ol>
    <li><img id="bigpic" src="<?php echo $song['image']; ?>" style="width=20px; height=20px;"/>
 
    <a href="#" data-src="<?php 
 $url=$song['media_url'];
 //$url=substr($url, 0, -8);
 //$url=$url.".mp3";

echo $url?>"><?php echo $song['song']?></a></li>
    </ol>
<?php endforeach ?>
</div>

</body>
</html>
