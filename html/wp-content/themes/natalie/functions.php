<?php
define('DANNY_LIBS_URI', get_template_directory_uri() . '/libs/');
define('DANNY_CORE_PATH', get_template_directory() . '/core/');
define('DANNY_CORE_URI', get_template_directory_uri() . '/core/');
define('DANNY_CORE_CLASSES', DANNY_CORE_PATH . 'classes/');
define('DANNY_CORE_FUNCTIONS', DANNY_CORE_PATH . 'functions/');
define('DANNY_CORE_WIDGETS', DANNY_CORE_PATH . 'widgets/');

// Set Content Width
if ( ! isset( $content_width ) ) { $content_width = 1170; }

// Theme setup
add_action('after_setup_theme', 'danny_setup');
function danny_setup()
{
    load_theme_textdomain( 'natalie', get_template_directory() . '/languages' );
	add_theme_support('title-tag');
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
	add_image_size('danny-fullwidth', 1170, 0, true);
	register_nav_menus(
        array(
            'primary' => esc_html__('Primary menu', 'natalie')
        )
    );
	add_theme_support('post-formats', array('image', 'video', 'audio', 'gallery'));
}

// Load Google fonts
function danny_google_fonts_url()
{
    $fonts_url = '';
    $Lato = _x( 'on', 'Lato font: on or off', 'natalie' );
    $Montserrat = _x( 'on', 'Roboto font: on or off', 'natalie' );
    $Dancing = _x( 'on', 'Dancing Script font: on or off', 'natalie' );    

    if ( 'off' !== $Dancing || 'off' !== $Montserrat || 'off' !== $Lato )
    {
        $font_families = array();

        if ('off' !== $Dancing) {
            $font_families[] = 'Dancing Script:700';
        }
        
        if ('off' !== $Montserrat) {
            $font_families[] = 'Montserrat:400,700';
        }
        
        if ('off' !== $Lato) {
            $font_families[] = 'Lato';
        }

        $query_args = array(
            'family' => urlencode(implode('|', $font_families )),
            'subset' => urlencode('latin,latin-ext')
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    }

    return esc_url_raw($fonts_url);
}

// Google fonts
function danny_enqueue_googlefonts() {
    wp_enqueue_style( 'danny-googlefonts', danny_google_fonts_url(), array(), null );
}
add_action('wp_enqueue_scripts', 'danny_enqueue_googlefonts');

// Register & Enqueue Styles / Scripts
add_action('wp_enqueue_scripts', 'danny_load_scripts');
function danny_load_scripts()
{
    // CSS
    wp_enqueue_style('bootstrap', DANNY_LIBS_URI . 'bootstrap/css/bootstrap.min.css');
    wp_enqueue_style('font-awesome', DANNY_LIBS_URI . 'font-awesome/css/font-awesome.min.css');
    wp_enqueue_style('chosen-min', DANNY_LIBS_URI . 'chosen/chosen.min.css');
    wp_enqueue_style('owl-carousel', DANNY_LIBS_URI . 'owl/owl.carousel.css');
    wp_enqueue_style('danny-style', get_stylesheet_directory_uri() . '/style.css');

    // JS
	wp_enqueue_script('fitvids', DANNY_LIBS_URI . 'fitvids/fitvids.js', array(), false, true);
    wp_enqueue_script('owl-carousel', DANNY_LIBS_URI . 'owl/owl.carousel.min.js', array(), false, true);
    wp_enqueue_script('danny-masonry', DANNY_LIBS_URI . 'masonry/masonry.min.js', array(), false, true);
    wp_enqueue_script('chosen', DANNY_LIBS_URI . 'chosen/chosen.jquery.min.js', array(), false, true);
    wp_enqueue_script('danny-scripts', get_template_directory_uri() . '/assets/js/danny-scripts.js', array(), false, true);
    
    if ( is_singular() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script('comment-reply');
    }
}

// Author Social Links
add_filter( 'user_contactmethods', 'danny_author_social_links' );
function danny_author_social_links()
{
    $contactmethods              = array();
	$contactmethods['twitter']   = 'Twitter Username';
	$contactmethods['facebook']  = 'Facebook Username';
	$contactmethods['google']    = 'Google Plus Username';
	$contactmethods['tumblr']    = 'Tumblr Username';
	$contactmethods['instagram'] = 'Instagram Username';
	$contactmethods['pinterest'] = 'Pinterest Username';
	return $contactmethods;
}

// Display custom categories
function danny_display_custom_categories( $post_id, $limit = 5 )
{
    $cats = array(); $i = 0; $post_id = (int)$post_id;
    foreach( wp_get_post_categories($post_id) as $c )
    {
        $i++;
        if ( $i <= $limit )
        {
            $cat = get_category($c);
            array_push($cats, '<a href="'.(get_category_link($cat->term_id)).'">'.esc_html($cat->name).'</a>');
        }
        
        if ( $i == $limit + 1 ) {
            array_push($cats, '...');
        }
    }
    
    if ( sizeOf($cats) > 0 ) {
    	$post_categories = implode(', ',$cats);
    } else {
    	$post_categories = "Not Assigned";
    }
    
    return $post_categories;
}

// Register Sidebar
if ( function_exists('register_sidebar') )
{
	register_sidebar(array(
		'name'            => 'Sidebar',
		'id'              => 'sidebar',
		'before_widget'   => '<div id="%1$s" class="widget %2$s">',
		'after_widget'    => '</div>',
		'before_title'    => '<h4 class="widget-title">',
		'after_title'     => '</h4>'
	));
    register_sidebar(array(
		'name'            => 'Instagram Footer',
		'id'              => 'footer-sidebar',
		'before_widget'   => '<div id="%1$s" class="widget %2$s">',
		'after_widget'    => '</div>',
		'before_title'    => '<h4 class="widget-title"><span>',
		'after_title'     => '</span></h4>',
        'description'     => 'Use the "Instagram" widget here. IMPORTANT: For best result set number of photos to 8.',
	));
}

function danny_require_file( $path ) {
    if ( file_exists($path) ) {
        require $path;
    }
}

// Require core files
danny_require_file( get_template_directory() . '/core/init.php' );

// Comment Layout
function danny_custom_comment($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	} ?>
	<<?php echo esc_attr($tag); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
		<div class="comment-author">
		<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		</div>
		<div class="comment-content">
			<?php printf( __( '<h4 class="author-name">%s</h4>', 'natalie' ), get_comment_author_link() ); ?>
			<span class="date-comment">
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php printf( __('%1$s at %2$s', 'natalie'), get_comment_date(),  get_comment_time() ); ?></a>
			</span>
			<div class="reply">
				<?php edit_comment_link( esc_html__( '(Edit)', 'natalie' ), '  ', '' );?>
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'natalie' ); ?></em>
				<br />
			<?php endif; ?>
			<div class="comment-text"><?php comment_text(); ?></div>
		</div>	
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}

