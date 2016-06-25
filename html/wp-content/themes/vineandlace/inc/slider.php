<div class="featured">
	<div id="slides">
    	<ul class="bxslider">

		<?php

		query_posts(array('posts_per_page' => 3, 'category_name' => 'Featured'));

		if(have_posts()) : while(have_posts()) : the_post();

		?>

		  <li>

			<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('full-width'); ?></a>

		  </li>

		<?php

		    endwhile;

			endif;

			wp_reset_query();

		?>

	</ul>

  </div>
</div>  