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
                    <h1 class="PlayfairDisplay">The aria collection</h1>
                </div>
            </div>        
        </div>
	<div class="main-content">
            <div class="row">
                <div class="medium-12 columns">
                    <div class="category-menu">
					<?php 
					$terms = get_terms( 'pet-gender','orderby=count&hide_empty=0' );
					   if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
					foreach ( $terms as $term ) {
                         if(strtolower($term->name)=='stallion'){
						
						   $subarray = array();
						   $subarray['url']= esc_url( get_term_link( $term ) );
						   $subarray['name']= 'stallions'; 
						   $subarray['slug']= $term->slug;
						   $termarray[0]= $subarray;
                          }
						  if(strtolower($term->name)=='mare') {
						   $subarray = array();
						   $subarray['url']= esc_url( get_term_link( $term ) );
						   $subarray['name']= 'mares';
						   $subarray['slug']= $term->slug;
						   $termarray[1]=$subarray;
                          }
						  if(strtolower($term->name)=='colt') {
						 
						   $subarray = array();
						   $subarray['url']= esc_url( get_term_link( $term ) );
						   $subarray['name']= 'colts';
						   $subarray['slug']= $term->slug;
						   $termarray[2]=$subarray;
                          }
						  if(strtolower($term->name)=='filly'){ 
						   $subarray = array();
						   $subarray['url']= esc_url( get_term_link( $term ) );
						   $subarray['name']= 'fillies';
						   $subarray['slug']= $term->slug;
						   $termarray[3]=$subarray;
                          }
						}  
						ksort($termarray);
                    echo '<ul>';
					echo "<li><a href='".site_url('/pet/')."'>Collection</a></li>";
                         foreach ( $termarray as $term ) {
						    if(get_query_var( 'term' )==$term['slug']){
							 $class="active";
							}else
							{
							$class="";
							}
                          echo "<li><a class='".$class."' href='" . $term['url']. "'>" . $term['name'] . "</a></li>";
                       }
                    echo '</ul>';
                   }
                    
					?>  
                        
                    </div>
					<?php if ( have_posts() ) : ?>
                    <div class="productsSection">
                        <ul class="medium-block-grid-3 small-block-grid-1">
				 <?php
					// Start the Loop.
					while ( have_posts() ) : the_post(); ?>
                            <li>
                                <a href="">
								<?php if (has_post_thumbnail() && !post_password_required()) : ?>			
	<a href="<?php echo esc_url( get_permalink())?>"><?php the_post_thumbnail(); ?></a>
		<?php endif ;?>
								<!--<img src="<?php //echo get_template_directory_uri();?>/images/product1.jpg" /></a>-->
								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
								<?php the_excerpt(); ?>
                                <!--<p>Al Ayad × Baraaqa AA)</p>
                                <p class="small">2008 GREY PUREBRED ARABIAN STALLLION</p>-->
                            </li>
                  <?php 
				  // End the loop.
			     endwhile; 
				 ?>         
                        </ul>
                    </div>
					<?php 
					// If no content, include the "No posts found" template.
					else :
						get_template_part( 'template-parts/content', 'none' );

						endif;
				   ?>
                </div>
            </div>
        </div>
<?php get_footer(); ?>