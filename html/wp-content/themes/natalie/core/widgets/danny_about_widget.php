<?php
class Danny_Widget_About_Me extends WP_Widget
{
	public function __construct()
    {
		$widget_ops = array('classname' => 'widget_about_me');
		parent::__construct('widget_about_me', esc_html__('Danny: About Me', 'natalie'), $widget_ops);
	}

	public function widget($args, $instance)
    {
		$title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('About Me', 'natalie') : $instance['title'], $instance, $this->id_base);
		echo wp_kses_post($args['before_widget']);
        if ( $title ) echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] ); ?>
        <div class="about-widget widget-content">
            <?php if ( isset( $instance['image'] ) && !empty( $instance['image'] ) ) : ?>
            <div class="about-img">
                <img src="<?php echo esc_url( $instance['image'] ); ?>" alt="About Me"/>
            </div>
            <?php endif; ?>
            <?php if ( isset( $instance['about_title'] ) && !empty( $instance['about_title'] ) ) : ?>
            <strong class="about-title"><?php echo esc_html( $instance['about_title'] ); ?></strong>
            <?php endif; ?>
            <?php if ( isset( $instance['short_desciption'] ) && !empty( $instance['short_desciption'] ) ) : ?>
            <p><?php echo esc_html( $instance['short_desciption'] ); ?></p>
            <?php endif; ?>
        </div><?php
        echo wp_kses_post($args['after_widget']);
	}

	public function update($new_instance, $old_instance)
    {
		$instance = $old_instance;
		$instance['title']              = strip_tags($new_instance['title']);
        $instance['about_title']        = strip_tags($new_instance['about_title']);
        $instance['short_desciption']   = strip_tags($new_instance['short_desciption']);
        $instance['image']              = strip_tags($new_instance['image']);
		return $instance;
	}

	public function form($instance)
    {
		//Defaults
        $default = array(
            'title' => '',
            'about_title' => '',
            'short_desciption' => '',
            'image' => ''
        );
		$instance           = wp_parse_args((array)$instance, $default);
        $title              = $instance['title'];
        $about_title        = $instance['about_title'];
        $short_desciption   = $instance['short_desciption'];
        $image              = $instance['image']; ?>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
        	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        <p>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('about_title')); ?>">Sub title:</label>
        	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('about_title')); ?>" name="<?php echo esc_attr($this->get_field_name('about_title')); ?>" type="text" value="<?php echo esc_attr($about_title); ?>" /></p>
        <p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_name('short_desciption')); ?>">About me text:</label>
            <textarea rows="8" class="widefat" id="<?php echo esc_attr($this->get_field_id('short_desciption')); ?>" name="<?php echo esc_attr($this->get_field_name('short_desciption')); ?>"><?php echo esc_attr($short_desciption); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_name('image')); ?>">Image URL:</label>
            <input name="<?php echo esc_attr($this->get_field_name('image')); ?>" id="<?php echo esc_attr($this->get_field_id('image')); ?>" class="img widefat" type="text" value="<?php echo esc_url($image); ?>" />
        </p><?php
	}
}
add_action('widgets_init', 'danny_about_me_init');
function danny_about_me_init() {
    register_widget('Danny_Widget_About_Me');
}
