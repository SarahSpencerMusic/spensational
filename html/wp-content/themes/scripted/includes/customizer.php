<?php
/*
=================================================
SCRIPTED THEME CUSTOMIZER
=================================================
*/

/**
 * Lets create a customizable theme and begin with some pre-setup
*/ 
    add_action('customize_register', 'scripted_theme_customize');
    function scripted_theme_customize($wp_customize) {
        
    /**
    * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
    */
    
    function scripted_customize_preview_js() {
        wp_enqueue_script( 'scripted_customizer', get_template_directory_uri() . '/js/scripted-customize.js', array( 'customize-preview' ), '2013102', true );
    }
    add_action( 'customize_preview_init', 'scripted_customize_preview_js' );

/*    	
=================================================
General Settings Customizer
=================================================
*/
	
	$wp_customize->add_panel( 'general_settings_panel', array( // General Panel
	    'priority'       => 1,
	    'capability'     => 'edit_theme_options',
	    'title'          => __('General Settings', 'scripted'),
	    'description'    => __('Changes the General Settings of Site', 'scripted'),
	));
    
   	$wp_customize->get_section( 'title_tagline' )->panel = 'general_settings_panel';
    
    //disable enable logo header
	$wp_customize->add_section(
        'header_text_logo_section',
        array(
            'title' => __('Top Header Content Options','scripted'),
            'priorty' => 1,
            'panel' => 'general_settings_panel'
        )
    );

      //Header Icon section
	$wp_customize->add_section(
        'header_right_top_section',
        array(
            'title' => __('Header Icon (Right Top)','scripted'),
            'priorty' => 1,
            'panel' => 'general_settings_panel'
        )
    );
    
    $wp_customize->add_setting( 
		'header_right_top_setting', 
		array(
			'default' => 'fa fa-bars',
			'sanitize_callback' => 'scripted_sanitize_text',	
			)
	);
	$wp_customize->add_control( 'header_right_top_setting', array(
		'settings' => 'header_right_top_setting',
		'label'    => __( 'Header Right Icon', 'scripted' ),
        'description' => '<a href="https://fortawesome.github.io/Font-Awesome/icons/" target="_blank">visit here</a> for more icons',
		'section'  => __('header_right_top_section','scripted'),
		'type'     => 'text',
		'priority' => 4,
	) );
    
    $wp_customize->add_setting(
        'header_text_logo_setting',
        array(
            'default' => '',
            'sanitize_callback' => 'scripted_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
        'header_text_logo_setting',
            array(
                'label'=>__('Check this box if you would like to use a plain text logo','scripted'),
                'section'=>'header_text_logo_section',
                'type'=>'checkbox'
            )
    );
    
	// Header image
	$wp_customize->add_section( 'scripted_logo_section' , array(
	    'title'       => __( 'Upload Custom Logo', 'scripted' ),
	    'priority'    => 1,
	    'description' => __('Upload a logo to replace the default site name and description in the header','scripted'),
	    'panel' => 'general_settings_panel'
	) );  
    
	$wp_customize->add_setting( 
		'custom_logo_scripted_setting', 
		array(
			'default' => '',
			'sanitize_callback' => 'scripted_sanitize_upload',	
			)
	);

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_logo_scripted_setting', array(
	    'label'    => __( 'Upload Image', 'scripted' ),
	    'section'  => 'scripted_logo_section',
	    'settings' => 'custom_logo_scripted_setting',
	) ) );

 
