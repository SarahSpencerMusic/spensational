<?php /* Header Meta */ ?>

	<section id="header-meta" class="clearfix">
		<div class="wrap clearfix">

			<?php if ( is_archive() ) : ?>
            
				<?php the_archive_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );	?>
			
            <?php elseif ( is_search() ) : ?>
							
				<h1 class="entry-title"><?php _e( 'Search results for', 'scripted' ) ?>: '<?php the_search_query(); ?>'</h1>
			   				
			<?php elseif ( is_single() && !is_singular( 'portfolio' ) ) : 
								
				if ( $posts_page = get_post( get_option( 'page_for_posts' ) ) ) {
			 		the_archive_title( '<h1 class="entry-title">', '</h1>' );
                    the_archive_description( '<div class="entry-excerpt">', '</div>' );
					 }	?>
					 
			<?php else : ?>
								
				<h1 class="entry-title"><?php single_post_title(); ?></h1>
			
				<?php if ( !is_archive() && !is_search() && !is_404() ) :
				
					$page_id = get_queried_object_id(); ?>
					<div class="entry-excerpt"><?php echo get_post_field( 'post_excerpt', $page_id, 'display' ); ?></div>
				
				<?php endif;?>
		
			<?php endif; ?>
			
		</div>
	</section>