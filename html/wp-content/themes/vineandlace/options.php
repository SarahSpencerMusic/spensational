<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_vinelace() {
	// Change this to use your theme slug
	return 'options-framework-theme';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */
function optionsframework_options() {
	
		// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'abel',
		'style' => 'normal',
	    'cap' => 'none',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);
  
  	$options = array();
  
    $options[] = array( "name" => "General",	  
		"type" => "heading"
	); 
  
	$options[] = array(
    	'name' => __('Upload a Favicon', 'options_framework_theme'),
    	'desc' => __('Upload a favicon to your theme, size must be 16px by 16px', 'options_framework_theme'),
    	'id' => 'favicon_uploader',
    	'type' => 'upload'
	);
  
	$options[] = array(
		'name' => __( 'Footer Credits', 'options_framework_theme' ),
		'desc' => __( 'Add your site credits here.', 'options_framework_theme' ),
		'id' => 'credits_text',
		'std' => '&#169; 2015',
		'type' => 'text'
	);
                                              
	$options[] = array( "name" => "Tracking Code",
		"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
		"id" => $shortname."_google_analytics",
		"std" => "",
		"type" => "textarea"
	);       

	$options[] = array( 'name' => 'Typography',
		'type' => 'heading'
	);
		
	$typography_mixed_fonts = array_merge( options_typography_get_os_fonts() , options_typography_get_google_fonts() );
	asort($typography_mixed_fonts);

	$options[] = array( 'name' => 'Site Title Text',
		'desc' => 'To upload an image or logo, go to Appearance>Header.',
		'id' => 'site_title_text',
		'std' => array( 'size' => '64px', 'face' => 'Tinos, serif', 'color' => '#373636', 'style' => 'normal',),
		'type' => 'typography',
		'options' => array(
		    'faces' => $typography_mixed_fonts,
		  'styles' => of_recognized_font_styles() )
	);

	$options[] = array( 'name' => 'Site Tagline Text',
		'desc' => 'To remove tagline, go to Settings>General.',
		'id' => 'site_tagline',
		'std' => array( 'size' => '16px', 'face' => 'Roboto, sans-serif', 'color' => '#373636', 'style' => 'normal'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts,
		'styles' => of_recognized_font_styles() )
	);

	$options[] = array( 'name' => 'Menu Font',
		'desc' => '',
		'id' => 'tabs_font',
		'std' => array( 'size' => '14px', 'face' => 'Roboto, sans-serif', 'color' => '#4f4f4f', 'style' => 'normal'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts,
		'styles' => of_recognized_font_styles() )
	);

	$options[] = array(
	    "name" => "Menu Hover Color",
		'desc' => '',
	    "id" => "tabs_hover_color",
	    "std" => "#c3a453",
	    "type" => "color"
	);
  
	$options[] = array( 'name' => 'Link color',
		'desc' => '',
		"id" => "link_color",
		"std" => "#c3a453",
		"type" => "color" 
	);
		
	$options[] = array( 'name' => 'Link hover color',
		'desc' => '',
		"id" => "link_hover_color",
		"std" => "#4f4f4f",
		"type" => "color" 
	);

	$options[] = array( 'name' => 'Sidebar Title Font',
		'desc' => '',
		'id' => 'sidebar_title_text',
		'std' => array( 'size' => '16px', 'face' => 'Roboto, sans-serif', 'color' => '#373636', 'style' => 'normal'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts,
		'styles' => of_recognized_font_styles() )
	);

	$options[] = array( 'name' => 'Sidebar Text',
		'desc' => '',
		'id' => 'sidebar_text',
        'std' => array( 'size' => '13px', 'face' => 'Roboto, sans-serif', 'color' => '#505050', 'style' => 'normal'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts,
		'styles' => of_recognized_font_styles() )
	);
  
    $options[] = array( 'name' => 'Sidebar Link Font',
		'desc' => '',
		'id' => 'sidebar_link',
        'std' => array( 'size' => '13px', 'face' => 'Roboto, sans-serif', 'color' => '#c3a453', 'style' => 'normal'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts,
		'styles' => of_recognized_font_styles() )
	);
  
    $options[] = array( 'name' => 'Sidebar Link Hover',
		'desc' => '',
		"id" => "sidebar_link_hover",
		"std" => "#4f4f4f",
		"type" => "color" 
	);

	$options[] = array( 'name' => 'Footer Credits',
		'desc' => '',
		'id' => 'footer_credits',
		'std' => array( 'size' => '12px', 'face' => 'Roboto, sans-serif', 'color' => '#4f4f4f', 'style' => 'normal'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts,
		'styles' => of_recognized_font_styles() )
	);
  
  	$options[] = array( 'name' => 'Posts',
		'type' => 'heading');
		
	$typography_mixed_fonts = array_merge( options_typography_get_os_fonts() , options_typography_get_google_fonts() );
	asort($typography_mixed_fonts);
  
  	$options[] = array(
	  	'name' => __('Post Featured Image ', 'options_framework_theme'),
		'desc' => __('Check to hide featured images.', 'options_framework_theme'),
		'id' => 'featured_image',
		'std' => '0',
		'type' => 'checkbox'
	);
      	
  	$options[] = array(
	  	'name' => __('Post Categories', 'options_framework_theme'),
		'desc' => __('Check to hide post categories.', 'options_framework_theme'),
		'id' => 'post_categories',
		'std' => '0',
		'type' => 'checkbox'
	);
    
    $options[] = array(
	  	'name' => __('Post Tags', 'options_framework_theme'),
		'desc' => __('Check to hide post tags.', 'options_framework_theme'),
		'id' => 'post_tags',
		'std' => '0',
		'type' => 'checkbox'
	);
  
  	$options[] = array(
		'name' => __( 'Post Signature', 'options_framework_theme' ),
		'desc' => __( 'Enter your signature name here.', 'options_framework_theme' ),
		'id' => 'signature_text',
		'std' => 'VINE & LACE',
		'type' => 'text'
	);
  
  	$options[] = array(
		'name' => __('Hide Post Signature', 'options_framework_theme'),
		'desc' => __('Check to hide post signature.', 'options_framework_theme'),
		'id' => 'display_signature',
		'std' => '0',
		'type' => 'checkbox'
	); 

	$options[] = array( 'name' => 'Post/Page Title Font',
		'desc' => '',
		'id' => 'post_title_font',
		'std' => array( 'size' => '32px', 'face' => 'Tinos, serif', 'style' => 'bold', 'color' => '#373636'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts,
		'styles' => of_recognized_font_styles() )
	);
    
  	$options[] = array( 'name' => 'Post Date',
		'desc' => '',
		'id' => 'post_date',
		'std' => array( 'size' => '12px', 'face' => 'Roboto, sans-serif', 'style' => 'normal', 'color' => '#aaaaaa'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts,
		'styles' => of_recognized_font_styles() )
	);
  
	$options[] = array( 'name' => 'Post Body Font',
		'desc' => '',
		'id' => 'post_body',
		'std' => array( 'size' => '13px', 'face' => 'Roboto, sans-serif', 'style' => 'normal', 'color' => '#505050'),
		'type' => 'typography',
		'options' => array(
			'faces' => $typography_mixed_fonts,
			'styles' => of_recognized_font_styles() )
	);
  
  	$options[] = array( 'name' => 'Post Signature Font',
		'desc' => '',
		'id' => 'post_signature',
		'std' => array( 'size' => '18px', 'face' => 'Tinos, serif', 'color' => '#c3a453', 'style' => 'normal'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts,
		'styles' => of_recognized_font_styles() )
	);
  
	$options[] = array( 'name' => 'Post Meta',
		'desc' => '',
		'id' => 'post_meta',
		'std' => array( 'size' => '12px', 'face' => 'Roboto, sans-serif', 'color' => '#373636', 'style' => 'normal'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts,
		'styles' => of_recognized_font_styles() )
	);

	return $options;
}