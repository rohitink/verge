<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package verge
 */

get_header(); ?>

	<div id="primary" class="content-areas <?php do_action('verge_primary-width') ?>">
		<?php if (is_home()) : ?>
			<div class="section-title">
		    	<span><?php _e('From Our Blog','verge'); ?></span>
		    	<div class="dots">
			    	<i class="fa fa-circle"></i><i class="fa fa-circle"></i><i class="fa fa-circle"></i>
			    </div>
		    </div>
		<?php endif; ?>
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 */
					do_action('verge_blog_layout'); 
					
				?>

			<?php endwhile; ?>

			<?php verge_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
