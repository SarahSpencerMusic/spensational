<?php
if ( function_exists('danny_require_file') )
{
    // Load Classes
    danny_require_file( DANNY_CORE_CLASSES . 'class-tgm-plugin-activation.php' );
    danny_require_file( DANNY_CORE_CLASSES . 'wp_bootstrap_navwalker.php' );
    danny_require_file( DANNY_CORE_CLASSES . 'like-post/danny-like-post.php' );
    
    // Load Functions
    danny_require_file( DANNY_CORE_FUNCTIONS . 'customizer/danny_custom_controll.php' );
    danny_require_file( DANNY_CORE_FUNCTIONS . 'customizer/danny_customizer_settings.php' );
    danny_require_file( DANNY_CORE_FUNCTIONS . 'customizer/danny_customizer_style.php' );
    danny_require_file( DANNY_CORE_FUNCTIONS . 'danny_resize_image.php' );
    
    // Load Widgets
    danny_require_file( DANNY_CORE_WIDGETS . 'danny_about_widget.php' );
    danny_require_file( DANNY_CORE_WIDGETS . 'danny_latest_posts_widget.php' );
    danny_require_file( DANNY_CORE_WIDGETS . 'danny_social_widget.php' );
}