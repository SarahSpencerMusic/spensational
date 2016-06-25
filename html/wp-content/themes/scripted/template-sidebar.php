<?php /* Template Name: Sidebar Template */ ?>

<?php get_header(); ?>

<main id="content" role="main" itemprop="mainContentOfPage">


	<!-- Heading -->
	<section id="header-meta" class="wrap clearfix">
	<?php if ( get_theme_mod( 'homepage_heading_setting' ) ) { ?>
		<h1 class="entry-title"><?php echo esc_attr( get_theme_mod('homepage_heading_setting' ) ); ?></h1>
	<?php } if ( get_theme_mod( 'sub_heading_setting' ) ) { ?>
		<div class="entry-excerpt"><?php echo esc_attr( get_theme_mod( 'sub_heading_setting' ) ); ?></div>
	<?php } if ( get_theme_mod( 'button_link_setting' ) ) { ?>
		<a href="<?php echo esc_url( get_theme_mod( 'button_link_setting') ); ?>" title="<?php echo esc_attr( get_theme_mod( 'button_text_setting' ) ); ?>" class="more"><?php echo esc_attr( get_theme_mod( 'button_text_setting' ) ); ?></a>
	<?php } ?>
	</section>


	<!--Blog Posts-->
	<section id="blog" class="wrap clearfix">

		<div class="blog-post">
            <?php while ( have_posts() ) : the_post(); ?>
                <h2 class="entry-title"><?php the_title(); ?></h2>
                <?php 
                if(has_post_thumbnail()){
                    $scripted_team_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'scripted_page_img', false );
                    ?>
                    <img class="image_sidebar_page" src="<?php echo esc_url( $scripted_team_image[0] ); ?>" />
                <?php } ?>
				<div class="entry-excerpt"><?php the_content(); ?></div>
            <?php endwhile; ?>
		</div>

		<div class="blog-posts">
			<?php get_sidebar('right'); ?>
		</div>

	</section>


</main>
			
<?php get_footer(); ?>
