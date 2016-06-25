<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Scripted
 */

if ( ! is_active_sidebar( 'scripted_right_sidebar' ) ) {
	return;
}
?>
	<?php dynamic_sidebar( 'scripted_right_sidebar' ); ?>