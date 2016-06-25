<?php get_header(); ?>

	<main id="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
		<div class="wrap clearfix">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<!-- Article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
				<?php 
					$format = get_post_format(); 
					get_template_part( 'content', $format );
				?>
			</article>

			<!-- Article Nav -->
			<?php scripted_article_nav(); ?>

			<!-- Author -->
			<section id="author-bio" class="clearfix" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
				<?php echo get_avatar( get_the_author_meta( 'email' ), '90', get_the_author() ); ?>
				<h2 class="author-name" itemprop="name">
					<?php the_author_posts_link(); ?>
				</h2>
				<p class="author-description" itemprop="description">
					<?php the_author_meta( 'description' ); ?>
				</p>
			</section>

			<!-- Comments -->
			<?php comments_template(); ?>

		<?php endwhile; endif; ?>
	
		</div>
	</main>
			
<?php get_footer(); ?>
