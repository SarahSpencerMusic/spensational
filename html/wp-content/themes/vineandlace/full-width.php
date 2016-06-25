<?php
/**
 * Template Name: Full Width
 *
 */

get_header(); ?>

<div id="main-content" class="main-content">
	<div id="primary" class="content-area-fullwidth">
		<div id="content" class="site-content-fullwidth" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'fullwidth' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_footer();