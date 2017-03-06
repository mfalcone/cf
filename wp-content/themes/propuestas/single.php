<?php
/**
 * single
 *
 */

get_header(); ?>
<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<script type="text/javascript">
					elemToFlip  = <?php the_id(); ?>;
					</script>
				<?php endwhile; ?>
			<?php endif; ?>

<?php get_template_part( 'propuestas' ); ?>
<script type="text/javascript">
	  (function($) {
  	$(document).ready(function(){

	  $('#elem-'+elemToFlip+' .card .front').trigger('click');
	
	})

  }(jQuery));
</script>
<?php get_footer(); ?>
