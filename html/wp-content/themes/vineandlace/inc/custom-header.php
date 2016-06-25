<?php
/**
 * Implement Custom Header functionality for Vine and Lace
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Vine and Lace 1.0
 */

/**
 * Set up the WordPress core custom header settings.
 *
 * @since Vine and Lace 1.0
 *
 * @uses vinelace_header_style()
 * @uses vinelace_admin_header_style()
 * @uses vinelace_admin_header_image()
 */
function vinelace_custom_header_setup() {
	/**
	 * Filter Vine and Lace custom-header support arguments.
	 *
	 * @since Vine and Lace 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type bool   $header_text            Whether to display custom header text. Default false.
	 *     @type int    $width                  Width in pixels of the custom header image. Default 1260.
	 *     @type int    $height                 Height in pixels of the custom header image. Default 240.
	 *     @type bool   $flex_height            Whether to allow flexible-height header images. Default true.
	 *     @type string $admin_head_callback    Callback function used to style the image displayed in
	 *                                          the Appearance > Header screen.
	 *     @type string $admin_preview_callback Callback function used to create the custom header markup in
	 *                                          the Appearance > Header screen.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'vinelace_custom_header_args', array(
		'default-text-color'     => '898989',
		'width'                  => 1080,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'vinelace_header_style',
		'admin-head-callback'    => 'vinelace_admin_header_style',
		'admin-preview-callback' => 'vinelace_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'vinelace_custom_header_setup' );

if ( ! function_exists( 'vinelace_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see vinelace_custom_header_setup().
 *
 */
function vinelace_header_style() {
	$text_color = get_header_textcolor();

	// If no custom color for text is set, let's bail.
	if ( display_header_text() && $text_color === get_theme_support( 'custom-header', 'default-text-color' ) )
		return;

	// If we get this far, we have custom styles.
	?>
	<style type="text/css" id="vinelace-header-css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description, .description {
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	<?php
		// If the user has set a custom color for the text, use that.
		elseif ( $text_color != get_theme_support( 'custom-header', 'default-text-color' ) ) :
	?>
		.site-title a {
			color: #<?php echo esc_attr( $text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // vinelace_header_style


if ( ! function_exists( 'vinelace_admin_header_style' ) ) :
/**
 * Style the header image displayed on the Appearance > Header screen.
 *
 * @see vinelace_custom_header_setup()
 *
 * @since Vine and Lace 1.0
 */
function vinelace_admin_header_style() {
?>
	<style type="text/css" id="vinelace-admin-header-css">
	.appearance_page_custom-header #headimg {
		border: none;
		max-width: 1000px;
		min-height: 48px;
		background: none;
	}
	#headimg h1 {
		font-family: 'Abel',sans-serif;
		font-size: 40px;
		line-height: 48px;
		margin: 0 0 0 30px;
	}
	.rtl #headimg h1  {
		margin: 0 0px 0 0;
	}
	#headimg h1 a {
		color: #000;
		text-decoration: none;
	}
	#headimg img {
		vertical-align: middle;
	}
	</style>
<?php
}
endif; // vinelace_admin_header_style

if ( ! function_exists( 'vinelace_admin_header_image' ) ) :
/**
 * Create the custom header image markup displayed on the Appearance > Header screen.
 *
 * @see vinelace_custom_header_setup()
 *
 * @since Vine and Lace 1.0
 */
function vinelace_admin_header_image() {
?>
	<title>Untitled Document</title><div id="headimg">
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
		<h1 class="displaying-header-text"><a id="name"<?php echo sprintf( ' style="color:#%s;"', get_header_textcolor() ); ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
	</div>
<?php
}
endif; // vinelace_admin_header_image