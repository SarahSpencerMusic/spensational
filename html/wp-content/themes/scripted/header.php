<!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<!-- A Scripted WordPress Theme, http://styledthemes.com/ -->

	<head>

		<!-- Meta -->
		<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
		<!-- Hooks -->
		<?php wp_head(); ?>
		    
	</head>


	<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">

	    <header id="header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
		    <div class="wrap clearfix">
				<!-- Logo -->
				<div class="logo" itemprop="headline">
				<?php if ( (get_theme_mod( 'custom_logo_scripted_setting' ) ) && ( get_theme_mod( 'header_text_logo_setting' ) == 0 ) ){  ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" class="custom">
                        <img src="<?php  echo esc_attr( get_theme_mod('custom_logo_scripted_setting' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
                    </a>
				<?php }else{ ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" class="plain"><?php bloginfo( 'name' ); ?></a>
				<?php } ?>
				</div>

			    <!-- Navigation -->
			    <nav role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
					<?php if( has_nav_menu( 'header-menu' ) ) : ?>
					
					    <?php
						    wp_nav_menu(
							    array(
								    'theme_location' => 'header-menu',
								    'container'      => false,
								    'menu_id'        => 'nav',
								    'menu_class'     => 'header-menu',
								    'depth'          => '4'
							    )
						    );
					    ?>
					<?php else : ?>
					
					<ul id="nav">
						<?php wp_list_pages( 'title_li=&depth=1' ); ?>
					</ul>
					
					<?php endif; ?>
				</nav>

			    <!-- Sidebar Toggle -->
                <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
				 <!-- Sidebar Toggle -->
				<div id="toggle">
					<i class="<?php  echo get_theme_mod('header_right_top_setting','fa fa-bars'); ?>"></i>
				</div>
                <?php endif; ?>
			
			</div>
		</header>
