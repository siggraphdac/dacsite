<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DAC
 */

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
