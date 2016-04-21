(function($) {
	$(document).ready(function(){

			 function bindScroll(){
			   if($(window).scrollTop() + $(window).height() > $(document).height() - 200) {
			       $(window).unbind('scroll');
			       cargarMas();
			   }
			}

			var count = 1;
			cargarMas = function(){
					count++;
					$("#blog").append('<div class="loading">cargando...</div>');
					$.ajax({
						url : postlove.ajax_url,
						type : 'post',
						data : {
							action : 'post_love_add_love',
							count:count,
						},
						success : function( response ) {
							
							var actualizaciones = JSON.parse(response);
							if(actualizaciones.length==0){
								$("#blog .loading").remove();
							}
							$.each(actualizaciones,function(index,act){
								$("#blog .loading").remove();
								html = '';
								html += '<section class="post ">';
								html += '<article style="background-image:url('+act.imagen+')">';
								html += '<a href="'+act.link+'">';
								html += '<h2 class="title">'+act.titulo+'</h2>';
								html += '<h3>'+act.excerpt+'</h3>';
								html += '</a>';
								html += '</article>';
								html += '</section>';
								$articulo = $(html);
								$("#blog").append($articulo);
								$(window).bind('scroll', bindScroll);
							})
						}
					});
				}

			$(window).bind('scroll', bindScroll);
		});

})(jQuery);