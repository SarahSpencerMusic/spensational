<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
<aside id="sidebar" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
	<div class="wrap clearfix">
		<?php dynamic_sidebar( 'sidebar' ); ?>
	</div>
</aside>
<?php endif; ?>