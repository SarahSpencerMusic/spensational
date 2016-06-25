<?php
function danny_sanitize_default( $value ) {
	return $value;
}

/** Danny - Customizer - Add Settings */
function danny_register_theme_customizer( $wp_customize )
{
	/** Add Sections -----------------------------------------------------------------------------------------------------------*/
    $wp_customize->add_section( 'danny_new_section_header', array(
   		'title'        => 'Logo upload',
   		'description'  => null,
   		'priority'     => 1
	) );
    $wp_customize->add_section( 'danny_new_section_featured' , array(
		'title'       => 'Featured Area Settings',
		'description' => '',
		'priority'    => 2
	) );
    $wp_customize->add_section( 'danny_new_section_social_media', array(
   		'title'        => 'Social Media Settings',
   		'description'  => 'Enter your social media usernames. Icons will not show if left blank.',
   		'priority'     => 3
	) );
    $wp_customize->add_section( 'danny_new_section_footer', array(
   		'title'        => 'Footer Settings',
   		'description'  => '',
   		'priority'     => 4
	) );
    $wp_customize->add_section( 'danny_new_section_color_accent', array(
   		'title'        => 'Colors: Accent',
   		'description'  => '',
   		'priority'     => 5
	) );
    $wp_customize->add_section( 'danny_new_section_custom_css', array(
   		'title'        => 'Custom CSS',
   		'description'  => 'Add your custom CSS which will overwrite the theme CSS',
   		'priority'     => 6
	) );

    /** Add Settings ------------------------------------------------------------------------------------------------------------*/    
    // Featured area
	$wp_customize->add_setting( 'danny_featured_slider', array(
        'default' => false,
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
	$wp_customize->add_setting( 'danny_featured_cat', array(
        'default' => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
	$wp_customize->add_setting( 'danny_featured_id', array(
        'default' => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
	$wp_customize->add_setting( 'danny_featured_slider_slides', array(
        'default' => '5',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    // Header and Logo
    $wp_customize->add_setting( 'danny_logo', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    $wp_customize->add_setting( 'danny_logo_footer', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    // Social media settings
    $wp_customize->add_setting( 'danny_facebook', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    $wp_customize->add_setting( 'danny_twitter', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    $wp_customize->add_setting( 'danny_instagram', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    $wp_customize->add_setting( 'danny_pinterest', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    $wp_customize->add_setting( 'danny_tumblr', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    $wp_customize->add_setting( 'danny_bloglovin', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    $wp_customize->add_setting( 'danny_tumblr', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    $wp_customize->add_setting( 'danny_google', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    $wp_customize->add_setting( 'danny_youtube', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    $wp_customize->add_setting( 'danny_dribbble', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    $wp_customize->add_setting( 'danny_soundcloud', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );    
    $wp_customize->add_setting( 'danny_vimeo', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    $wp_customize->add_setting( 'danny_linkedin', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    // Accent
    $wp_customize->add_setting( 'danny_accent_color', array(
        'default'           => '#f37e7e',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );    
    // Footer
    $wp_customize->add_setting( 'danny_footer_disable_social', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    $wp_customize->add_setting( 'danny_footer_copyright', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    $wp_customize->add_setting( 'danny_logo_footer', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    // Custom CSS
	$wp_customize->add_setting( 'danny_custom_css', array(
        'default'           => '',
        'sanitize_callback' => 'danny_sanitize_default'
    ) );
    
    /** Add Constrol ------------------------------------------------------------------------------------------------------------*/
    // Logo
    $wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'upload_logo',
			array(
				'label'      => 'Upload logo top',
				'section'    => 'danny_new_section_header',
				'settings'   => 'danny_logo',
				'priority'	 => 1
			)
		)
	);

    // Featured area
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'featured_slider',
			array(
				'label'      => 'Enable Featured Slider',
				'section'    => 'danny_new_section_featured',
				'settings'   => 'danny_featured_slider',
				'type'		 => 'checkbox',
				'priority'	 => 2
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Category_Control(
			$wp_customize,
			'featured_cat',
			array(
				'label'    => 'Select Featured Category',
				'settings' => 'danny_featured_cat',
				'section'  => 'danny_new_section_featured',
				'priority'	 => 3
			)
		)
	);	
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'featured_id',
			array(
				'label'      => 'Select featured post/page IDs',
				'section'    => 'danny_new_section_featured',
				'settings'   => 'danny_featured_id',
				'type'		 => 'text',
				'priority'	 => 4
			)
		)
	);
	
	$wp_customize->add_control(
		new Customize_Number_Control(
			$wp_customize,
			'featured_slider_slides',
			array(
				'label'      => 'Amount of Slides',
				'section'    => 'danny_new_section_featured',
				'settings'   => 'danny_featured_slider_slides',
				'type'		 => 'number',
				'priority'	 => 5
			)
		)
	);
    // Social Media
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'facebook',
			array(
				'label'      => 'Facebook',
				'section'    => 'danny_new_section_social_media',
				'settings'   => 'danny_facebook',
				'type'		 => 'text',
				'priority'	 => 1
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'twitter',
			array(
				'label'      => 'Twitter',
				'section'    => 'danny_new_section_social_media',
				'settings'   => 'danny_twitter',
				'type'		 => 'text',
				'priority'	 => 2
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'instagram',
			array(
				'label'      => 'Instagram',
				'section'    => 'danny_new_section_social_media',
				'settings'   => 'danny_instagram',
				'type'		 => 'text',
				'priority'	 => 3
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'pinterest',
			array(
				'label'      => 'Pinterest',
				'section'    => 'danny_new_section_social_media',
				'settings'   => 'danny_pinterest',
				'type'		 => 'text',
				'priority'	 => 4
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'bloglovin',
			array(
				'label'      => 'Bloglovin',
				'section'    => 'danny_new_section_social_media',
				'settings'   => 'danny_bloglovin',
				'type'		 => 'text',
				'priority'	 => 5
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'google',
			array(
				'label'      => 'Google Plus',
				'section'    => 'danny_new_section_social_media',
				'settings'   => 'danny_google',
				'type'		 => 'text',
				'priority'	 => 6
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'tumblr',
			array(
				'label'      => 'Tumblr',
				'section'    => 'danny_new_section_social_media',
				'settings'   => 'danny_tumblr',
				'type'		 => 'text',
				'priority'	 => 7
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'youtube',
			array(
				'label'      => 'Youtube',
				'section'    => 'danny_new_section_social_media',
				'settings'   => 'danny_youtube',
				'type'		 => 'text',
				'priority'	 => 8
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'dribbble',
			array(
				'label'      => 'Dribbble',
				'section'    => 'danny_new_section_social_media',
				'settings'   => 'danny_dribbble',
				'type'		 => 'text',
				'priority'	 => 9
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'soundcloud',
			array(
				'label'      => 'Soundcloud',
				'section'    => 'danny_new_section_social_media',
				'settings'   => 'danny_soundcloud',
				'type'		 => 'text',
				'priority'	 => 10
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'vimeo',
			array(
				'label'      => 'Vimeo',
				'section'    => 'danny_new_section_social_media',
				'settings'   => 'danny_vimeo',
				'type'		 => 'text',
				'priority'	 => 11
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'linkedin',
			array(
				'label'      => 'Linkedin (Use full URL to your Linkedin profile)',
				'section'    => 'danny_new_section_social_media',
				'settings'   => 'danny_linkedin',
				'type'		 => 'text',
				'priority'	 => 12
			)
		)
	);
	// Accent
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'accent_color',
			array(
				'label'      => 'Accent Color',
				'section'    => 'danny_new_section_color_accent',
				'settings'   => 'danny_accent_color',
				'priority'	 => 1
			)
		)
	);
    // Footer
    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'footer_copyright',
			array(
				'label'      => 'Footer copyright text',
				'section'    => 'danny_new_section_footer',
				'settings'   => 'danny_footer_copyright',
				'type'		 => 'text',
				'priority'	 => 2
			)
		)
	);
    // Custom CSS
	$wp_customize->add_control(
		new Customize_CustomCss_Control(
			$wp_customize,
			'custom_css',
			array(
				'label'      => 'Custom CSS',
				'section'    => 'danny_new_section_custom_css',
				'settings'   => 'danny_custom_css',
				'type'		 => 'custom_css',
				'priority'	 => 1
			)
		)
	);
}
add_action( 'customize_register', 'danny_register_theme_customizer' );