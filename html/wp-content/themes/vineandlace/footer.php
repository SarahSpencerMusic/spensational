<?php
/**
 * The template for displaying the footer
 *
 */
?>

</div><!-- #main -->

		<footer id="colophon" class="site-footer" role="contentinfo">
		  
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer') ) ?>

		<div class="site-info">
			<?php echo of_get_option( 'credits_text', '&#169; 2015' ); ?> | Made with love by <a href="http://www.nudgemediadesign.com">NUDGE MEDIA DESIGN</a>. 
		</div><!-- .site-info -->

		</footer><!-- #colophon -->
	</div><!-- #page -->
			
<?php wp_footer(); ?>
<?php echo of_get_option('of_google_analytics'); ?>
</body>
</html>