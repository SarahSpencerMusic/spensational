<?php

/* ----------------------------------------------------------------

 TABLE OF CONTENTS
 
	 1. LOCALIZATION
	 2. CONTENT WIDTH
	 3. THEME SETUP
	 4. REGISTER SIDEBAR
	 5. ENQUEUE SCRIPTS
	 6. EXCLUDE FROM SEARCH
	 7. COMMENTS
	 8. MORE LINK
	 9. IS BLOG
	10. POST FORMAT: GALLERY
	11. CONTACT FORM
	12. NEXT/PREV POST NAV
	13. INIT
   
-----------------------------------------------------------------*/


/* ----------------------------------------------------------------
   1. LOCALIZATION
-----------------------------------------------------------------*/

function scripted_localization() {
	load_theme_textdomain( 'scripted', get_template_directory() . '/languages' );
}

add_action( 'after_setup_theme', 'scripted_localization' );


/* ----------------------------------------------------------------
   2. CONTENT WIDTH
-----------------------------------------------------------------*/

if ( !isset( $content_width ) )
	$content_width = 920;


/* ----------------------------------------------------------------
   3. THEME SETUP
-----------------------------------------------------------------*/

if ( !function_exists( 'scripted_theme_setup' ) ) {
    function scripted_theme_setup() {
        
    	/* Register WP3+ menus */
 		register_nav_menu( 'header-menu', __( 'Header Menu', 'scripted' ) );
        register_nav_menu( 'footer-menu', __( 'Footer Menu', 'scripted' ) );
   	
    	/* Configure WP 2.9+ thumbnails */
    	add_theme_support( 'post-thumbnails' );
    	
        add_image_size( 'scripted_s', 430, 300, true );
        add_image_size( 'scripted_l', 920, '', true );
        add_image_size( 'scripted_page_img', 530, 300 ,true);
        
        add_theme_support( 
            'post-formats', 
            array(
                'gallery',
                'link',
                'quote',
                'video',
                'audio'
            ) 
        );     

		add_post_type_support( 'page', 'excerpt' );
        
        add_theme_support('automatic-feed-links');
        
        // to support title tag
        add_theme_support( 'title-tag' );
        
        // to support wordpress plugin
        add_theme_support( 'woocommerce' );   
     
    }
}

add_action( 'after_setup_theme', 'scripted_theme_setup' );


/* ----------------------------------------------------------------
   4. REGISTER SIDEBAR
-----------------------------------------------------------------*/
add_action( 'widgets_init', 'scripted_register_sidebars' );

function scripted_register_sidebars() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'scripted' ),
		'id' => 'sidebar',
        'description' => __( 'Widgets placed here will display in the bottom of the page when user click top right icon in header', 'scripted' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
}


/* ----------------------------------------------------------------
   5. ENQUEUE SCRIPTS
-----------------------------------------------------------------*/

if ( !function_exists( 'scripted_enqueue_scripts' ) ) {
	function scripted_enqueue_scripts() {
	    
		/* Register */
		wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', '2.6.2' );
		wp_register_script( 'classie', get_template_directory_uri() . '/js/classie.js', '1.0.1', TRUE );
        wp_register_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', 'jquery', '2.2.0' );
		wp_register_script( 'slicknav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', 'jquery', '4.4' );
        wp_register_script( 'scripted-custom', get_template_directory_uri() . '/js/jquery.custom.js', 'jquery', '1.0', TRUE );
        
		/* Enqueue */
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'modernizr' );
		wp_enqueue_script( 'classie' );
        wp_enqueue_script( 'flexslider' );
		wp_enqueue_script( 'slicknav' );
		wp_enqueue_script( 'scripted-custom' );
		
		if ( is_singular( 'post' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
				
		/* SSL */
		$protocol = is_ssl() ? 'https' : 'http';
		
		wp_enqueue_style( 'scripted-googlefont-gentium', $protocol . '://fonts.googleapis.com/css?family=Gentium+Basic:700,400italic,400' );
		wp_enqueue_style( 'scripted-style', get_stylesheet_uri(), FALSE, '1.0' );

		wp_enqueue_style('font-awesome', get_template_directory_uri() . '/includes/font-awesome/css/font-awesome.css',array(), '4.6.1');
        //wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', FALSE, '4.5.1' );
        wp_enqueue_style( 'slicknav', get_template_directory_uri() . '/css/slicknav.css', FALSE, '4.4' );
		wp_enqueue_style( 'scripted-responsive', get_template_directory_uri() . '/css/responsive.css', FALSE, '1.0' );

    }
}

add_action( 'wp_enqueue_scripts', 'scripted_enqueue_scripts' );


/* Enqueue Admin Scripts */

if ( !function_exists( 'scripted_enqueue_admin_scripts' ) ) {
    
    function scripted_enqueue_admin_scripts( $hook ) {
        
        if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
            wp_register_script( 'scripted-admin-script', get_template_directory_uri() . '/includes/js/jquery.custom.admin.js', 'jquery' );
            wp_enqueue_script( 'scripted-admin-script' );
        }

    }
}

