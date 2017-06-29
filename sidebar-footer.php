<?php
/*
 * The Footer Widget Area
 * @package verge
 */
 ?>
 </div><!--.mega-container-->
 <?php if ( is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') ) : ?>
	 <div id="footer-sidebar" class="widget-area">
		 <div id="footer-bar" class="container">
			 
			 <?php if ( get_theme_mod('verge_social_loc') == 'headfoot' || get_theme_mod('verge_social_loc') == 'all') : ?>
			 <div id="footer-social">
			 	<?php get_template_part('social', 'fa');?> 
			 </div>
			 <?php endif; ?>
			 
			 <div id="footer-menu">
		 	<?php wp_nav_menu(array('theme_location' => 'footer')); ?>
			 </div>
		 </div>
	 	<div class="footer-container container">
		 	<?php 
				if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<div class="footer-column col-md-4 col-sm-4"> 
						<?php dynamic_sidebar( 'footer-1'); ?> 
					</div> 
				<?php endif;
					
				if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<div class="footer-column col-md-4 col-sm-4"> 
						<?php dynamic_sidebar( 'footer-2'); ?> 
					</div> 
				<?php endif;
		
				if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<div class="footer-column col-md-4 col-sm-4"> <?php
						dynamic_sidebar( 'footer-3'); ?> 
					</div>
				<?php endif; ?>
				
				
	 	</div>
	 </div>	<!--#footer-sidebar-->	
<?php endif; ?>