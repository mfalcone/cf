	$(document).ready(function(){
		SC.initialize({
		  client_id: 'a485fcfe078bf1633b88428a5b846610',
		});

		SC.get('/tracks', {
		      user_id: 217672912,
		      limit: 100
		  }).then(function(tracks) {
	

					$.each(tracks,function(ind,obj){
						$article = $('<div class="nota"></div>')
						$article.append("<h2>"+obj.title+"</h2>");
						$article.append('<p class="description">'+obj.description+'</p>');
						$article.append('<img src="'+obj.artwork_url+'">');

						$article.append('<a data-src="'+obj.stream_url+'" class="playMedia" href="#">Escuchar</a>');
						$("article.post").append($article);
					
					})
					$(".playMedia").click(function(e){
						e.preventDefault();

						$(this).text("Escuchando");
						var url = $(this).data("src")+"?client_id=a485fcfe078bf1633b88428a5b846610";
						$("#jquery_jplayer_1").jPlayer("setMedia",{mp3:url});
						$("#jquery_jplayer_1").jPlayer("play");
					})	


				})


		 $("#jquery_jplayer_1").jPlayer({
	        cssSelectorAncestor: "#jp_container_1",
	        swfPath: "/js",
	        supplied: "mp3",
	        useStateClassSkin: true,
	        autoBlur: false,
	        smoothPlayBar: true,
	        keyEnabled: true,
	        remainingDuration: true,
	        toggleDuration: true
	      });
		


		})