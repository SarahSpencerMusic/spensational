<?php get_header(); ?>

	<main id="content" role="main" itemprop="mainContentOfPage">
		<div class="wrap clearfix">

		<?php while ( have_posts() ) : the_post(); ?>

			<!-- Article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> itemscope="itemscope" itemtype="http://schema.org/CreativeWork">

				<header class="entry-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">

					<h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>

					<?php if ( has_excerpt() ) : ?>
						<div class="entry-excerpt" itemprop="text">
							<?php the_excerpt(); ?>
						</div>
					<?php endif; ?>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="entry-image">
							<?php the_post_thumbnail( 'scripted_l' ); ?>
						</div>
					<?php endif; ?>
					
				</header>

				<div class="entry-content" itemprop="text">
					<?php the_content(); ?>
				</div>
				

			</article>
            
            <!-- Comments -->
            <?php comments_template(); ?>

		<?php endwhile; ?>

		</div>
	</main>
			
<?php get_footer(); ?>
