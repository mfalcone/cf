(function($) {

	domain = "http://"+location.hostname+location.pathname+"?json=get_posts&post_type=product";
	$.ajax({
		  type: "POST",
		  url: domain
		 // data: { name: "John", location: "Boston" }
	})

  .done(function( msg ) {
    console.log(  msg );
  });


})(jQuery);