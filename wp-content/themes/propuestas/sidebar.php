<?php 
/**
 * 	sidebar
*/
?>
			<?php if ( ! dynamic_sidebar( 'sidebar' ) ) : // If the user hasn't defined any specific widgets in the admin yet, display a couple dummy widgets, as written below ?>
				<aside>
				</aside>

			<?php endif; // end sidebar widget area ?>