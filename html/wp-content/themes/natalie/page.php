<?php get_header(); ?>
<div class="container">
    <?php
        if(have_posts()) :
            while(have_posts()) : the_post();
                $hide_share_buttons = get_post_meta($post->ID, '__page_custom_share_buttons', true);
            ?>
            <div class="row">
                <div class="col-md-12">
                    <article <?php post_class('post'); ?>>
                        <div class="post-content">
                            <h4 class="post-title page-title"><?php the_title(); ?></h4>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="az-page-thumbnail"><?php the_post_thumbnail('az-fullwidth'); ?></div>
                            <?php endif; ?>
                            <div class="post-excerpt">
                                <?php the_content(); ?>
                                <?php wp_link_pages(); ?>
                            </div>
                            <?php if ( $hide_share_buttons != 'yes' ) : ?>
                            <?php get_template_part('content-parts/post', 'meta'); ?>
                            <?php endif; ?>
                            <?php comments_template( '', true );  ?>
                        </div>
                    </article>
                </div>
            </div>
            <?php
            endwhile;
        endif;
    ?>
</div>
<?php get_footer(); ?>