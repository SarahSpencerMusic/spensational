<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div id="wrapper">
        <div id="site-name" class="container">
            <?php if(!get_theme_mod('danny_logo')) : ?>
                <?php if(is_front_page()) : ?>
                    <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() .'/assets/images/logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a></h1>
                <?php else : ?>
                    <h2><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() .'/assets/images/logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a></h2>
                <?php endif; ?>
            <?php else : ?>
                <?php if(is_front_page()) : ?>
                    <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url(get_theme_mod('danny_logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a></h1>
                <?php else : ?>
                    <h2><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url(get_theme_mod('danny_logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a></h2>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div id="nav-wrapper">
            <div class="container">                
                <a href="javascript:void(0)" class="togole-mainmenu"><i class="fa fa-bars"></i></a>
                <?php
                    wp_nav_menu( array (
                        'container' => false,
                        'theme_location' => 'primary',
                        'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                        'depth' => 10,
                        'walker' => new wp_bootstrap_navwalker(),
                        'menu_class' => 'azmenu'
                    ) );
                ?>          
            </div>
        </div>
        <?php if( is_front_page() ) : ?>
        <?php get_template_part('template-parts/featured', 'slider'); ?>
         <?php endif; ?>