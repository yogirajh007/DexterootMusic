/*
	When the bandcamp link is pressed, stop all propagation so AmplitudeJS doesn't
	play the song.
*/
let bandcampLinks = document.getElementsByClassName('bandcamp-link');

for( var i = 0; i < bandcampLinks.length; i++ ){
	bandcampLinks[i].addEventListener('click', function(e){
		e.stopPropagation();
	});
}


songElements = document.getElementsByClassName('song');

for( var i = 0; i < songElements.length; i++ ){
	/*
		Ensure that on mouseover, CSS styles don't get messed up for active songs.
	*/
	songElements[i].addEventListener('mouseover', function(){
		this.style.backgroundColor = '#00A0FF';

		this.querySelectorAll('.song-meta-data .song-title')[0].style.color = '#FFFFFF';
		this.querySelectorAll('.song-meta-data .song-artist')[0].style.color = '#FFFFFF';

		if( !this.classList.contains('amplitude-active-song-container') ){
			this.querySelectorAll('.play-button-container')[0].style.display = 'block';
		}

		this.querySelectorAll('img.bandcamp-grey')[0].style.display = 'none';
		this.querySelectorAll('img.bandcamp-white')[0].style.display = 'block';
		this.querySelectorAll('.song-duration')[0].style.color = '#FFFFFF';
	});

	/*
		Ensure that on mouseout, CSS styles don't get messed up for active songs.
	*/
	songElements[i].addEventListener('mouseout', function(){
		this.style.backgroundColor = '#FFFFFF';
		this.querySelectorAll('.song-meta-data .song-title')[0].style.color = '#272726';
		this.querySelectorAll('.song-meta-data .song-artist')[0].style.color = '#607D8B';
		this.querySelectorAll('.play-button-container')[0].style.display = 'none';
		this.querySelectorAll('img.bandcamp-grey')[0].style.display = 'block';
		this.querySelectorAll('img.bandcamp-white')[0].style.display = 'none';
		this.querySelectorAll('.song-duration')[0].style.color = '#607D8B';
	});

	/*
		Show and hide the play button container on the song when the song is clicked.
	*/
	songElements[i].addEventListener('click', function(){
		this.querySelectorAll('.play-button-container')[0].style.display = 'none';
	});


}

/*
	Initializes AmplitudeJS
*/

$("#search").on('keypress',function (e) {
	if (e.keyCode == 13) {
		searchkey = document.getElementById("search").value;
		$('#blue-playlist-container').hide();
		$.get('https://api.music.dexteroot.ml/result/', {query: searchkey}, function (data) {
			console.log(data);
			datum = data;
		$('#blue-playlist-container').show()
		
		
		
			Amplitude.init({
				continue_next: true,
				
			
			
				"songs": [
					{
						"name": datum[0]['song'],
						"artist": datum[0]['primary_artists'],
						"album": datum[0]['album'],
						"url": datum[0]['media_url'],
						"cover_art_url": datum[0]['image']
					},
					{
						"name": datum[1]['song'],
						"artist": datum[1]['primary_artists'],
						"album": datum[0]['album'],
						"url": datum[1]['media_url'],
						"cover_art_url": datum[1]['image']
					},
					{
						"name": datum[2]['song'],
						"artist": datum[2]['primary_artists'],
						"album": datum[2]['album'],
						"url": datum[2]['media_url'],
						"cover_art_url": datum[2]['image']
					},
					{
						"name": datum[3]['song'],
						"artist": datum[3]['primary_artists'],
						"album": datum[3]['album'],
						"url": datum[3]['media_url'],
						"cover_art_url": datum[3]['image']
					},
					{
						"name": datum[4]['song'],
						"artist": datum[4]['primary_artists'],
						"album": datum[4]['album'],
						"url": datum[4]['media_url'],
						"cover_art_url": datum[4]['image']
					}
				]
			});
			for( var i = 0; i < songElements.length; i++ )
			{
				songElements[i].querySelectorAll('.song-meta-data .song-title')[0].innerHTML = datum[i]['song'];
				songElements[i].querySelectorAll('.song-meta-data .song-artist')[0].innerHTML = datum[i]['primary_artists'];
			}	
		
		});
			
	}
 });
