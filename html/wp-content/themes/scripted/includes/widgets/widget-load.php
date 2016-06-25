<?php 

/**
 * Theme Widget positions
 * @package scripted
 * @since 1.0.0
 */

 
/**
 * Registers our main widget area and the front page widget areas.
 */
 
function scripted_widgets_init() {
    register_sidebar( array(
		'name' => __( 'Right Sidebar', 'scripted' ),
		'id' => 'scripted_right_sidebar',
		'description' => __( 'Widgets placed here will display in the sidebar on sidebar template page.', 'scripted' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
    

    if ( class_exists( 'WooCommerce' ) ) {
     register_sidebar( array(
		'name' => __( 'Shop Sidebar', 'scripted' ),
		'id' => 'scripted_shop_right_sidebar',
		'description' => __( 'Widgets placed here will display in the sidebar on Shop page.', 'scripted' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));  
    }
    
 }
 add_action( 'widgets_init', 'scripted_widgets_init' );