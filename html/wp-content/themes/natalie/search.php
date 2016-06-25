<?php
    get_header();    
    $danny_archive_layout = get_theme_mod('danny_archive_layout', true);
    $danny_disable_archive_sidebar = get_theme_mod('danny_disable_archive_sidebar', true);
    if ( $danny_disable_archive_sidebar ) {
        $danny_col_md = 12;
    } else {
        $danny_col_md = 9;
    }
?>
<div class="container">
    <div class="archive-box">
		<span><?php esc_html_e( 'Search results for', 'natalie' ); ?>:&nbsp;</span>
		<h3><?php printf( __( '%s', 'natalie' ), get_search_query() ); ?></h3>
	</div>
    <div class="row">
        <div class="col-md-9">
        <?php if ( have_posts() ) : global $danny_like_post; ?>
            <?php while ( have_posts() ) : the_post(); ?>
            <?php
                $sticky_class = ( is_sticky() ) ? 'is_sticky' : null;
                $pin_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
            ?>
            <article <?php post_class("post {$sticky_class}"); ?>>
                <?php get_template_part('template-parts/post', 'format'); ?>
                <div class="post-content">
                    <p class="post-cats"><?php the_category(", "); ?></p>                   
                    <?php if ( get_the_title() ) : ?>
                    <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <?php endif; ?>
                    <div class="post-meta">
                        <a href="<?php echo get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ); ?> "><?php the_time(get_option('date_format')); ?></a>
        				<a class="social-icon" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i></a>
                        <a class="social-icon" target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php echo danny_url_encode( get_the_title() ); ?>%20-%20<?php echo urlencode(the_permalink()); ?>"><i class="fa fa-twitter"></i></a>
                        <a class="social-icon" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url($pin_image); ?>&description=<?php the_title(); ?>"><i class="fa fa-pinterest"></i></a>
                        <a class="social-icon" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a></i></a>
                    </div>
                    <div class="post-except">
                        <?php danny_the_excerpt_max_charlength(350); ?>
                    </div>
                    <p class="readmore">
                        <a href="<?php the_permalink(); ?>" class="link-more">Read more</a>
                    </p>
                </div>
            </article>
            <?php endwhile; ?>
            <?php danny_pagination(); ?>
        <?php else: ?>
            <?php get_template_part('template-parts/post', 'none'); ?>
        <?php endif; ?>
        </div>
        <div class="col-md-3 sidebar"><?php get_sidebar(); ?></div>
    </div>
</div>
<?php get_footer(); ?>