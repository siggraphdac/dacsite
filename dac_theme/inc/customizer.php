<?php
/**
 * DAC Theme Customizer
 *
 * @package DAC
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function dac_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'dac_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'dac_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'dac_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function dac_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function dac_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function dac_customize_preview_js() {
	wp_enqueue_script( 'dac-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'dac_customize_preview_js' );


add_action( 'customize_register' , 'my_theme_options' );

function my_theme_options( $wp_customize ) {
	// Sections, settings and controls will be added here

	$wp_customize->add_section( 
		'dac_content_options', 
		array(
			'title'       => __( 'Populate Content', 'dac' ),
			'priority'    => -100,
			'capability'  => 'edit_theme_options',
			'description' => __('Toggle the checkbox on to create content.', 'dac'), 
		) 
	);

	$wp_customize->add_setting( 'pop_conent_toggle',
		array(
			'default' => 0
		)
	);    

	$wp_customize->add_control( new WP_Customize_Control( 
		$wp_customize, 
		'pop_conent_toggle_control',
		array(
			'label'    => __( 'Do you want content?', 'dac' ), 
			'section'  => 'dac_content_options',
			'settings' => 'pop_conent_toggle',
			'priority' => 10,
			'type'           => 'checkbox'
		) 
	));

}


