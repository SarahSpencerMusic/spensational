<?php
class Danny_Widget_Latest_Posts_Widget extends WP_Widget
{
	function __construct()
    {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'danny_latest_posts_widget', 'description' => esc_html__('A widget that displays your latest posts from all categories or a certain', 'natalie') );
		/* Create the widget. */
		parent::__construct( 'danny_latest_posts_widget', esc_html__('Danny: Latest Posts', 'natalie'), $widget_ops );
	}

	function widget( $args, $instance )
    {
		extract( $args );
		$title        = apply_filters('widget_title', $instance['title'] );
		$categories   = $instance['categories'];
		$number       = $instance['number'];
		$query        = array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'cat' => $categories);		
		$loop         = new WP_Query($query);
		if ( $loop->have_posts() ) :
    		echo $before_widget;
    		if ( $title ) {
    		    echo $before_title . $title . $after_title;
    		} ?>
			<ul class="latest-post">
			<?php  while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<li>
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-image">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
                            <?php
                                $image_featured = danny_resize_image( get_post_meta( get_the_ID() , '_thumbnail_id', true ) , null, 100, 100, true, true );
                                $image_featured = $image_featured['url'];                                    
                            ?>
                            <img src="<?php echo esc_url($image_featured); ?>" alt="<?php the_title(); ?>" />
                        </a>
					</div>
					<?php endif; ?>
					<div class="post-item-text">
						<h4><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
						<time><a class="post-meta" href="<?php echo get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ); ?> "><?php the_time(get_option('date_format')); ?></a></time>
					</div>
				</li>
			<?php endwhile; ?>
            </ul><?php
            wp_reset_postdata();
            echo $after_widget;
        endif;
	}

	function update( $new_instance, $old_instance )
    {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['categories'] = $new_instance['categories'];
		$instance['number'] = strip_tags( $new_instance['number'] );
		return $instance;
	}

	function form( $instance )
    {
		$defaults = array( 'title' => esc_html__('Latest Posts', 'natalie'), 'number' => 5, 'categories' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'natalie'); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  />
		</p>
		<p>
    		<label for="<?php echo $this->get_field_id('categories'); ?>">Filter by Category:</label> 
    		<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
    			<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>All categories</option>
    			<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
    			<?php foreach($categories as $category) { ?>
    			<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
    			<?php } ?>
    		</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e('Number of posts to show:', 'natalie'); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>
	<?php
	}
}

add_action( 'widgets_init', 'danny_latest_posts_init' );
function danny_latest_posts_init() {
	register_widget( 'Danny_Widget_Latest_Posts_Widget' );
}
