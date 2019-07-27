<?php

/* Template Name: All in One */ 

// This template combines all pages into one big page.

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		
		// WP_Query arguments
		$args = array(
			'post_type'              => array( 'page' ),
			'order'                  => 'ASC',
			'orderby'                => 'menu_order',
		);

		// The Query
		$the_query = new WP_Query( $args );
		
		// The Loop
		if ( $the_query->have_posts() ) {
		
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				get_template_part( 'template-parts/content', 'front' );
			}
		
		} else {
			// no posts found
		}
		/* Restore original Post Data */
		wp_reset_postdata();

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
