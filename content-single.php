<?php
/**
 * @package verge
 */
$post_class = get_theme_mod('verge_single_layout','gradial-layout'); 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>

	<div id="featured-image">
			<?php the_post_thumbnail('full'); ?>
			<div class="gradient">
				
			</div>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title title-font">', '</h1>' ); ?>				
								
				<div class="entry-meta">
					<?php verge_posted_on_icon(); ?>
				</div><!-- .entry-meta -->
			</header><!-- .entry-header -->	
	</div>
			
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'verge' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php verge_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
