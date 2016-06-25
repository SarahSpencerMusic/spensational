<?php
/**
 * Recent Posts Widget
 *
 * @package nudgemediadesign
 * @since nudgemediadesign 1.0
 */

add_action( 'widgets_init', 'recent_posts_widget' );

function recent_posts_widget() {
	register_widget( 'nudgemediadesign_recent_post_widget' );
}

class nudgemediadesign_recent_post_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function nudgemediadesign_recent_post_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'nudgemediadesign_recent_posts', 'description' => __('Displays your most recent posts.', 'nudgemediadesign') );
		
		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'nudgemediadesign_recent_posts' );
		
		/* Create the widget. */
		$this->WP_Widget( 'nudgemediadesign_recent_posts', __(' NMD Recent Posts', 'nudgemediadesign'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget($args, $instance) {
		$cache = wp_cache_get('widget_recent_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'nudgemediadesign') : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 3;

		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( '' != $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li>
            <div class="latest-item">
            <div class="latest-image">
            <?php 
		if ( has_post_thumbnail() ) { 
			the_post_thumbnail( array(80, 65) );
} 
?>
</div>
<div class="latest-item-text">
                <h4><a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a><h4>
				<span class="post_date">
                    <span class="post_date_month"><?php echo get_the_time('F'); ?></span>
                    <span class="post_date_day"><?php echo get_the_time('j,'); ?></span>
                    <span class="post_date_year"><?php echo get_the_time('Y'); ?></span>
                </span>
                </div>
            </li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_recent_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) )
			delete_option('widget_recent_entries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_posts', 'widget');
	}

	function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'nudgemediadesign' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'nudgemediadesign' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}

?>