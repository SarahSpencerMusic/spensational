<?php
/**
 * The Sidebar containing the main widget area
 *
 */
?>
<div id="content-sidebar" class="content-sidebar widget-area" role="complementary">
	<?php	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('sidebar') ) ?>
</div><!-- #content-sidebar -->