<?php
/**
 * The template used for displaying about page content
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Page thumbnail and title.
		the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->' );
		vinelace_post_thumbnail();
	?>

	<div class="entry-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'vinelace' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );

			edit_post_link( __( 'Edit', 'vinelace' ), '<span class="edit-link">', '</span>' );
		?>
	</div><!-- .entry-content -->
    
<div class="about-page-icons">
	<?php dynamic_sidebar( 'about' ); ?>
</div>
</article><!-- #post-## -->