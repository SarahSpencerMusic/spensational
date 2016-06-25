
    <?php
		$featured_cat = get_theme_mod( 'danny_featured_cat' );
		$get_featured_posts = get_theme_mod('danny_featured_id');
		$number = get_theme_mod( 'danny_featured_slider_slides' );
		
		if($get_featured_posts) {
			$featured_posts = explode(',', $get_featured_posts);
			$args = array( 'showposts' => $number, 'post_type' => array('post', 'page'), 'post__in' => $featured_posts, 'orderby' => 'post__in' );
		} else {
			$args = array( 'cat' => $featured_cat, 'showposts' => $number );
		}				
	?>			
	<?php $feat_query = new WP_Query( $args ); ?>		
	<?php if ($feat_query->have_posts()) : ?>
        <div class="featured-area container">
    	   <div class="slider">
            <?php while ($feat_query->have_posts()) :
                $feat_query->the_post();
                $image_featured = danny_resize_image( get_post_thumbnail_id($post->ID) , wp_get_attachment_thumb_url(), 1170, 500, true, true );
                $image_featured = $image_featured['url']; ?>
            <div class="slide-item post" style="background-image: url(<?php echo esc_url($image_featured); ?>);">
                <div class="slide-item-text">
        			<div class="post-text-inner">
                        <p class="post-cats"><?php the_category(', '); ?></p>
            			<h4 class="post-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <div class="post-meta">
                            <a href="<?php echo get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ); ?> "><?php the_time(get_option('date_format')); ?></a>
            				<a class="social-icon" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i></a>
                            <a class="social-icon" target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php echo danny_url_encode( get_the_title() ); ?>%20-%20<?php echo urlencode(the_permalink()); ?>"><i class="fa fa-twitter"></i></a>
                            <a class="social-icon" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url($pin_image); ?>&description=<?php the_title(); ?>"><i class="fa fa-pinterest"></i></a>
                            <a class="social-icon" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a></i></a>
                        </div>
                        <div class="post-excerpt">
                            <?php danny_the_excerpt_max_charlength(150); ?>
                        </div>
                    </div>
        		</div>
            </div>		
       	    <?php endwhile; ?>
        </div>
    </div>
<?php endif; ?>