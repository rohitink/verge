<?php if ( get_theme_mod('verge_fn_enable') && is_front_page() && !is_paged() ) : ?>
<div id="featured-news" class="container">
		    <div class="featured-news-container">
			    
	        <div class="fg-wrapper">
	            <?php
		            	$count = 1;
				        $args = array( 
			        	'post_type' => 'post',
			        	'posts_per_page' => 3, 
			        	'cat'  => esc_html( get_theme_mod('verge_fn_cat',0) ),
			        	'ignore_sticky_posts' => 1,
			        	);
				        $loop = new WP_Query( $args );
				        
				        while ( $loop->have_posts() ) : 
				        	$loop->the_post(); 
				        ?>
				        <?php
						  $perma_cat = get_post_meta($post->ID , '_category_permalink', true);
						  if ( $perma_cat != null ) {
						    $cat_id = $perma_cat['category'];
						    $category = get_category($cat_id);
						  } else {
						    $categories = get_the_category();
						    $category = $categories[0];
						  }
						  $category_link = get_category_link($category);
						  $category_name = $category->name;  
						?>                                   

						<div class="fg-item-container">
							<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>">
							<div class="fg-item">
								<div class="gradient-layer"></div>
								
									<?php if ($count == 1) 
										the_post_thumbnail('verge-pop-thumb-lg');
										else
											the_post_thumbnail('verge-pop-thumb'); ?>
									<div class="product-details">
										<a class="cat-link" href="<?php echo $category_link ?>"><?php echo $category_name ?></a>
										<h3><a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_title(); ?></a></h3>
									</div>
								</div>
							</a>	
						</div>
										
						 <?php 
							 $count++;
							 endwhile; ?>
						 <?php wp_reset_postdata(); ?>
						
		        </div>	        
	    </div>
</div>
<?php endif; ?>