//Pagination
function danny_pagination()
{
    global $wp_query;
    if ( (int)$wp_query->found_posts > (int)get_option('posts_per_page') ) :
    ?>
    <div class="az-pagination">
        <div class="row">
            <div class="older col-xs-6 col-md-6"><?php next_posts_link('Older Posts'); ?></div>
            <div class="newer col-xs-6 col-md-6"><?php previous_posts_link('Newer Posts'); ?></div>
        </div>
	</div>
    <?php
    endif;
}

// The Excerpt
function danny_custom_excerpt_length($length) { return 1000; }
add_filter( 'excerpt_length', 'danny_custom_excerpt_length', 999 );

// Custom excerpt max charlength
function danny_the_excerpt_max_charlength($charlength)
{
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '&nbsp;...';
	} else {
		echo $excerpt;
	}
}

// Url Encode
function danny_url_encode($title)
{
    $title = html_entity_decode($title);
    $title = urlencode($title);
    return $title;
}

// Include the TGM_Plugin_Activation class
add_action('tgmpa_register', 'danny_register_required_plugins');
function danny_register_required_plugins()
{
	$plugins = array(
		array(
			'name'     				=> 'Vafpress Post Formats UI',
			'slug'     				=> 'vafpress-post-formats-ui-develop',
			'source'   				=> 'http://resources.az-theme.net/vafpress-post-formats-ui-develop.zip',
			'required' 				=> true,
			'version' 				=> '1.5',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> ''
		),
        array(
			'name'     				=> 'WP Instagram Widget',
			'slug'     				=> 'wp-instagram-widget',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> ''
		),
		array(
			'name'     				=> 'Contact Form 7',
			'slug'     				=> 'contact-form-7',
			'required' 				=> false,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> ''
		),
        array(
			'name'     				=> 'MailChimp for WordPress Lite',
			'slug'     				=> 'mailchimp-for-wp',
			'required' 				=> false,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> ''
		)
	);

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to out
	);
	tgmpa($plugins, $config);
}