<?php
/**
 * The template for displaying Post Format pages
 *
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

			<header class="archive-header">
				<h1 class="archive-title">
					<?php
						if ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'vinelace' );

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'vinelace' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'vinelace' );
							
						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Gallery', 'vinelace' );

						else :
							_e( 'Archives', 'vinelace' );

						endif;
					?>
				</h1>
			</header><!-- .archive-header -->

			<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

						get_template_part( 'content', get_post_format() );

					endwhile;
					// Previous/next page navigation.
					vinelace_paging_nav();

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>
		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();