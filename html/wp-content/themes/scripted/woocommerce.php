<?php
/**
 * Description: A page template with the right column for WooCommerce
 * @package scripted
 * @since 1.0.0
 */
get_header(); ?>
<section id="blog" class="wrap clearfix">
            <?php
            	do_action('woocommerce_choose_layouts');
            ?>
</section>
<?php get_footer(); ?>