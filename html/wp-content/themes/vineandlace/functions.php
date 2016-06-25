<?php
/**
 * Vine Lace functions and definitions
 *
 */

/**
 * Set up the content width.
 *
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1080;
}

if ( ! function_exists( 'vinelace_setup' ) ) :
/**
 * Vine Lace setup.
 *
 */
function vinelace_setup() {

	/*
	 * Make Vine Lace available for translation.
	 *
	 */
	load_theme_textdomain( 'vinelace', get_template_directory() . '/languages' );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 775, 522, true );
	add_image_size( 'full-width', 1080, 720, true );
    add_image_size( 'large', 775, 522, true );
  
function my_custom_sizes( $sizes ) {
  return array_merge( $sizes, array(
    'large' => __( 'Large', 'vinelace'),
	'full-width' => __( 'Full Width Page', 'vinelace'),
  ) );
}
add_filter( 'image_size_names_choose', 'my_custom_sizes' );
  

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'vinelace' ),
	) );

  	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
  
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * 
	 */
	add_theme_support( 'post-formats', array(
		'image', 'video', 'quote', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'vinelace_custom_background_args', array(
		'default-color' => 'ffffff',
	) ) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // vinelace_setup
add_action( 'after_setup_theme', 'vinelace_setup' );

/**
 * Register Vine Lace widget areas.
 *
 */
function vinelace_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'vinelace' ),
		'id'            => 'sidebar',
		'description'   => __( 'Sidebar that appears on the right.', 'vinelace' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
  
	register_sidebar( array(
		'name'          => __( 'About Page', 'vinelace' ),
		'id'            => 'about',
		'description'   => __( 'widget section to display social icons', 'vinelace' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	       
	register_sidebar(array(  
        'name' => 'Footer',  
        'id'   => 'footer',  
        'description'   => 'Widget area for the footer',  
		'before_widget' => '<div id="%1$s" class="widget %2$s">',  
		'after_widget'  => '</div>',  
		'before_title'  => '<h4>',  
		'after_title'   => '</h4>'  
        ));  
}
add_action( 'widgets_init', 'vinelace_widgets_init' );

/**
 * Register Lato Google font for Vine Lace.
 *
 * @since Vine Lace 1.0
 *
 * @return string
 */
function vinelace_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'vinelace' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueue scripts and styles.
 *
 */
function vinelace_scripts() {
	// Add Lato font, used in the main stylesheet.
	wp_enqueue_style( 'vinelace-lato', vinelace_font_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );

	// Load our main stylesheet.
	wp_enqueue_style( 'vinelace-style', get_stylesheet_uri(), array( 'genericons' ) );
	
	wp_register_script('vinelace', get_template_directory_uri() . '/js/vinelace.js', 'jquery', '', true);
	wp_register_style('bxslider-css', get_template_directory_uri() . '/css/jquery.bxslider.css');
	wp_register_script('bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', 'jquery', '', true);

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'vinelace-ie', get_template_directory_uri() . '/css/ie.css', array( 'vinelace-style', 'genericons' ), '20131205' );
	wp_style_add_data( 'vinelace-ie', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'vinelace-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402' );
	}

	wp_enqueue_script( 'vinelace-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20140616', true );
	
	wp_enqueue_style('bxslider-css');
	wp_enqueue_script('bxslider');
	wp_enqueue_script('vinelace');
}
add_action( 'wp_enqueue_scripts', 'vinelace_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 */
function vinelace_admin_fonts() {
	wp_enqueue_style( 'vinelace-lato', vinelace_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'vinelace_admin_fonts' );

if ( ! function_exists( 'vinelace_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 */
function vinelace_the_attached_image() {
	$post                = get_post();
	/**
	 * Filter the default Vine Lace attachment size.
	 *
	 */
	$attachment_size     = apply_filters( 'vinelace_attachment_size', array( 775, 522 ) );
	$next_attachment_url = wp_get_attachment_url();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'vinelace_list_authors' ) ) :
/**
 * Print a list of all site contributors who published at least one post.
 *
 */
function vinelace_list_authors() {
	$contributor_ids = get_users( array(
		'fields'  => 'ID',
		'orderby' => 'post_count',
		'order'   => 'DESC',
		'who'     => 'authors',
	) );

	foreach ( $contributor_ids as $contributor_id ) :
		$post_count = count_user_posts( $contributor_id );

		// Move on if user has not published a post (yet).
		if ( ! $post_count ) {
			continue;
		}
	?>

	<div class="contributor">
		<div class="contributor-info">
			<div class="contributor-avatar"><?php echo get_avatar( $contributor_id, 132 ); ?></div>
			<div class="contributor-summary">
				<h2 class="contributor-name"><?php echo get_the_author_meta( 'display_name', $contributor_id ); ?></h2>
				<p class="contributor-bio">
					<?php echo get_the_author_meta( 'description', $contributor_id ); ?>
				</p>
				<a class="button contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $contributor_id ) ); ?>">
					<?php printf( _n( '%d Article', '%d Articles', $post_count, 'vinelace' ), $post_count ); ?>
				</a>
			</div><!-- .contributor-summary -->
		</div><!-- .contributor-info -->
	</div><!-- .contributor -->

	<?php
	endforeach;
}
endif;

// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

add_filter('term_links-post_tag','limit_to_three_tags');
function limit_to_three_tags($terms) {
return array_slice($terms,0,3,true);
}

// Enqueue Scripts/Styles for our Lightbox
function vinelace_add_lightbox() {
    wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/inc/lightbox/js/jquery.fancybox.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/inc/lightbox/js/lightbox.js', array( 'fancybox' ), false, true );
    wp_enqueue_style( 'lightbox-style', get_template_directory_uri() . '/inc/lightbox/css/jquery.fancybox.css' );
}
add_action( 'wp_enqueue_scripts', 'vinelace_add_lightbox' );

/**
* Custom Widgets
*/
require( get_stylesheet_directory() . '/inc/widgets/about.php' );
require( get_stylesheet_directory() . '/inc/widgets/social.php' );
require( get_template_directory() . '/inc/widgets/recent-posts.php' );

function enqueue_custom_google_fonts() {
  wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Arvo|Droid+Sans|Droid+Serif|Josefin+Sans|Lato|Open+Sans|Oswald|Roboto|Roboto Slab|Rokkitt|PT+Sans|Pacifico|Tinos' );	
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_google_fonts' );

/**
* Exclude Categories
*/
function the_category_exclude($separator=', ',$exclude='') {
	$toexclude = explode(",", $exclude);
	$newlist = array();
	foreach((get_the_category()) as $category) {
		if(!in_array($category->category_nicename,$toexclude) && ($category->category_parent == 0)){
			//$newlist[] = $category->cat_name;
			$newlist[] = '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'vinelace'), $category->name ) . '" ' . '>'  . $category->name.'</a>';
		}
	}
	return implode($separator,$newlist);
}

/* 
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}

/************* OPTIONS TYPOGRAPHY *****************/
/* 
 * Note: Options Typography is a child theme of Options Framework Theme
 * So all the functions from the parent theme are also inherited
 */
 
 /**
 * Returns an array of system fonts
 * Feel free to edit this, update the font fallbacks, etc.
 */


function options_typography_get_os_fonts() {
	// OS Font Defaults
	$os_faces = array(
		'Arial, sans-serif' => 'Arial',
		'"Avant Garde", sans-serif' => 'Avant Garde',
		'Cambria, Georgia, serif' => 'Cambria',
		'Copse, sans-serif' => 'Copse',
		'Courier New, sans-serif' => 'Courier New',
		'Garamond, "Hoefler Text", Times New Roman, Times, serif' => 'Garamond',
		'Georgia, serif' => 'Georgia',
		'"Helvetica Neue", Helvetica, sans-serif' => 'Helvetica Neue',
		'Tahoma, Geneva, sans-serif' => 'Tahoma'
	);
	return $os_faces;
}

/**
 * Returns a select list of Google fonts
 * Feel free to edit this, update the fallbacks, etc.
 */

function options_typography_get_google_fonts() {
	// Google Font Defaults
	$google_faces = array(
		'Arvo, serif' => 'Arvo',
	    '"Bad Script", cursive' => 'Bad Script',
		'Droid Sans, sans-serif' => 'Droid Sans',
		'Droid Serif, serif' => 'Droid Serif',
		'Josefin Sans, sans-serif'  => 'Josefin Sans',
		'Lato, sans-serif'  => 'Lato',
		'Open Sans, sans-serif' => 'Open Sans',
		'Oswald, sans-serif' => 'Oswald',
	    'Pacifico, cursive' => 'Pacifico',
	    'PT Sans, sans-serif' => 'PT Sans',
	  	'Roboto Slab, serif' => 'Roboto Slab',
	    'Roboto, sans-serif' => 'Roboto',
		'Rokkitt, serif' => 'Rokkit',
	    'Tinos, serif' => 'Tinos'
	    
	);
	return $google_faces;
}

$typography_mixed_fonts = array_merge( options_typography_get_os_fonts() , options_typography_get_google_fonts() );
asort($typography_mixed_fonts);

/* 
 * Outputs the selected option panel styles inline into the <head>
 */
 
function options_typography_styles() {
 	
 	// It's helpful to include an option to disable styles.  If this is selected
 	// no inline styles will be outputted into the <head>
 	
 	if ( !of_get_option( 'disable_styles' ) ) {
		$output = '';
		$input = '';
		
		if ( of_get_option( 'featured_image' ) ) {
		  $output .= '.post-thumbnail {display: none!important}';
		}
	    
	    if ( of_get_option( 'post_categories' ) ) {
		  $output .= '.cat-links {display: none!important}';
		}
	  
	  	if ( of_get_option( 'post_tags' ) ) {
		  $output .= '.tag-links {display: none!important}';
		}
	    
	    if ( of_get_option( 'display_signature' ) ) {
		  $output .= '.post-signature {display: none!important}';
		}
	  
		if ( of_get_option( 'site_title_text' ) ) {
			$output .= options_typography_font_styles( of_get_option( 'site_title_text' ) , '.site-title, .site-title a, .site-title a:hover');
		}

		if ( of_get_option( 'site_tagline' ) ) {
			$output .= options_typography_font_styles( of_get_option( 'site_tagline' ) , '.description, .description h2');
		}

		if ( of_get_option( 'tabs_font' ) ) {
			$output .= options_typography_font_styles( of_get_option( 'tabs_font' ) , '.site-navigation a,.site-navigation .current_page_item > a, .site-navigation .current_page_ancestor > a, .site-navigation .current-menu-item > a, .site-navigation .current-menu-ancestor > a, .site-navigation li .current_page_item > a, .site-navigation li .current_page_ancestor > a, .site-navigation li .current-menu-item > a, .site-navigation li .current-menu-ancestor > a');
		}

		if ( of_get_option( 'tabs_hover_color' ) ) {
			$output .= '.primary-navigation li:hover > a, .primary-navigation li.focus > a, .site-navigation a:hover, .primary-navigation ul ul a:hover, .primary-navigation ul ul li.focus > a   {color:' . of_get_option( 'tabs_hover_color' ) . '}';
		}

		if ( of_get_option( 'post_title_font' ) ) {
			$output .= options_typography_font_styles( of_get_option( 'post_title_font' ) , '.entry-title a, .entry-title, .entry-title a:hover');
		}
	  
	     if ( of_get_option( 'post_date' ) ) {
			$output .= options_typography_font_styles( of_get_option( 'post_date' ) , 'span.entry-date, span.entry-date a, #relatedposts span ');
		}
	  
		if ( of_get_option( 'post_meta' ) ) {
			$output .= options_typography_font_styles( of_get_option( 'post_meta' ) , '.entry-meta a, .site-content .entry-meta, .entry-meta, .entry-meta a .entry-content a');
		}

		if ( of_get_option( 'post_body' ) ) {
			$output .= options_typography_font_styles( of_get_option( 'post_body' ) , 'body, .entry-content, .entry-content p, .entry-summary p, .comment-content p, del, .entry-content em, .entry-content b, .entry-content strong, .entry-content blockquote, .content-sidebar .widget blockquote, .entry-content li, .entry-content span, .entry-content div, #relatedposts h2 a ');
		}
	  
	    if ( of_get_option( 'post_signature' ) ) {
			$output .= options_typography_font_styles( of_get_option( 'post_signature' ) , '.entry-content .signature, .signature ');
		}

		if ( of_get_option( 'link_color' ) ) {
			$output .= 'a, .site-info a, a:active, .post-navigation a, .paging-navigation .page-numbers.current {color:' . of_get_option( 'link_color' ) . '}';
		}
		
		if ( of_get_option( 'link_hover_color' ) ) {
			$output .= 'a:hover, .site-info a:hover, .post-navigation a:hover, .paging-navigation a:hover {color:' . of_get_option( 'link_hover_color' ) . '}';
		}

		if ( of_get_option( 'sidebar_title_text' ) ) {
			$output .= options_typography_font_styles( of_get_option( 'sidebar_title_text' ) , '.comment-reply-title, .comments-title, #relatedposts h3, .primary-sidebar .widget .widget-title, .widget-title, .widget-title a, .footer-sidebar .widget h1, .footer-sidebar .widget .widget-title, .content-sidebar .widget .widget-title, .widget h4');
		}
		
		if ( of_get_option( 'sidebar_text' ) ) {
			$output .= options_typography_font_styles( of_get_option( 'sidebar_text' ) , '.tagcloud a, .widget-area .widget .textwidget, .widget-area .widget p, .content-sidebar .widget_calendar caption');
		}
	  
	    if ( of_get_option( 'sidebar_link' ) ) {
			$output .= options_typography_font_styles( of_get_option( 'sidebar_link' ) , '  .widget_calendar tbody a, .widget a, .content-sidebar .widget a, .widget-area .widget li, .widget-area .widget a, .widget.nudgemediadesign_recent_posts li .latest-item .latest-item-text h4 a');
		}
	  
	    if ( of_get_option( 'sidebar_link_hover' ) ) {
			$output .= '.widget a:hover, .widget-area .widget a:hover, .widget a:hover, .widget_calendar tbody a:hover, .content-sidebar .widget a:hover {color:' . of_get_option( 'sidebar_link_hover' ) . '}';
		}
	  
		if ( of_get_option( 'footer_credits' ) ) {
			$output .= options_typography_font_styles( of_get_option( 'footer_credits' ) , '.site-info');
		}

		if ( of_get_option( 'social_font' ) ) {
			$output .= '.social-button-wrap a:link, .social-button-wrap a, .social-button-wrap a:visited, .social-button-wrap p {color:' . of_get_option( 'social_font' ) . '}';
		}

		if ( of_get_option( 'social_hover_color' ) ) {
			$output .= '.social-button-wrap a:hover {color:' . of_get_option( 'social_hover_color' ) . '}';
		}
		
		if ( $output != '' ) {
			$output = "\n<style>\n" . $output . "</style>\n";
			echo $output;
		}
	}
}
add_action('wp_head', 'options_typography_styles');

/* 
 * Returns a typography option in a format that can be outputted as inline CSS
 */
 
function options_typography_font_styles($option, $selectors) {
		$output = $selectors . ' {';
		$output .= 'color:' . $option['color'] .'; ';
		$output .= 'font-family:' . $option['face'] . '; ';
		$output .= 'font-weight:' . $option['style'] . '; ';
		$output .= 'font-size:' . $option['size'] . '; ';
		$output .= '}';
		$output .= "\n";
		return $output;
}

/**
 * Checks font options to see if a Google font is selected.
 * If so, options_typography_enqueue_google_font is called to enqueue the font.
 * Ensures that each Google font is only enqueued once.
 */
 
if ( !function_exists( 'options_typography_google_fonts' ) ) {
	function options_typography_google_fonts() {
		if ( !is_admin() ) {
			$all_google_fonts = array_keys( options_typography_get_google_fonts() );
			// Define all the options that possibly have a unique Google font
				$text_font = of_get_option('text_font', false);
			$header_font = of_get_option('header_font', false);
			$tabs_font = of_get_option('tabs_font', false);
			$widget_font = of_get_option('widget_font', false);
			$date_font = of_get_option('date_font', false);
			// Get the font face for each option and put it in an array
			$selected_fonts = array(
				$text_font['face'],
				$header_font['face'],
				$tabs_font['face'],
				$widget_font['face'] ,
				$date_font['face'] );
			// Remove any duplicates in the list
			$selected_fonts = array_unique($selected_fonts);
			// Check each of the unique fonts against the defined Google fonts
			// If it is a Google font, go ahead and call the function to enqueue it
			foreach ( $selected_fonts as $font ) {
				if ( in_array( $font, $all_google_fonts ) ) {
					options_typography_enqueue_google_font($font);
				}
			}
		}
	}
}

add_action( 'init', 'options_typography_google_fonts' );

/**
 * Enqueues the Google $font that is passed
 */
 
function options_typography_enqueue_google_font($font) {
	$font = explode(',', $font);
	$font = $font[0];
	// Certain Google fonts need slight tweaks in order to load properly
	// Like our friend "Raleway"
	if ( $font == 'Raleway' )
		$font = 'Raleway:100';
	$font = str_replace(" ", "+", $font);
	wp_enqueue_style( "options_typography_$font", "http://fonts.googleapis.com/css?family=$font", false, null, 'all' );
}

require_once dirname( __FILE__ ) . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'vinelace_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function vinelace_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Simple Custom CSS',
            'slug'      => 'simple-custom-css',
            'required'  => false,
        ),

    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}

add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args' );
function my_widget_tag_cloud_args( $args ) {
	$args['number'] = 20;
	$args['largest'] = 14;
	$args['smallest'] = 14;
	$args['unit'] = 'px';
	return $args;
}

add_action( 'customize_register', 'vinelace_customize_register' );
	function vinelace_customize_register( $wp_customize ) {
	 
	   $wp_customize->remove_control('header_textcolor');
	   $wp_customize->remove_section( 'nav' );
	   $wp_customize->remove_section( 'featured_content' );
	   $wp_customize->get_section( 'colors' )->description = __( 'Background may only be visible on wide screens. To edit font options go to Appearance>Theme Options.', 'vinelace');
}

require_once('wp-updates-theme.php');
new WPUpdatesThemeUpdater_1412( 'http://wp-updates.com/api/2/theme', basename( get_template_directory() ) );