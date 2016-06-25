<?php
/**
 * Index Page
 *
 * @package solstice
 * @since 1.0
 */
switch (solstice_get_opt('general-home-layout')) {
  case 'list':
    $layout = 'list';
    break;

  case 'grid':
    $layout = 'grid';
    break;

  default:
    $layout = 'list';
    break;
}
get_header();
get_template_part('page-templates/blog-'.$layout);
get_footer();
