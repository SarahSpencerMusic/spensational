<?php
global $danny_like_post;
$pin_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>
<div class="post-meta">
    <div class="post-meta-container">
        <?php if ( !is_page() ) : ?>
        <time><a href="<?php echo get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ); ?> "><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php the_time(get_option('date_format')); ?></a></time>
        <?php endif; ?>
       <?php if ( is_single() ) : ?>
        <span class="post-share">
            <a class="social-icon" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i></a>
            <a class="social-icon" target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php echo danny_url_encode( get_the_title() ); ?>%20-%20<?php echo urlencode(the_permalink()); ?>"><i class="fa fa-twitter"></i></a>
            <a class="social-icon" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url($pin_image); ?>&description=<?php the_title(); ?>"><i class="fa fa-pinterest"></i></a>
            <a class="social-icon" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a></i></a>
        </span>
        <?php endif; ?>
        <?php if ( !is_page() ) : ?>
        <span class="post-likes"><?php echo wp_kses_post($danny_like_post->add_love()); ?></span>
        <?php endif; ?>
    </div>
</div>