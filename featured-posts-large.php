<?php if ( get_theme_mod('verge_fn2_enable') && is_front_page() && !is_paged() ) : ?>
<div id="featured-news-large" class="container-fluid">
		    <div class="featured-news-container">
			    <div class="section-title">
			    	<span><?php echo get_theme_mod('verge_fn2_title', __('Featured Cards','verge')); ?></span>
			    	<div class="dots">
				    	<i class="fa fa-circle"></i><i class="fa fa-circle"></i><i class="fa fa-circle"></i>
				    </div>
			    </div>
	        <div class="fg-wrapper">
	            <?php
		            	$count = 1;
				        $args = array( 
			        	'post_type' => 'post',
			        	'posts_per_page' => 3, 
			        	'cat'  => esc_html( get_theme_mod('verge_fn2_cat',0) ),
			        	'ignore_sticky_posts' => 1,
			        	);
				        $loop = new WP_Query( $args );
				        while ( $loop->have_posts() ) : 
				        	$loop->the_post(); 
				        ?>
				        <div class="fg-item-container col-md-4 col-sm-4">
							<div class="fg-item">
								<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>">
									<?php the_post_thumbnail('verge-pop-thumb'); ?>
									<div class="border-layer"></div>
									<i class="fa fa-caret-down"></i>
									<div class="product-details">
										
										<h3><?php the_title(); ?></h3>
									</div>
								</a>
								
								</div>
						</div>					
						 <?php 
							 $count++;
							 endwhile; ?>
						 <?php wp_reset_postdata(); ?>
						
		        </div>	        
	    </div>
</div>
<?php endif; ?>