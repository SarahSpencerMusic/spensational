<?php
// Customizer - Add CSS --------------------------------------------------------------------------------------------
add_action( 'wp_head', 'danny_customizer_css' );
function danny_customizer_css() {
    ?>
    <style type="text/css">
        <?php if ( get_theme_mod('danny_accent_color') ) : ?>
            
            a {
                color: <?php echo get_theme_mod('danny_accent_color'); ?>;
            }
            a:hover, a:focus {
                color: <?php echo get_theme_mod('danny_accent_color'); ?>;
            }
            #nav-wrapper .azmenu .current-menu-item > a, #nav-wrapper .azmenu a:hover, #nav-wrapper .sub-menu a:hover {
                color: <?php echo get_theme_mod('danny_accent_color'); ?>;
            }
            .post-cats > a {
                color: <?php echo get_theme_mod('danny_accent_color'); ?>;
            }
            .post a:hover {
                color: <?php echo get_theme_mod('danny_accent_color'); ?>;
            }
            .post .post-meta .socials li a:hover {
                color: <?php echo get_theme_mod('danny_accent_color'); ?>;
            }
            .post .link-more:hover {
                color: <?php echo get_theme_mod('danny_accent_color'); ?>;
            }
            .widget a:hover, .latest-post .post-item-text h4 a:hover, .widget_categories ul li a:hover {
                color: <?php echo get_theme_mod('danny_accent_color'); ?>;
            }
            
            .slider .owl-controls .owl-dot.active,
            .slider .owl-nav > div:hover,
            .single-post-footer .social-share a:hover, .social-widget > a:hover {
                background-color: <?php echo get_theme_mod('danny_accent_color'); ?>;
                color: #fff;
            }
            .widget_mc4wp_widget input[type="submit"]:hover {
                background-color: <?php echo get_theme_mod('danny_accent_color'); ?>;
                color: #fff;
            }
            
        <?php endif; ?>

        <?php if ( get_theme_mod('danny_custom_css') ) : ?>
            <?php echo get_theme_mod('danny_custom_css'); ?>
        <?php endif; ?>
    </style>
    <?php
}