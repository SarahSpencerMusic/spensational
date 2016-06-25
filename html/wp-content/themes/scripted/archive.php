<?php get_header(); ?>

<main class="clearfix" id="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
	<div class="wrap clearfix">

		<header class="entry-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
			<?php
                the_archive_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
                the_archive_description( '<div class="taxonomy-description">', '</div>' );
            ?>
		</header>

		<hr />

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<!-- Article -->
			<article <?php post_class( 'clearfix' ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

				<?php 
					$format = get_post_format(); 
					get_template_part( 'content', $format );
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

		<?php endif; ?>

	</div>
</main>
			
<?php get_footer(); ?>
