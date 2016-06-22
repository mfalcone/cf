	$(document).ready(function(){


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

		SC.initialize({
		  client_id: 'a485fcfe078bf1633b88428a5b846610',
		});

		if(location.search.split('id=')[1]){

			SC.get('/tracks/'+location.search.split('id=')[1]).then(function(track){
					$("article.post h2.cargando").hide();
			 		$article = $('<div class="nota"></div>')
					$article.append('<h2>'+track.title+'</a></h2>');
					$article.append('<p class="description">'+track.description+'</p>');
					$article.append('<img src="'+track.artwork_url+'">');
					var url = track.stream_url+"?client_id=a485fcfe078bf1633b88428a5b846610";
					$("article.post").append($article);
					$("#jquery_jplayer_1").jPlayer("setMedia",{mp3:url});
					$("#jquery_jplayer_1").jPlayer("play");

					if(track.artwork_url){
						var albumart = track.artwork_url.replace("large","t500x500")
						}else{
							albumart =""
						}
					$(".header-medios").css("background-image","url("+albumart+")")
			});

		}else{

		SC.get('/tracks', {
		      user_id: 217672912,
		      limit: 100
		  }).then(function(tracks) {
					$("article.post h2.cargando").hide();

					$.each(tracks,function(ind,obj){
						$article = $('<div class="nota"></div>')
						$article.append('<h2><a href="'+location.href+'?id='+obj.id+'">'+obj.title+'</a></h2>');
						$article.append('<p class="description">'+obj.description+'</p>');
						if(obj.artwork_url){
						$article.append('<img src="'+obj.artwork_url+'">');
						var albumart = obj.artwork_url.replace("large","t500x500")
						}else{
							albumart =""
						}
						$article.append('<a data-src="'+obj.stream_url+'" data-img="'+albumart+'" class="playMedia" href="#">Escuchar</a>');
						$("article.post").append($article);
					
					})
					$(".playMedia").click(function(e){
						e.preventDefault();
						$(".playMedia").text("Escuchar");
						$(this).text("Escuchando");
						var url = $(this).data("src")+"?client_id=a485fcfe078bf1633b88428a5b846610";
						var imgurl = $(this).data("img");
						console.log(imgurl)
						$("#jquery_jplayer_1").jPlayer("setMedia",{mp3:url});
						$("#jquery_jplayer_1").jPlayer("play");
						$(".header-medios").css("background-image","url("+imgurl+")")
					})	


				})
		  }


		

		})