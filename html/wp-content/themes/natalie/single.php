<?php get_header(); global $post, $danny_like_post;?> 
<div class="container">
    <div class="row">
        <div class="col-md-9">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php $sticky_class = ( is_sticky() ) ? 'az-post-sticky' : null; ?>
            <div <?php post_class("post {$sticky_class} single-post-content"); ?>>
                <div class="post-inner">
                    <?php get_template_part( 'template-parts/post', 'format' ); ?>
                    
                    <div class="post-content">
                        <div class="post-cats"><?php the_category(", "); ?></div>
                        <?php if ( get_the_title() ) : ?>
                        <h4 class="post-title"><?php the_title(); ?></h4>
                        <?php endif; ?>
                        <div class="post-excerpt"><?php the_content(); ?></div>
                        <?php if ( get_the_tags() ) : ?>
                        <div class="az-post-tags">
                            <?php the_tags('',' '); ?>
                        </div>
                        <?php endif; ?>
                        <div class="post-footer single-post-footer">
                            <div class="post-time pull-left"><a href="<?php echo get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ); ?>"><?php the_time(get_option('date_format')); ?></a></div>
                            <?php $pin_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>
                            <div class="social-share share-buttons">
                                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i></a>
                                <a target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php echo danny_url_encode( get_the_title() ); ?>%20-%20<?php echo urlencode(the_permalink()); ?>"><i class="fa fa-twitter"></i></a>                    			
                                <a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url($pin_image); ?>&description=<?php the_title(); ?>"><i class="fa fa-pinterest"></i></a>
                                <a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a>
                            </div>
                            <div class="post-like pull-right"><?php echo wp_kses_post($danny_like_post->add_love()); ?></div>
                        </div>
                        <!--Previous/Next-Post-->
                        <div class="az-pagination">
                            <div class="row">
                                <div class="older col-xs-6 col-md-6"><?php previous_post_link('%link', 'Previous Post'); ?></div>
                                <div class="newer col-xs-6 col-md-6"><?php next_post_link('%link', 'Next Post'); ?></div>
                            </div>
                    	</div>
                        <!--.Previous/Next-Post-->
                        <?php get_template_part( 'template-parts/single', 'post-author' ); ?>
                        <?php comments_template( '', true );  ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
        <div class="col-md-3 sidebar"><?php get_sidebar(); ?></div>
    </div>
</div>
<?php get_footer(); ?>