add_action( 'admin_enqueue_scripts', 'scripted_enqueue_admin_scripts' );


/* ----------------------------------------------------------------
   7. COMMENTS
-----------------------------------------------------------------*/

if ( !function_exists( 'scripted_comment' ) ) {

	function scripted_comment( $comment, $args, $depth ) {
	
        $GLOBALS['comment'] = $comment; ?>
        
        <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	        <article class="clearfix" itemprop="comment" itemscope="itemscope" itemtype="http://schema.org/UserComments">
				<?php echo get_avatar( $comment, 75 ); ?>
		        <div class="comment-author">
					<p class="vcard" itemprop="creator" itemscope="itemscope" itemtype="http://schema.org/Person">
						<cite class="fn" itemprop="name"><?php comment_author_link(); ?></cite>
						<time itemprop="commentTime" datetime="<?php comment_time( 'c' ); ?>">
							<?php comment_date( 'F dS, Y' ); ?>
						</time>
			            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
			            <?php edit_comment_link( __( 'Edit', 'scripted'), ' &middot; ', '' ) ?>
					</p>
		        </div>
				<div class="comment-content" itemprop="commentText">
		            <?php comment_text() ?>
		            <?php if ( $comment->comment_approved == '0' ) : ?>
		                <p><em class="awaiting"><?php _e( 'Your comment is awaiting moderation.', 'scripted' ) ?></em></p>
		            <?php endif; ?>
				</div>
	        </article>
		</li>

<?php }
}


/* ----------------------------------------------------------------
   8. MORE LINK
-----------------------------------------------------------------*/

function scripted_more_link( $more_link, $more_link_text ) {
	return str_replace( $more_link_text, __( 'Continue Reading', 'scripted' ), $more_link );
}

add_filter( 'the_content_more_link', 'scripted_more_link', 10, 2 );



/* ----------------------------------------------------------------
   10. POST FORMAT: GALLERY
-----------------------------------------------------------------*/
	
function scripted_gallery( $post_id ) {

	global $post;
	$images = get_children( array( 'post_parent' => $post_id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) );

	if ( $images ) :

		foreach ( $images as $attachment_id => $image ) :

			$img_alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
			if ( $img_alt == '' ) : $img_alt = $image->post_title;
			endif;

			$array = image_downsize( $image->ID, 'scripted_l' );
			$img_url = $array[0];
			?>

			<li>
				<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" />
			</li>

			<?php

	endforeach;
	endif;
}


/* ----------------------------------------------------------------
   12. NEXT/PREV POST NAV
-----------------------------------------------------------------*/

if ( ! function_exists( 'scripted_article_nav' ) ) :

	function scripted_article_nav() {

		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		
		<nav id="article-nav" class="clearfix" role="navigation">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr; &nbsp;Previous Post</span> %title', 'Previous post link', 'scripted' ) );
				next_post_link( '<div class="nav-next">%link</div>', _x( '<span class="meta-nav">Next Post&nbsp; &rarr;</span> %title', 'Next post link', 'scripted' ) );
			?>
		</nav>
		
		<?php
	}

endif;

/* ----------------------------------------------------------------
   13. INIT
-----------------------------------------------------------------*/
/**
 * Load category dropdown
 */
require get_template_directory() . '/includes/category-dropdown.php';


/**
 * Load customizer
 */
require get_template_directory() . '/includes/customizer.php';


/**
 * Load Widgets fields 
 */
 require get_template_directory() . '/includes/widgets/widget-load.php';