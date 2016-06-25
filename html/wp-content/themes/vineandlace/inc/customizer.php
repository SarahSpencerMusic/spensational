<?php
/**
 * Vine Lace Theme Customizer support
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Vine Lace 1.0
 */

/**
 * Implement Theme Customizer additions and adjustments.
 *
 * @since Vine Lace 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vinelace_customize_register( $wp_customize ) {
	// Add custom description to Colors and Background sections.
	$wp_customize->get_section( 'colors' )->description           = __( 'Background may only be visible on wide screens.', 'vinelace' );
	$wp_customize->get_section( 'background_image' )->description = __( 'Background may only be visible on wide screens.', 'vinelace' );

	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Rename the label to "Site Title Color" because this only affects the site title in this theme.
	$wp_customize->get_control( 'header_textcolor' )->label = __( 'Site Title Color', 'vinelace' );

	// Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
	$wp_customize->get_control( 'display_header_text' )->label = __( 'Display Site Title &amp; Tagline', 'vinelace' );
    
}
add_action( 'customize_register', 'vinelace_customize_register' );

/**
 * Sanitize the Featured Content layout value.
 *
 * @since Vine Lace 1.0
 *
 * @param string $layout Layout type.
 * @return string Filtered layout type (grid|slider).
 */

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Vine Lace 1.0
 */
function vinelace_customize_preview_js() {
	wp_enqueue_script( 'vinelace_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20131205', true );
}
add_action( 'customize_preview_init', 'vinelace_customize_preview_js' );

/**
 * Add contextual help to the Themes and Post edit screens.
 *
 * @since Vine Lace 1.0
 */
function vinelace_contextual_help() {
	if ( 'admin_head-edit.php' === current_filter() && 'post' !== $GLOBALS['typenow'] ) {
		return;
	}

	get_current_screen()->add_help_tab( array(
		'id'      => 'vinelace',
		'title'   => __( 'Vine Lace', 'vinelace' ),
		'content' =>
			'<ul>' .
				'<li>' . sprintf( __( 'The home page features your choice of up to 6 posts prominently displayed in a grid or slider, controlled by a <a href="%1$s">tag</a>; you can change the tag and layout in <a href="%2$s">Appearance &rarr; Customize</a>. If no posts match the tag, <a href="%3$s">sticky posts</a> will be displayed instead.', 'vinelace' ), esc_url( add_query_arg( 'tag', _x( 'featured', 'featured content default tag slug', 'vinelace' ), admin_url( 'edit.php' ) ) ), admin_url( 'customize.php' ), admin_url( 'edit.php?show_sticky=1' ) ) . '</li>' .
				'<li>' . sprintf( __( 'Enhance your site design by using <a href="%s">Featured Images</a> for posts you&rsquo;d like to stand out (also known as post thumbnails). This allows you to associate an image with your post without inserting it. Vine Lace uses featured images for posts and pages&mdash;above the title&mdash;and in the Featured Content area on the home page.', 'vinelace' ), 'http://codex.wordpress.org/Post_Thumbnails#Setting_a_Post_Thumbnail' ) . '</li>' .
				'<li>' . sprintf( __( 'For an in-depth tutorial, and more tips and tricks, visit the <a href="%s">Vine Lace documentation</a>.', 'vinelace' ), 'http://codex.wordpress.org/Twenty_Fourteen' ) . '</li>' .
			'</ul>',
	) );
}
add_action( 'admin_head-themes.php', 'vinelace_contextual_help' );
add_action( 'admin_head-edit.php',   'vinelace_contextual_help' );