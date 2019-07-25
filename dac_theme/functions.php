<?php
/**
 * DAC functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DAC
 */

if ( ! function_exists( 'dac_setup' ) ) :

	function console_log($output, $with_script_tags = true) {
		$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
	');';
		if ($with_script_tags) {
				$js_code = '<script>' . $js_code . '</script>';
		}
		echo $js_code;
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function dac_setup() {
		show_admin_bar( false );

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on DAC, use a find and replace
		 * to change 'dac' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'dac', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menu( 'primary', __( 'Primary Menu', 'dac' ) );
		
		

		// register_nav_menus( array(
		// 	'menu-1' => esc_html__( 'Primary', 'dac' ),
		// ) );

		// function register_my_menu() {
		// 	register_nav_menu('header-menu',__( 'Header Menu' ));
		// }
		// add_action( 'init', 'register_my_menu' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'dac_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'dac_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dac_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'dac_content_width', 640 );
}
add_action( 'after_setup_theme', 'dac_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dac_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'dac' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'dac' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Search');
}
add_action( 'widgets_init', 'dac_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dac_scripts() {
	wp_enqueue_style( 'dac-style', get_stylesheet_uri() );

	wp_enqueue_script( 'dac-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'dac-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array(), '20190710', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dac_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function embed_posts_shortcode() {
	
	// Buffer variable
	$buffer='';

	// Argumens fot the query
	$args = array(
		'post_type' => array( 'post' ),
	);
	// The Query
	$the_query = new WP_Query( $args );
	// The Loop
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$buffer = '<h2 class="entry-title">'.$buffer.get_the_title().'</h2>';
			$buffer = $buffer.get_the_content();
			// get_template_part( 'template-parts/content', get_post_type() );
		}
	} else {
	// no posts found
	}
	// Restore original Post Data
	wp_reset_postdata();
	
	// Display the buffer
	return $buffer;
}
add_shortcode('embed_posts', 'embed_posts_shortcode');

function add_google_fonts() {
	wp_enqueue_style('add_google_fonts', 'https://fonts.googleapis.com/css?family=Karla:400,400i,700,700i', false );
}

add_action('wp_enqueue_scripts', 'add_google_fonts');

/**
 * Populate Wordpress with DAC starter content
 */

// require get_template_directory() . '/inc/populate-content.php';