/*    	
=================================================
Home Page Customizer
=================================================
*/
	
	$wp_customize->add_panel( 'homepage_setting_panel', array( // General Panel
	    'priority'       => 3,
	    'capability'     => 'edit_theme_options',
	    'title'          => __('Home Page', 'scripted'),
	    'description'    => __('Changes the home page settings', 'scripted'),
	));

	// Header Part (Billboard part)
	$wp_customize->add_section( 'home_page_section' , array(
	    'title'       => __( 'Heading ', 'scripted' ),
	    'priority'    => 1,
	    'panel' => 'homepage_setting_panel'
	) );
    
    $wp_customize->add_setting( 'homepage_heading_setting', array(
		'default'        => '',
		'sanitize_callback' => 'scripted_sanitize_text',
	) );

	$wp_customize->add_control( 'homepage_heading_setting', array(
		'settings' => 'homepage_heading_setting',
		'label'    => __( 'Header Text', 'scripted' ),
		'section'  => __('home_page_section','scripted'),
		'type'     => 'text',
		'priority' => 2,
	) );

	// Sub Header Part
	$wp_customize->add_section( 'sub_header_section' , array(
	    'title'       => __( 'Sub-header', 'scripted' ),
	    'priority'    => 1,
	    'panel' => 'homepage_setting_panel'
	) );
    
    $wp_customize->add_setting( 'sub_heading_setting', array(
		'default'        => '',
		'sanitize_callback' => 'scripted_sanitize_text',
	) );

	$wp_customize->add_control( 'sub_heading_setting', array(
		'settings' => 'sub_heading_setting',
		'label'    => __( 'Sub Header Text', 'scripted' ),
		'section'  => __('sub_header_section','scripted'),
		'type'     => 'textarea',
		'priority' => 3,
	) );

	// Buttom Link
	$wp_customize->add_section( 'button_text_link_section' , array(
	    'title'       => __( 'Button Text and Link', 'scripted' ),
	    'priority'    => 1,
	    'panel' => 'homepage_setting_panel'
	) );
    
    $wp_customize->add_setting( 'button_text_setting', array(
		'default'        => '',
		'sanitize_callback' => 'scripted_sanitize_text',
	) );

	$wp_customize->add_control( 'button_text_setting', array(
		'settings' => 'button_text_setting',
		'label'    => __( 'Button Text', 'scripted' ),
		'section'  => __('button_text_link_section','scripted'),
		'type'     => 'text',
		'priority' => 3,
	) );
    
    $wp_customize->add_setting( 'button_link_setting', array(
		'default'        => '',
		'sanitize_callback' => 'scripted_sanitize_url',
	) );

	$wp_customize->add_control( 'button_link_setting', array(
		'settings' => 'button_link_setting',
		'label'    => __( 'Button Link', 'scripted' ),
		'section'  => __('button_text_link_section','scripted'),
		'type'     => 'text',
		'priority' => 3,
	) );   
    
    
    // Home Page Slider
	$wp_customize->add_section( 'homepage_slider_section' , array(
	    'title'       => __( 'Homepage Slider', 'scripted' ),
	    'priority'    => 3,
	    'description' => '',
	    'panel' => 'homepage_setting_panel'
	) );
    
    $wp_customize->add_setting(
        'slider_show_hide_option_setting',
        array(
            'default' => '',
            'sanitize_callback' => 'scripted_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
        'slider_show_hide_option_setting',
            array(
                'label'=>__('Check this box if you would like to hide slider in homepage','scripted'),
                'section'=>'homepage_slider_section',
                'type'=>'checkbox',
                'priority' => 3
            )
    );    
 
	$wp_customize->add_setting(
        'homepage_slider_category',
        array(
            'sanitize_callback' => 'scripted_sanitize_dropdown_general',
            )
    );
    
    $wp_customize->add_control( new Category_Dropdown( $wp_customize, 'homepage_slider_category',
        array(
            'label' => __('Choose Slider Category', 'scripted'),
            'section' => 'homepage_slider_section',
            'description' => __(' Select Category to show posts posted in that category to show in slider (Choose Post Category as slider option above to use this functionality) ','scripted'),
            'type' => 'select',
            'priority' => 3,
        )
    ) ); 
    

    // Text Columns
	$wp_customize->add_section( 'text_left_columns_section' , array(
	    'title'       => __( 'Left Text Columns', 'scripted' ),
	    'priority'    => 1,
	    'description' => __('Enter the text for the main heading in the billboard area.','scripted'),
	    'panel' => 'homepage_setting_panel'
	) );
    
    $wp_customize->add_setting( 'left_column_heading_setting', array(
		'default'        => '',
		'sanitize_callback' => 'scripted_sanitize_text',
	) );

	$wp_customize->add_control( 'left_column_heading_setting', array(
		'settings' => 'left_column_heading_setting',
		'label'    => __( 'Left Column Heading', 'scripted' ),
		'section'  => __('text_left_columns_section','scripted'),
		'type'     => 'text',
		'priority' => 3,
	) );
    
    $wp_customize->add_setting(
        'left_column_heading_text_setting',
        array(
            'default' => '',
            'sanitize_callback' => 'scripted_sanitize_text', 
        )
    );
    
    $wp_customize->add_control(
        'left_column_heading_text_setting',
        array(
            'section' => 'text_left_columns_section',
            'label' => __('Left Column Sub Text','scripted'),
            'type' => 'textarea'
        )
    );
    
    $wp_customize->add_section( 'text_center_columns_section' , array(
	    'title'       => __( 'Center Text Columns', 'scripted' ),
	    'priority'    => 1,
	    'description' => __('Enter the text for the main heading in the billboard area.','scripted'),
	    'panel' => 'homepage_setting_panel'
	) );
 
    $wp_customize->add_setting( 'center_column_heading_setting', array(
		'default'        => '',
		'sanitize_callback' => 'scripted_sanitize_text',
	) );

	$wp_customize->add_control( 'center_column_heading_setting', array(
		'settings' => 'center_column_heading_setting',
		'label'    => __( 'Center Column Heading', 'scripted' ),
		'section'  => __('text_center_columns_section','scripted'),
		'type'     => 'text',
		'priority' => 5,
	) );
    
    $wp_customize->add_setting(
        'center_column_heading_text_setting',
        array(
            'default' => '',
            'sanitize_callback' => 'scripted_sanitize_text', 
        )
    );
    
    $wp_customize->add_control(
        'center_column_heading_text_setting',
        array(
            'section' => 'text_center_columns_section',
            'label' => __('Center Column Sub Text','scripted'),
            'type' => 'textarea'
        )
    );
    
    $wp_customize->add_section( 'text_right_columns_section' , array(
	    'title'       => __( 'Right Text Columns', 'scripted' ),
	    'priority'    => 1,
	    'description' => __('Enter the text for the main heading in the billboard area.','scripted'),
	    'panel' => 'homepage_setting_panel'
	) );
    
    $wp_customize->add_setting( 'right_column_heading_setting', array(
		'default'        => '',
		'sanitize_callback' => 'scripted_sanitize_text',
	) );

	$wp_customize->add_control( 'right_column_heading_setting', array(
		'settings' => 'right_column_heading_setting',
		'label'    => __( 'Right Column Heading', 'scripted' ),
		'section'  => __('text_right_columns_section','scripted'),
		'type'     => 'text',
		'priority' => 7,
	) );
    
    $wp_customize->add_setting(
        'right_column_heading_text_setting',
        array(
            'default' => '',
            'sanitize_callback' => 'scripted_sanitize_text', 
        )
    );
    
    $wp_customize->add_control(
        'right_column_heading_text_setting',
        array(
            'section' => 'text_right_columns_section',
            'label' => __('Right Column Sub Text','scripted'),
            'type' => 'textarea'
        )
    );

	/*    	
=================================================
Home Page Customizer
=================================================
*/
	
	$wp_customize->add_panel( 'footer_setting_panel', array( // General Panel
	    'priority'       => 3,
	    'capability'     => 'edit_theme_options',
	    'title'          => __('Footer', 'scripted'),
	    'description'    => __('Changes the footer text section', 'scripted'),
	));


	// Footer Column
	$wp_customize->add_section( 'footer_copyright_columns_section' , array(
	    'title'       => __( 'Footer Text', 'scripted' ),
	    'priority'    => 1,
	    'description' => __('Changes the actual copyright text in the site footer.','scripted'),
	    'panel' => 'footer_setting_panel'
	) );
    
    $wp_customize->add_setting( 'footer_text_setting', array(
		'default'        => '',
		'sanitize_callback' => 'scripted_sanitize_text',
	) );

	$wp_customize->add_control( 'footer_text_setting', array(
		'settings' => 'footer_text_setting',
		'label'    => __( 'Footer Copyright Text', 'scripted' ),
		'section'  => __('footer_copyright_columns_section','scripted'),
		'type'     => 'textarea',
		'priority' => 3,
	) );
    
 }
    
