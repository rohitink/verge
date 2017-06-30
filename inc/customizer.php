<?php
/**
 * verge Theme Customizer
 *
 * @package verge
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function verge_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

		
	
	//Replace Header Text Color with, separate colors for Title and Description
	//Override verge_site_titlecolor
	$wp_customize->remove_control('display_header_text');
	$wp_customize->remove_setting('header_textcolor');
	$wp_customize->add_setting('verge_site_titlecolor', array(
	    'default'     => '#4cb2ed',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'verge_site_titlecolor', array(
			'label' => __('Site Title Color','verge'),
			'section' => 'colors',
			'settings' => 'verge_site_titlecolor',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting('verge_header_desccolor', array(
	    'default'     => '#777',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'verge_header_desccolor', array(
			'label' => __('Site Tagline Color','verge'),
			'section' => 'colors',
			'settings' => 'verge_header_desccolor',
			'type' => 'color'
		) ) 
	);
	
	
	//Settings for Header Image
	$wp_customize->add_setting( 'verge_himg_style' , array(
	    'default'     => 'cover',
	    'sanitize_callback' => 'verge_sanitize_himg_style'
	) );
	
	/* Sanitization Function */
	function verge_sanitize_himg_style( $input ) {
		if (in_array( $input, array('contain','cover') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
	'verge_himg_style', array(
		'label' => __('Header Image Arrangement','verge'),
		'section' => 'header_image',
		'settings' => 'verge_himg_style',
		'type' => 'select',
		'choices' => array(
				'contain' => __('Contain','verge'),
				'cover' => __('Cover Completely (Recommended)','verge'),
				)
	) );
	
	$wp_customize->add_setting( 'verge_himg_align' , array(
	    'default'     => 'center',
	    'sanitize_callback' => 'verge_sanitize_himg_align'
	) );
	
	/* Sanitization Function */
	function verge_sanitize_himg_align( $input ) {
		if (in_array( $input, array('center','left','right') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
	'verge_himg_align', array(
		'label' => __('Header Image Alignment','verge'),
		'section' => 'header_image',
		'settings' => 'verge_himg_align',
		'type' => 'select',
		'choices' => array(
				'center' => __('Center','verge'),
				'left' => __('Left','verge'),
				'right' => __('Right','verge'),
			)
	) );
	
	$wp_customize->add_setting( 'verge_himg_repeat' , array(
	    'default'     => true,
	    'sanitize_callback' => 'verge_sanitize_checkbox'
	) );
	
	$wp_customize->add_control(
	'verge_himg_repeat', array(
		'label' => __('Repeat Header Image','verge'),
		'section' => 'header_image',
		'settings' => 'verge_himg_repeat',
		'type' => 'checkbox',
	) );
	
	
	//Settings For Logo Area
	
	$wp_customize->add_setting(
		'verge_hide_title_tagline',
		array( 'sanitize_callback' => 'verge_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'verge_hide_title_tagline', array(
		    'settings' => 'verge_hide_title_tagline',
		    'label'    => __( 'Hide Title and Tagline.', 'verge' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'verge_branding_below_logo',
		array( 'sanitize_callback' => 'verge_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'verge_branding_below_logo', array(
		    'settings' => 'verge_branding_below_logo',
		    'label'    => __( 'Display Site Title and Tagline Below the Logo.', 'verge' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		    'active_callback' => 'verge_title_visible'
		)
	);
	
	function verge_title_visible( $control ) {
		$option = $control->manager->get_setting('verge_hide_title_tagline');
	    return $option->value() == false ;
	}	
	
	//FEATURED NEWS
	$wp_customize->add_section(
	    'verge_a_fn_boxes',
	    array(
	        'title'     => __('Featured Posts (Large, Top)','verge'),
	        'priority'  => 35,
	        'panel'  => 'verge_featposts'
	    )
	);
	
	$wp_customize->add_setting(
		'verge_fn_enable',
		array( 'sanitize_callback' => 'verge_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'verge_fn_enable', array(
		    'settings' => 'verge_fn_enable',
		    'label'    => __( 'Enable', 'verge' ),
		    'section'  => 'verge_a_fn_boxes',
		    'type'     => 'checkbox',
		)
	);	
 
 	$wp_customize->add_setting(
	    'verge_fn_cat',
	    array( 'sanitize_callback' => 'verge_sanitize_category' )
	);
	
	$wp_customize->add_control(
	    new Verge_WP_Customize_Category_Control(
	        $wp_customize,
	        'verge_fn_cat',
	        array(
	            'label'    => __('Posts Category.','verge'),
	            'settings' => 'verge_fn_cat',
	            'section'  => 'verge_a_fn_boxes'
	        )
	    )
	);		
	
	//FEATURED POSTS LARGE
	$wp_customize->add_section(
	    'verge_a_fn2_boxes',
	    array(
	        'title'     => __('Featured Posts (Full Width)','verge'),
	        'priority'  => 35,
	        'panel'  => 'verge_featposts'
	    )
	);
	
	$wp_customize->add_setting(
		'verge_fn2_enable',
		array( 'sanitize_callback' => 'verge_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'verge_fn2_enable', array(
		    'settings' => 'verge_fn2_enable',
		    'label'    => __( 'Enable', 'verge' ),
		    'section'  => 'verge_a_fn2_boxes',
		    'type'     => 'checkbox',
		)
	);	
	
	$wp_customize->add_setting(
		'verge_fn2_title',
		array( 
			'sanitize_callback' => 'sanitize_text_field',
			'default' => __('Featured Posts','verge')
		 )
	);
	
	$wp_customize->add_control(
			'verge_fn2_title', array(
		    'settings' => 'verge_fn2_title',
		    'label'    => __( 'Section Title' , 'verge' ),
		    'section'  => 'verge_a_fn2_boxes',
		    'type'     => 'text',
		)
	);	
 
 	$wp_customize->add_setting(
	    'verge_fn2_cat',
	    array( 'sanitize_callback' => 'verge_sanitize_category' )
	);
	
	$wp_customize->add_control(
	    new Verge_WP_Customize_Category_Control(
	        $wp_customize,
	        'verge_fn2_cat',
	        array(
	            'label'    => __('Posts Category.','verge'),
	            'settings' => 'verge_fn2_cat',
	            'section'  => 'verge_a_fn2_boxes'
	        )
	    )
	);	
	
	//FEATURED CARDS
	$wp_customize->add_section(
	    'verge_a_fn3_boxes',
	    array(
	        'title'     => __('Featured Cards (Tall Images)','verge'),
	        'priority'  => 35,
	        'panel'  => 'verge_featposts'
	    )
	);
	
	$wp_customize->add_setting(
		'verge_fn3_enable',
		array( 'sanitize_callback' => 'verge_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'verge_fn3_enable', array(
		    'settings' => 'verge_fn3_enable',
		    'label'    => __( 'Enable Featured Posts', 'verge' ),
		    'section'  => 'verge_a_fn3_boxes',
		    'type'     => 'checkbox',
		)
	);	
	
	$wp_customize->add_setting(
		'verge_fn3_title',
		array( 
			'sanitize_callback' => 'sanitize_text_field',
			'default' => __('Trending Posts','verge')
		 )
	);
	
	$wp_customize->add_control(
			'verge_fn3_title', array(
		    'settings' => 'verge_fn3_title',
		    'label'    => __( 'Section Title' , 'verge' ),
		    'section'  => 'verge_a_fn3_boxes',
		    'type'     => 'text',
		)
	);
 
 	$wp_customize->add_setting(
	    'verge_fn3_cat',
	    array( 'sanitize_callback' => 'verge_sanitize_category' )
	);
	
	$wp_customize->add_control(
	    new Verge_WP_Customize_Category_Control(
	        $wp_customize,
	        'verge_fn3_cat',
	        array(
	            'label'    => __('Posts Category.','verge'),
	            'settings' => 'verge_fn3_cat',
	            'section'  => 'verge_a_fn3_boxes'
	        )
	    )
	);	
			
	//FEATURED POSTS for Homepage
	$wp_customize->add_panel( 'verge_featposts', array(
	    'priority'       => 30,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Featured Posts (Homepage)','verge'),
	) );
	

		
	// Layout and Design
	$wp_customize->add_panel( 'verge_design_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Design & Layout','verge'),
	) );
	
	$wp_customize->add_section(
	    'verge_design_options',
	    array(
	        'title'     => __('Blog Layout','verge'),
	        'priority'  => 0,
	        'panel'     => 'verge_design_panel'
	    )
	);
		
	$wp_customize->add_setting(
		'verge_blog_layout',
		array( 'sanitize_callback' => 'verge_sanitize_blog_layout', 'default' => 'verge' )
	);
	
	function verge_sanitize_blog_layout( $input ) {
		if ( in_array($input, array('grid','grid_2_column','grid_3_column','verge') ) )
			return $input;
		else 
			return '';	
	}
	
	$wp_customize->add_control(
		'verge_blog_layout',array(
				'label' => __('Select Layout','verge'),
				'settings' => 'verge_blog_layout',
				'section'  => 'verge_design_options',
				'type' => 'select',
				'choices' => array(
						'verge' => __('Verge Theme Layout','verge'),
						'murray' => __('Murray Layout','verge'),
						'grid' => __('Basic Blog Layout','verge'),
						'grid_2_column' => __('Grid - 2 Column','verge'),
						'grid_3_column' => __('Grid - 3 Column','verge'),
						
					)
			)
	);
	
	//Choose Single Page Layout
	$wp_customize->add_setting(
		'verge_single_layout',
		array( 'sanitize_callback' => 'verge_sanitize_single_layout', 'default' => 'gradial-layout' )
	);
	
	function verge_sanitize_single_layout( $input ) {
		if ( in_array($input, array('gradial-layout','default-layout') ) )
			return $input;
		else 
			return '';	
	}
	
	$wp_customize->add_control(
		'verge_single_layout',array(
				'label' => __('Select Single Posts Page Layout','verge'),
				'settings' => 'verge_single_layout',
				'section'  => 'verge_design_options',
				'type' => 'select',
				'choices' => array(
						'gradial-layout' => __('Right Gradient Layout','verge'),
						'default-layout' => __('Verge Layout','verge'),
						
						
					)
			)
	);
	
	$wp_customize->add_section(
	    'verge_sidebar_options',
	    array(
	        'title'     => __('Sidebar Layout','verge'),
	        'priority'  => 0,
	        'panel'     => 'verge_design_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'verge_disable_sidebar',
		array( 'sanitize_callback' => 'verge_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'verge_disable_sidebar', array(
		    'settings' => 'verge_disable_sidebar',
		    'label'    => __( 'Disable Sidebar Everywhere.','verge' ),
		    'section'  => 'verge_sidebar_options',
		    'type'     => 'checkbox',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'verge_disable_sidebar_home',
		array( 'sanitize_callback' => 'verge_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'verge_disable_sidebar_home', array(
		    'settings' => 'verge_disable_sidebar_home',
		    'label'    => __( 'Disable Sidebar on Home/Blog.','verge' ),
		    'section'  => 'verge_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'verge_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'verge_disable_sidebar_front',
		array( 'sanitize_callback' => 'verge_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'verge_disable_sidebar_front', array(
		    'settings' => 'verge_disable_sidebar_front',
		    'label'    => __( 'Disable Sidebar on Front Page.','verge' ),
		    'section'  => 'verge_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'verge_show_sidebar_options',
		    'default'  => false
		)
	);
	
	
	$wp_customize->add_setting(
		'verge_sidebar_width',
		array(
			'default' => 4,
		    'sanitize_callback' => 'verge_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'verge_sidebar_width', array(
		    'settings' => 'verge_sidebar_width',
		    'label'    => __( 'Sidebar Width','verge' ),
		    'description' => __('Min: 25%, Default: 33%, Max: 40%','verge'),
		    'section'  => 'verge_sidebar_options',
		    'type'     => 'range',
		    'active_callback' => 'verge_show_sidebar_options',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 5,
		        'step'  => 1,
		        'class' => 'sidebar-width-range',
		        'style' => 'color: #0a0',
		    ),
		)
	);
	
	/* Active Callback Function */
	function verge_show_sidebar_options($control) {
	   
	    $option = $control->manager->get_setting('verge_disable_sidebar');
	    return $option->value() == false ;
	    
	}
	
	$wp_customize-> add_section(
    'verge_custom_footer',
    array(
    	'title'			=> __('Custom Footer Text','verge'),
    	'description'	=> __('Enter your Own Copyright Text.','verge'),
    	'priority'		=> 11,
    	'panel'			=> 'verge_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'verge_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'verge_footer_text',
	        array(
	            'section' => 'verge_custom_footer',
	            'settings' => 'verge_footer_text',
	            'type' => 'text'
	        )
	);	
	
	$wp_customize->add_section(
	    'verge_sec_upgrade',
	    array(
	        'title'     => __('Upgrade to Verge Plus','verge'),
	        'priority'  => 1,
	    )
	);
	
	$wp_customize->add_setting(
			'verge_upgrade',
			array( 'sanitize_callback' => 'esc_textarea' )
		);
			
	$wp_customize->add_control(
	    new Verge_WP_Customize_Upgrade_Control(
	        $wp_customize,
	        'verge_upgrade',
	        array(
	            'label' => __('Thank You','verge'),
	            'description' => __('Thank You for Choosing Verge. Verge Plus is a Powerful Wordpress theme which also supports WooCommerce in the best possible way. It is "as we say" the last theme you would ever need. It has all the basic and advanced features needed to run a gorgeous looking site. If you are looking for more features and to support the themes we develop for free, please  <a href="https://inkhive.com/product/verge-plus/">purchase Verge Plus</a>.','verge'),
	            'section' => 'verge_sec_upgrade',
	            'settings' => 'verge_upgrade',			       
	        )
		)
	);
	
	$wp_customize->add_section(
	    'verge_typo_options',
	    array(
	        'title'     => __('Google Web Fonts','verge'),
	        'priority'  => 41,
	    )
	);
	
	$font_array = array('Fjalla One','PT Sans','Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','PT Sans','Ubuntu','Lobster','Arimo','Bitter','Noto Sans');
	$fonts = array_combine($font_array, $font_array);
	
	$wp_customize->add_setting(
		'verge_title_font',
		array(
			'default'=> 'Fjalla One',
			'sanitize_callback' => 'verge_sanitize_gfont' 
			)
	);
	
	function verge_sanitize_gfont( $input ) {
		if ( in_array($input, array('Source Sans Pro','PT Sans','Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','PT Sans','Ubuntu','Lobster','Arimo','Bitter','Noto Sans') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
		'verge_title_font',array(
				'label' => __('Title','verge'),
				'settings' => 'verge_title_font',
				'section'  => 'verge_typo_options',
				'type' => 'select',
				'choices' => $fonts,
			)
	);
	
	$wp_customize->add_setting(
		'verge_body_font',
			array(	'default'=> 'PT Sans',
					'sanitize_callback' => 'verge_sanitize_gfont' )
	);
	
	$wp_customize->add_control(
		'verge_body_font',array(
				'label' => __('Body','verge'),
				'settings' => 'verge_body_font',
				'section'  => 'verge_typo_options',
				'type' => 'select',
				'choices' => $fonts
			)
	);
	
	// Social Icons
	$wp_customize->add_section('verge_social_section', array(
			'title' => __('Social Icons','verge'),
			'priority' => 44 ,
	));
	
	$wp_customize->add_setting(
		'verge_social_loc',
			array(	'default'=> 'all',
					'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
		'verge_social_loc',array(
				'label' => __('Social Icon Location','verge'),
				'settings' => 'verge_social_loc',
				'section'  => 'verge_social_section',
				'type' => 'select',
				'choices' => array( //Redefinied in Sanitization Function.
					'all' => __('Everywhere','verge'),
					'headfoot' => __('Header & Footer','verge'),
					'floating' => __('Left Sticky Floating','verge')
				)
			)
	);
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','verge'),
					'facebook' => __('Facebook','verge'),
					'twitter' => __('Twitter','verge'),
					'google-plus' => __('Google Plus','verge'),
					'instagram' => __('Instagram','verge'),
					'rss' => __('RSS Feeds','verge'),
					'vine' => __('Vine','verge'),
					'vimeo-square' => __('Vimeo','verge'),
					'youtube' => __('Youtube','verge'),
					'flickr' => __('Flickr','verge'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :
			
		$wp_customize->add_setting(
			'verge_social_'.$x, array(
				'sanitize_callback' => 'verge_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'verge_social_'.$x, array(
					'settings' => 'verge_social_'.$x,
					'label' => __('Icon ','verge').$x,
					'section' => 'verge_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'verge_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'verge_social_url'.$x, array(
					'settings' => 'verge_social_url'.$x,
					'description' => __('Icon ','verge').$x.__(' Url','verge'),
					'section' => 'verge_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function verge_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook',
					'twitter',
					'google-plus',
					'instagram',
					'rss',
					'vine',
					'vimeo-square',
					'youtube',
					'flickr'
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}	
	
	
	/* Sanitization Functions Common to Multiple Settings go Here, Specific Sanitization Functions are defined along with add_setting() */
	function verge_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}
	
	function verge_sanitize_positive_number( $input ) {
		if ( ($input >= 0) && is_numeric($input) )
			return $input;
		else
			return '';	
	}
	
	function verge_sanitize_category( $input ) {
		if ( term_exists(get_cat_name( $input ), 'category') )
			return $input;
		else 
			return '';	
	}
	
	
}
add_action( 'customize_register', 'verge_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function verge_customize_preview_js() {
	wp_enqueue_script( 'verge_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'verge_customize_preview_js' );
