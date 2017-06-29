<?php
/**
 * @package verge
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div id="featured-image">
			<?php the_post_thumbnail('full'); ?>
	</div>
			
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title title-font">', '</h1>' ); ?>
		
		
		<div class="entry-meta">
			<?php verge_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->		
			
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
