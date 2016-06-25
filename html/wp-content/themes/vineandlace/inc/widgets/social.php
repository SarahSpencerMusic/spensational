<?php
/**
 * Social Widget
 *
 * @package nudgemedia
 * @since nudgemedia 1.0
 */

add_action( 'widgets_init', 'social_circles_widget' );

function social_circles_widget() {
	register_widget( 'nudgemedia_social_circles_widget' );
}

class nudgemedia_social_circles_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function nudgemedia_social_circles_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'nudgemedia_social_circles', 'description' => __('Links to your social media profiles.', 'nudgemedia') );
		
		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'nudgemedia_social_circles' );
		
		/* Create the widget. */
		$this->WP_Widget( 'nudgemedia_social_circles', __('NMD Social Media', 'nudgemedia'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Set up some default widget settings.
		$defaults = array( 
			'title' => '',
			'facebook' => '',
			'twitter' => '',
			'youtube' => '',
			'googleplus' => '',
			'pinterest' => '',
			'instagram' => '',
			'flickr' => '',
			'vimeo' => '',
			'bloglovin' => '',
			'tumblr' => '',
			'linkedin' => '',
			'rss' => '',
			'email' => ''
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$facebook = $instance['facebook'];
		$twitter = $instance['twitter'];
		$youtube = $instance['youtube'];
		$googleplus = $instance['googleplus'];
		$pinterest = $instance['pinterest'];
		$instagram = $instance['instagram'];
		$flickr = $instance['flickr'];
		$vimeo = $instance['vimeo'];
		$bloglovin = $instance['bloglovin'];
		$tumblr = $instance['tumblr'];
		$linkedin = $instance['linkedin'];
		$rss = $instance['rss'];
		$email = $instance['email'];
		
		echo $before_widget;

		// Display the widget title 
		if ( $title ) echo $before_title . $title . $after_title;

		//Display icons
		echo '<ul class="social-links">';
		if ( $facebook ) echo('<li><a href="' . $facebook . '" target="_blank" class="widget_social_facebook" title="Facebook">Facebook</a></li>' );
		if ( $twitter ) echo('<li><a href="' . $twitter . '" target="_blank" class="widget_social_twitter" title="Twitter">Twitter</a></li>' );
		if ( $youtube ) echo('<li><a href="' . $youtube . '" target="_blank" class="widget_social_youtube" title="YouTube">YouTube</a></li>' );
		if ( $googleplus ) echo('<li><a href="' . $googleplus . '" target="_blank" class="widget_social_googleplus" title="Google Plus">Google+</a></li>' );
		if ( $pinterest ) echo('<li><a href="' . $pinterest . '" target="_blank" class="widget_social_pinterest" title="Pinterest">Pinterest</a></li>' );
		if ( $instagram ) echo('<li><a href="' . $instagram . '" target="_blank" class="widget_social_instagram" title="Instagram">Instagram</a></li>' );
		if ( $flickr ) echo('<li><a href="' . $flickr . '" target="_blank" class="widget_social_flickr" title="Flickr">Flickr</a></li>' );
		if ( $vimeo ) echo('<li><a href="' . $vimeo . '" target="_blank" class="widget_social_vimeo" title="Vimeo">Vimeo</a></li>' );
		if ( $bloglovin ) echo('<li><a href="' . $bloglovin . '" target="_blank" class="widget_social_bloglovin" title="Bloglovin">BlogLovin</a></li>' );
		if ( $tumblr ) echo('<li><a href="' . $tumblr . '" target="_blank" class="widget_social_tumblr" title="Tumblr">Tumblr</a></li>' );
		if ( $linkedin ) echo('<li><a href="' . $linkedin . '" target="_blank" class="widget_social_linkedin" title="LinkedIn">LinkedIn</a></li>' );
		if ( $rss ) echo('<li><a href="' . $rss . '" target="_blank" class="widget_social_rss" title="RSS">RSS</a></li>' );
		if ( $email ) echo('<li><a href="mailto:' . $email . '" target="_blank" class="widget_social_email" title="Email">Email</a></li>' );
		echo '</ul>';

		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
		$instance['youtube'] = strip_tags( $new_instance['youtube'] );
		$instance['googleplus'] = strip_tags( $new_instance['googleplus'] );
		$instance['pinterest'] = strip_tags( $new_instance['pinterest'] );
		$instance['instagram'] = strip_tags( $new_instance['instagram'] );
		$instance['flickr'] = strip_tags( $new_instance['flickr'] );
		$instance['vimeo'] = strip_tags( $new_instance['vimeo'] );
		$instance['bloglovin'] = strip_tags( $new_instance['bloglovin'] );
		$instance['tumblr'] = strip_tags( $new_instance['tumblr'] );
		$instance['linkedin'] = strip_tags( $new_instance['linkedin'] );
		$instance['rss'] = strip_tags( $new_instance['rss'] );
		$instance['email'] = strip_tags( $new_instance['email'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 
			'title' => '',
			'facebook' => '',
			'twitter' => '',
			'youtube' => '',
			'googleplus' => '',
			'pinterest' => '',
			'instagram' => '',
			'flickr' => '',
			'vimeo' => '',
			'bloglovin' => '',
			'tumblr' => '',
			'linkedin' => '',
			'rss' => '',
			'email' => ''
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Widget title:', 'nudgemedia'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('Facebook URL', 'nudgemedia'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter URL', 'nudgemedia'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e('YouTube URL', 'nudgemedia'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'googleplus' ); ?>"><?php _e('Google+ URL', 'nudgemedia'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'googleplus' ); ?>" name="<?php echo $this->get_field_name( 'googleplus' ); ?>" value="<?php echo $instance['googleplus']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e('Pinterest URL', 'nudgemedia'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo $instance['pinterest']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e('Instagram URL', 'nudgemedia'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo $instance['instagram']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e('Flickr URL', 'nudgemedia'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" value="<?php echo $instance['flickr']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><?php _e('Vimeo URL', 'nudgemedia'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo $instance['vimeo']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'bloglovin' ); ?>"><?php _e('BlogLovin URL', 'nudgemedia'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'bloglovin' ); ?>" name="<?php echo $this->get_field_name( 'bloglovin' ); ?>" value="<?php echo $instance['bloglovin']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'tumblr' ); ?>"><?php _e('Tumblr URL', 'nudgemedia'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'tumblr' ); ?>" name="<?php echo $this->get_field_name( 'tumblr' ); ?>" value="<?php echo $instance['tumblr']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e('LinkedIn URL', 'nudgemedia'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo $instance['linkedin']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e('RSS URL', 'nudgemedia'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo $instance['rss']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('Email Address', 'nudgemedia'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" class="widefat" />
		</p>

	<?php
	}
}

?>