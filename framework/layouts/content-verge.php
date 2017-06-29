<?php
/**
 * @package Verge
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('grid verge col-md-4 grid_3_column'); ?>>


		<div class="featured-thumb col-md-12">
			<?php if (has_post_thumbnail()) : ?>	
				<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_post_thumbnail('verge-sq-thumb'); ?></a>
			<?php else: ?>
				<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder-sq.png"; ?>"></a>
			<?php endif; ?>
		</div><!--.featured-thumb-->
			
		<div class="out-thumb col-md-12">
			<header class="entry-header">
					<h1 class="entry-title body-font"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
					<div class="postedon"><?php verge_posted_on_date(); ?></div>
				</header><!-- .entry-header -->
		</div>
		
</article><!-- #post-## -->