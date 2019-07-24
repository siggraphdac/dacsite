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
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