// down is sanitization can be removed after all above field implementation
    /**
 * adds sanitization callback function : colors
 * @package scripted 
*/
	function scripted_sanitize_hex_color( $color ) {
	if ( $unhashed = sanitize_hex_color_no_hash( $color ) )
		return '#' . $unhashed;

	return $color;
}

/**
 * adds sanitization callback function : text
 * @package scripted 
*/
function scripted_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * adds sanitization callback function : url
 * @package scripted 
*/
	function scripted_sanitize_url( $value) {
		$value = esc_url( $value);
		return $value;
	}

/**
 * adds sanitization callback function : checkbox
 * @package scripted 
*/
function scripted_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}	

//General dropdown sanitize for integer value
    function scripted_sanitize_dropdown_general( $input ) {
        return absint( $input );
    }
    
    


/**
 * adds sanitization callback function for uploading : uploader
 * @package encase * Special thanks to: https://github.com/chrisakelley
 */
add_filter( 'scripted_sanitize_image', 'scripted_sanitize_upload' );
add_filter( 'scripted_sanitize_file', 'scripted_sanitize_upload' );
function scripted_sanitize_upload( $input ) {
        
        $output = '';
        $filetype = wp_check_filetype($input);
        if ( $filetype["ext"] ) {
                $output = $input;
        }
        return $output;
}

/**
 * Custom scripts and styles on customize.php for scripted.
 *
 */
function scripted_customize_scripts() {
	wp_enqueue_script( 'scripted_customizer_custom', get_template_directory_uri() . '/js/scripted-customizer-custom-scripts.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20150630', true );

	$scripted_misc_links = array(
							'upgrade_link' 				=> esc_url( 'http://styledthemes.com/scripted' ),
							'upgrade_text'	 			=> __( 'Upgrade To Scripted Pro &raquo;', 'scripted' ),
							'WP_version'				=> get_bloginfo( 'version' ),
							'old_version_message'		=> __( 'Some settings might be missing or disorganized in this version of WordPress. So we suggest you to upgrade to version 4.4.2 or better.', 'scripted' )
		);

	//Add Upgrade Button and old WordPress message via localized script
	wp_localize_script( 'scripted_customizer_custom', 'scripted_misc_links', $scripted_misc_links );

	wp_enqueue_script( 'scripted_customizer_custom' );

	wp_enqueue_style( 'scripted_customizer_custom', get_template_directory_uri() . '/css/scripted-customizer.css');
}
add_action( 'customize_controls_enqueue_scripts', 'scripted_customize_scripts');
