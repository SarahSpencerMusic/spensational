<?php get_header(); ?>

<main class="clearfix" id="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
	<div class="wrap clearfix">

		<header class="entry-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
			<h1 class="entry-title" itemprop="headline"><?php _e( 'Search', 'scripted' ) ?>: '<?php the_search_query(); ?>'</h1>
		</header>

		<hr />

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<!-- Article -->
			<article <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

				<?php 
					$scripted_format = get_post_format(); 
					get_template_part( 'content', $scripted_format );
				?>

			</article>

		<?php endwhile; ?>

			<?php if ( $wp_query->max_num_pages > 1 ) : ?>

				<!--Pagination-->
		        <ul class="pagination clearfix">
			        <li class="prev"><?php next_posts_link( __( 'Older Posts', 'scripted' ) ); ?></li>
			        <li class="next"><?php previous_posts_link( __( 'Newer Posts', 'scripted' ) ); ?></li>
		        </ul>

			<?php endif; ?>

		<?php else : ?>

			<?php _e( 'Your search did not match any entries', 'scripted' ) ?>

		<?php endif; ?>

	</div>
</main>
				
<?php get_footer(); ?>
