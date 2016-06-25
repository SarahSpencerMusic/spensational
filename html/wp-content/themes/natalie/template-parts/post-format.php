<?php if ( has_post_format('gallery') ) : ?>
    <?php $images = get_post_meta( get_the_ID(), '_format_gallery_images', true ); ?>
    <?php if ( $images ) : ?>
    <div class="post-format post-gallery slider">
        <?php foreach ( $images as $image_id ) : ?>
            <?php                
                $image_url = danny_resize_image( $image_id, null, 1170, 780, true, true );
                $image_url = $image_url['url'];
                $imgage_caption = get_post_field( 'post_excerpt', $image_id );
            ?>
			<div class="slide-item"><img src="<?php echo esc_url($image_url); ?>" alt="" <?php if ($imgage_caption) : ?>title="<?php echo esc_attr($imgage_caption); ?>"<?php endif; ?> /></div>			
		<?php endforeach; ?>
    </div>
    <?php endif; ?>
<?php elseif ( has_post_format('video') ) : ?>
    <div class="post-format post-video">
        <?php $video = get_post_meta( get_the_ID(), '_format_video_embed', true ); ?>
        <?php if ( wp_oembed_get($video) ) : ?>
            <?php echo wp_oembed_get($video); ?>
        <?php else : ?>
            <?php echo wp_kses_post($video); ?>
        <?php endif; ?>
    </div>
<?php elseif ( has_post_format('audio') ) : ?>
    <div class="post-format post-audio">
        <?php $audio = get_post_meta( get_the_ID(), '_format_audio_embed', true ); ?>
        <?php if ( wp_oembed_get($audio) ) : ?>
            <?php echo wp_oembed_get($audio); ?>
        <?php else : ?>
            <?php echo wp_kses_post($audio); ?>
        <?php endif; ?>
    </div>
<?php else: ?>
    <?php if ( has_post_thumbnail() ) : ?>
    <div class="post-format post-standard">
        <?php if ( !is_single() ) : ?>
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('az-fullwidth'); ?></a>
        <?php else : ?>
            <?php the_post_thumbnail('az-fullwidth'); ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>
<?php endif; ?>