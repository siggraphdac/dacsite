<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DAC
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<img width="200px" src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/dac_logo.png">
			<img width="200px" src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/sig_logo.png">
			<!-- <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'dac' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'dac' ), 'WordPress' );
				?>
			</a> -->
			<!-- <span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'dac' ), 'dac', '<a href="http://underscores.me/">Frederick Ostrenko</a>' );
				?> -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
