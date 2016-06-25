<?php
class Danny_Like_Post {

	 function __construct()   {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_danny-like-post', array($this, 'ajax'));
		add_action('wp_ajax_nopriv_danny-like-post', array($this, 'ajax'));
	}

	function enqueue_scripts() {		
		wp_enqueue_script( 'danny-like-post', DANNY_CORE_URI . '/classes/like-post/js/danny-like-post.js', 'jquery', '1.0', true );
		wp_localize_script( 'danny-like-post', 'DannyLike', array(
			'ajaxurl' => admin_url('admin-ajax.php')
		));
	}

	function ajax($post_id) {

		//update
		if( isset($_POST['likes_id']) ) {
			$post_id = str_replace('danny-like-post-', '', $_POST['likes_id']);
			echo $this->like_post($post_id, 'update');
		}

		//get
		else {
			$post_id = str_replace('danny-like-post-', '', $_POST['likes_id']);
			echo $this->like_post($post_id, 'get');
		}

		exit;
	}


	function like_post($post_id, $action = 'get')
	{
		if(!is_numeric($post_id)) return;

		switch($action) {

			case 'get':
				$love_count = get_post_meta($post_id, '_danny_like_post', true);
				if( !$love_count ){
					$love_count = 0;
					add_post_meta($post_id, '_danny_like_post', $love_count, true);
				}
                if ( (int)$love_count < 1 ) {
                    $love_count = null;
                }
				return '<span class="danny-like-post-count">'. $love_count .'</span>';
				break;

			case 'update':
				$love_count = get_post_meta($post_id, '_danny_like_post', true);
				if( isset($_COOKIE['danny_like_post_'. $post_id]) ) return $love_count;

				$love_count++;
				update_post_meta($post_id, '_danny_like_post', $love_count);
				setcookie('danny_like_post_'. $post_id, $post_id, time()*20, '/');
                
                if ( (int)$love_count < 1 ) {
                    $love_count = null;
                }

				return '<span class="danny-like-post-count">'. $love_count .'</span>';
				break;

		}
	}


	function add_love() {
		global $post;

		$output = $this->like_post($post->ID);

  		$class = 'danny-like-post';
  		$title = esc_html__('Like this', 'natalie');
		if( isset($_COOKIE['danny_like_post_'. $post->ID]) ){
			$class = 'danny-like-post liked';
			$title = esc_html__('You already liked this!', 'natalie');
		}

		return '<span class="porotfolio-wish"><a href="#" class="'. $class .'" id="danny-like-post-'. $post->ID .'" title="'. esc_attr($title) .'"><i class="fa fa-heart-o"></i> '.$output.'</a></span>';
	}

}


global $danny_like_post;
$danny_like_post = new Danny_Like_Post();
