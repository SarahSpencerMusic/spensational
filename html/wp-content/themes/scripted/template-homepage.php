<?php /* Template Name: Homepage */ ?>

<?php get_header(); ?>

<main id="content" role="main" itemprop="mainContentOfPage">

    
	<!-- Heading -->
	<?php if( get_theme_mod( 'homepage_heading_setting' ) || get_theme_mod( 'sub_heading_setting' )  ): ?>
    <section id="header-meta" class="wrap clearfix">
	<?php if ( get_theme_mod( 'homepage_heading_setting' ) ) { ?>
		<h1 class="entry-title"><?php echo esc_attr( get_theme_mod('homepage_heading_setting' ) ); ?></h1>
	<?php } if ( get_theme_mod( 'sub_heading_setting' ) ) { ?>
		<div class="entry-excerpt"><?php echo esc_attr( get_theme_mod( 'sub_heading_setting' ) ); ?></div>
	<?php } if ( get_theme_mod( 'button_link_setting' ) ) { ?>
		<a href="<?php echo esc_url( get_theme_mod( 'button_link_setting') ); ?>" title="<?php echo esc_attr( get_theme_mod( 'button_text_setting' ) ); ?>" class="more"><?php echo esc_attr( get_theme_mod( 'button_text_setting' ) ); ?></a>
	<?php } ?>
	</section>
    <?php endif; ?>
    
   	
    <!--Portfolio-->
    <?php
        $scripted_slider_show_hide = get_theme_mod('slider_show_hide_option_setting','0');
        if($scripted_slider_show_hide != '1'): 
            $scripted_slider_cat = get_theme_mod('homepage_slider_category');
            if($scripted_slider_cat !='0'):
        ?>
    	<section id="portfolio" class="clearfix">
    		<?php
                $loop = new WP_Query( 'cat='.$scripted_slider_cat.'&posts_per_page=4' );
             ?>
    
    		<?php if ( $loop->have_posts() ) : ?>
    
    		<div class="flexslider">
    			<div class="slider-nav clearfix"></div>
    			<ul class="slides">
    
    			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
    
    				<li class="slide">
    				<?php if ( has_post_thumbnail() ) : ?>
    					<a href="<?php the_permalink(); ?>" rel="bookmark">
    						<?php the_post_thumbnail( 'l' ); ?>
    					</a>
    				<?php endif; ?>
    				</li>
    
    			<?php endwhile; ?>
    
    			</ul>
    		</div>
    
    		<?php wp_reset_postdata(); ?>
    
    		<?php endif; ?>
    
    	</section>
        <?php
         endif;
     endif; ?>


	<!--Text Columns-->
    <?php if( get_theme_mod( 'left_column_heading_setting' ) || get_theme_mod( 'center_column_heading_setting' )|| get_theme_mod( 'right_column_heading_setting' )  ): ?>
	<section id="columns">
		<div class="wrap clearfix">
		<?php if ( get_theme_mod( 'left_column_heading_setting' ) || get_theme_mod( 'left_column_heading_text_setting' ) ) : ?>

			<div class="column">
			<?php if ( get_theme_mod( 'left_column_heading_setting' ) ) : ?>
				<h2><?php echo esc_attr( get_theme_mod( 'left_column_heading_setting' ) ); ?></h2>
			<?php endif; ?>
				<?php 
                    $scripted_left_column_text = get_theme_mod( 'left_column_heading_text_setting' );
                             echo wp_kses( $scripted_left_column_text, array(
                                'p' => array(),
                                'a' => array(
                                        'href' => array(),
                                        'class' => array()
                                    )
                            ) );
                    ?>
            </div>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'center_column_heading_setting' ) || get_theme_mod( 'center_column_heading_text_setting' ) ) : ?>

			<div class="column">
			<?php if ( get_theme_mod( 'center_column_heading_setting' ) ) : ?>
				<h2><?php echo esc_attr( get_theme_mod( 'center_column_heading_setting' ) ); ?></h2>
			<?php endif; ?>
				<?php
                    $scripted_center_column_text = get_theme_mod( 'center_column_heading_text_setting' );
                             echo wp_kses( $scripted_center_column_text, array(
                                'p' => array(),
                                'a' => array(
                                        'href' => array(),
                                        'class' => array()
                                    )
                            ) );                
                ?>
            </div>

		<?php endif; ?>

		<?php if ( get_theme_mod( 'right_column_heading_setting' ) || get_theme_mod( 'right_column_heading_text_setting' ) ) : ?>

			<div class="column last">
			<?php if ( get_theme_mod( 'right_column_heading_setting' ) ) : ?>
				<h2><?php echo esc_attr( get_theme_mod( 'right_column_heading_setting' ) ); ?></h2>
			<?php endif; ?>
				<?php
                    $scripted_right_column_text = get_theme_mod( 'right_column_heading_text_setting' );
                             echo wp_kses( $scripted_right_column_text, array(
                                'p' => array(),
                                'a' => array(
                                        'href' => array(),
                                        'class' => array()
                                    )
                            ) );
                
                 ?>
            </div>

		<?php endif; ?>

		</div>
	</section>
    <?php endif; ?>

	<!--Blog Posts-->
	<section id="blog" class="wrap clearfix">

		<?php $scripted_post_count = wp_count_posts()->publish; ?>

		<div class="blog-post<?php if ( $scripted_post_count == 1 ) { echo " blog-post-single"; } ?>">
			<?php global $more; $more = 0; ?>
			<?php
				$scripted_blog_args = array(
					'posts_per_page' => 1,
					'post__not_in' => get_option( 'sticky_posts' ),
				);
				$scripted_blog_post = new WP_Query( $scripted_blog_args );
			?>
			<?php while ( $scripted_blog_post->have_posts() ) : $scripted_blog_post->the_post() ?>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<p class="entry-meta">
					<?php echo get_the_date(); ?> <span>&mdash;</span> <a href="<?php the_permalink(); ?>#comments" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s comments', 'scripted' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php comments_number( __( 'No Comments', 'scripted' ), __( '1 Comment', 'scripted' ), __( '% Comments', 'scripted' ) ); ?></a>
				</p>
				<div class="entry-excerpt">
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark" class="more"><?php _e( 'Continue Reading', 'scripted' ); ?></a>
				</div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>

		<div class="blog-posts">
			<ul>
				<?php
					$scripted_blog_args = array(
						'posts_per_page' 	=> 3,
						'orderby'          => 'post_date',
						'order'            => 'ASC',
						'offset'			=> 1
					);
					$scripted_blog_post = new WP_Query( $scripted_blog_args );
				?>
				<?php while ( $scripted_blog_post->have_posts() ) : $scripted_blog_post->the_post() ?>
					<li>
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<p class="entry-meta">
							<?php echo get_the_date(); ?> <span>&mdash;</span> <a href="<?php the_permalink(); ?>#comments" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s comments', 'scripted' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php comments_number( __( 'No Comments', 'scripted' ), __( '1 Comment', 'scripted' ), __( '% Comments', 'scripted' ) );?></a>
						</p>
					</li>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</ul>
		</div>

	</section>


</main>
			
<?php get_footer(); ?>
