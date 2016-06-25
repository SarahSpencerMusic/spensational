<!-- Search -->
<form class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
	<input class="search-input" type="search" name="s" placeholder="<?php esc_attr_e( 'To search type and hit enter', 'scripted' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>">
	<button class="search-submit btn" type="submit" role="button"><?php _e( '<i class="fa fa-search"></i>', 'scripted' ); ?></button>
</form>

