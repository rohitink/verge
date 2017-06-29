<?php
/**
 * verge functions and definitions
 *
 * @package verge
 */


if ( ! function_exists( 'verge_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function verge_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on verge, use a find and replace
	 * to change 'verge' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'verge', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 *
	 */
	add_theme_support( 'title-tag' );
	
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	if ( ! isset( $content_width ) ) {
		$content_width = 640; /* pixels */
	}
	
	/*
	 * Custom Logo Support 
	 *
	 */ 	 
	 add_theme_support('custom-logo',array(
		 'height' => 80,
		 'width' => 300,
		 'flex-height' => true,
		 'flex-width' => true
	 ));

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'verge' ),
		'footer' => __( 'Footer Menu', 'verge' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'verge_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	//RT Slider Support
	add_theme_support( 'rt-slider' );
	
	
	add_image_size('verge-pop-thumb',542, 340, true );
	add_image_size('verge-pop-thumb-lg',787, 419, true );
	add_image_size('verge-sq-thumb',542, 542, true );
	add_image_size('verge-tall-thumb',542, 700, true );
	add_image_size('verge-thumb',870, 430, true );
}
endif; // verge_setup
add_action( 'after_setup_theme', 'verge_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function verge_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'verge' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'verge' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'verge' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'verge' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
	
}
add_action( 'widgets_init', 'verge_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function verge_scripts() {
	wp_enqueue_style( 'verge-style', get_stylesheet_uri() );
	
	wp_enqueue_style('verge-title-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", esc_html(get_theme_mod('verge_title_font', 'Raleway') ).':100,300,400,700' ));
	
	wp_enqueue_style('verge-body-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", esc_html(get_theme_mod('verge_body_font', 'Khula') ).':100,300,400,700' ));
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );
	
	wp_enqueue_style( 'nivo-slider', get_template_directory_uri() . '/assets/css/nivo-slider.css' );
	
	wp_enqueue_style( 'nivo-skin', get_template_directory_uri() . '/assets/css/nivo-default/default.css' );
	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );
	
	wp_enqueue_style( 'hover-style', get_template_directory_uri() . '/assets/css/hover.min.css' );
	
	wp_enqueue_style( 'verge-main-theme-style', get_template_directory_uri() . '/assets/css/main.css' );
	
	wp_enqueue_script( 'verge-external', get_template_directory_uri() . '/js/external.js', array('jquery'), '20120206', true );

	wp_enqueue_script( 'verge-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_enqueue_script( 'verge-custom-js', get_template_directory_uri() . '/js/custom.js' );
}
add_action( 'wp_enqueue_scripts', 'verge_scripts' );

//Backwards Compatibility FUnction
function verge_logo() {	
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}

function verge_has_logo() {
	if (function_exists( 'has_custom_logo')) {
		if ( has_custom_logo() ) {
			return true;
		}
	} else {
		return false;
	}
}

//Function to Trim Excerpt Length & more..
function verge_excerpt_length( $length ) {
	return 23;
}
add_filter( 'excerpt_length', 'verge_excerpt_length', 999 );

function verge_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'verge_excerpt_more' );


/**
 * Enqueue Scripts for Admin
 */

function verge_custom_wp_admin_style() {
        wp_enqueue_style( 'verge-admin_css', get_template_directory_uri() . '/assets/css/admin.css' );
        wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );
	
}
add_action( 'customize_controls_print_styles', 'verge_custom_wp_admin_style' );

/**
 * Include the Custom Functions of the Theme.
 */
require get_template_directory() . '/framework/theme-functions.php';

/**
 * Implement the Custom CSS Mods.
 */
require get_template_directory() . '/inc/css-mods.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Include TGM Plugin.
 */
require get_template_directory() . '/framework/tgmpa.php';
