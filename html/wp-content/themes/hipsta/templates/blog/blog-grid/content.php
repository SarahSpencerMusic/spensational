<?php
/**
 * Blog Meta
 *
 * @package solstice
 * @since 1.0
 */
?>
<?php if(has_post_thumbnail()): ?>
  <figure>
    <?php the_post_thumbnail('solstice-medium-alt'); ?>
  </figure>
<?php endif; ?>
