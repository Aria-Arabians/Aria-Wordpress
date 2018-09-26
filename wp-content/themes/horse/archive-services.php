<?php
/**
 *
 * Archive page
 *
 **/

get_header();?>

<div class="banner-section">
            <div class="row">
                <div class="medium-12 columns">
                    <h1 class="PlayfairDisplay">Aria Client Services</h1>
                </div>
            </div>        
        </div>
            <div class="row">
                <div class="large-12 medium-12 columns">
					<?php if ( have_posts() ) : ?>
						 <?php
							 global $wp_the_query;

							 $flipper = 1;

							$wp_the_query->posts = array_reverse($wp_the_query->posts);
							// Start the Loop.
							while ( have_posts() ) : the_post(); ?>
								<div class="client-services-block">
		                            <div class="row eq-parent <?php if ($flipper % 2 == 0) { echo "flipped"; } ?>">
		                            	<div class="large-7 medium-6 columns eq-child">
											<?php if (has_post_thumbnail() && !post_password_required()) : ?>			
												<div class="img-block"><?php the_post_thumbnail('large'); ?></div>
											<?php endif ;?>
										</div>
										<div class="large-5 medium-6 columns eq-child">
										<?php the_title( sprintf( '<h2>', esc_url( get_permalink() ) ), '</h2>' ); ?>
										<h3>Aria International Services</h3>
										<div class="separator text-left"><img src="http://aria.testsite/wp-content/themes/horse/images/separator2.png"></div>
										<?php the_excerpt(); ?>	
		                                </div>
		                            </div>
	                            </div>
		                  <?php 
		                  $flipper++;
						  // End the loop.
					     endwhile; 
						 ?>        
					<?php 
					// If no content, include the "No posts found" template.
					else :
						get_template_part( 'template-parts/content', 'none' );

						endif;
				   ?>
                </div>
            </div>
        
        <style>

	        .flipped {
	        	flex-direction: row-reverse !important;
	        }

	        .img-block {
	        	max-height: 382px;
			    overflow: hidden;
	        }

	        .eq-parent {
	        	display: flex;
	        	flex-direction: row;
	        }

	        .eq-parent:nth-of-type(even) {
	        	flex-direction: row-reverse;
	        }

	        .eq-child:nth-child(2) {
	        	display: flex;
	        	flex-direction: column;
	        	justify-content: center;
	        }
        </style>
<?php get_footer(); ?>