<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package verge
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'verge' ); ?></a>
	<div id="jumbosearch">
		<span class="fa fa-remove closeicon"></span>
		<div class="form">
			<?php get_search_form(); ?>
		</div>
	</div>	
	
	<?php if ( get_theme_mod('verge_social_loc') == 'floating' || get_theme_mod('verge_social_loc') == 'all') : ?>
	<div id="social-icons-fixed" title="<?php _e('Follow us on Social Media',''); ?>">
		<?php get_template_part('social', 'soshion'); ?>
	</div>	
	<?php endif; ?>
	
	<div id="top-bar">
		<div class="container">
			<div class="searchform">
				<?php get_template_part('searchform', 'top'); ?>
			</div>
			<?php if ( get_theme_mod('verge_social_loc') == 'headfoot' || get_theme_mod('verge_social_loc') == 'all') : ?>
			<div class="top-social-icons">
				<?php get_template_part('social', 'fa'); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
	
	<header id="masthead" class="site-header" role="banner">			
		<div class="container">
			<div class="site-branding">
				<?php if ( verge_has_logo() ) : ?>					
				<div id="site-logo">
					<?php verge_logo() ?>
				</div>
				<?php endif; ?>
				<div id="text-title-desc">
				<h1 class="site-title title-font"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</div>
			</div>
			
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<div class="nav-container">
					<?php
						// Get the Appropriate Walker First.
						if (has_nav_menu(  'primary' ) && !get_theme_mod('verge_disable_nav_desc',true) ) :
								$walker = new Verge_Menu_With_Icon;
						else :
								$walker = '';
						endif;
						//Display the Menu.							
						wp_nav_menu( array( 'theme_location' => 'primary', 'walker' => $walker ) ); ?>
				</div>
			</nav><!-- #site-navigation -->
			
			
		</div>	
	</header><!-- #masthead -->
		
	<?php if( class_exists('rt_slider') ) {
			 rt_slider::render('slider', 'nivo' ); 
		} ?>
		
		<?php get_template_part('featured', 'posts');?>
		<?php get_template_part('featured', 'posts-large');?>
		<?php get_template_part('featured', 'cards');?>
			
	<div class="mega-container">
	
		<div id="content" class="site-content container">