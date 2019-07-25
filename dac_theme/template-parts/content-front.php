<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DAC
 */

?>

<article id="post-<?php echo $post->post_name ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php 
			if ( get_page_template_slug( get_the_ID() ) != "page-templates/page_no-title.php" ){
				the_title( '<h1 class="entry-title">', '</h1>' );
			}
		?>
	</header><!-- .entry-header -->

	<?php dac_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dac' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
