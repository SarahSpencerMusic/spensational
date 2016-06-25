<?php
/**
 * Blog Meta
 *
 * @package solstice
 * @since 1.0
 */
?>
<?php
  $gallery = solstice_get_post_opt('post-gallery');
  if(is_array($gallery) && !empty($gallery)): ?>
  <div class="blog-post-slider pf-gallery mb-0">
    <?php foreach ($gallery as $item): ?>
      <article class="blog-post">
        <header class="pt-0">
          <figure>
            <?php if (isset($item['attachment_id'])):
              echo wp_get_attachment_image( $item['attachment_id'], 'solstice-medium-alt', array('alt' => esc_attr($item['title'])) );
            endif; ?>
          </figure>
        </header>
      </article>
    <?php endforeach; ?>
    </div><!-- /slider -->
  <?php endif;
