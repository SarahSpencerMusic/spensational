<?php
/**
 * The template for displaying posts in the Video post format
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && vinelace_categorized_blog() ) : ?>
		<?php
			endif;

			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
		?>

		<div class="entry-meta-date">
			<?php vinelace_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'vinelace' ) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'vinelace' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
	  ?>
     
            <?php if(is_single()) : ?>
			<?php get_template_part('inc/template/post_signature'); ?>
		<?php endif; ?>
        
      </div><!-- .entry-content -->
      
	<div class="entry-meta">
		<?php
			if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
		?>
		<span class="comments-link"><?php comments_popup_link( __( 'Comment', 'vinelace' ), __( '1 Comment', 'vinelace' ), __( '% Comments', 'vinelace' ) ); ?></span>
		<span class="cat-links"><?php echo the_category_exclude(", ","featured"); ?></span>
		<?php
			endif;

			edit_post_link( __( 'Edit', 'vinelace' ), '<span class="edit-link">', '</span>' );
		?>

<span class="social-button-wrap">
<span class="share-text">Share</span>
<span class="facebook-share"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" target="blank"></a></span>
<span class="twitter-share"><a href="http://twitter.com/home?status=Check out this post <?php the_permalink(); ?>" title="Twitter" target="_blank"></a></span>
<span class="pinterest-share"><a href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());'></a></span> 
<span class="google-share"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','gplusshare','width=600,height=400,left='+(screen.availWidth/2-225)+',top='+(screen.availHeight/2-150)+'');return false;"></a></span></span>
<div class="tag-links"><?php the_tags('', '', ''); ?></div>
</div>
  
<?php if(is_single()) : ?>
  <?php get_template_part('inc/template/related_posts'); ?>
<?php endif; ?>
</article><!-- #post-## -->