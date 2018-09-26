<?php
/**
 * Template Name: News Events
 *
 */
get_header(); ?>
        <div class="banner-section">            
            <div class="row">
                <div class="medium-12 columns">
                    <h1 class="PlayfairDisplay"><?php the_title()?></h1>
                </div>
            </div>        
        </div>
        <div class="main-content">
            <div class="row">
                <div class="medium-12 columns">
                    <div class="category-menu">
                        <ul class="tabs">
                            <li class="active"><a href="#Newsletters">Newsletters</a></li>
                            <li><a href="#Events">Events</a></li>
                            <li><a href="#blog-section">Blog</a></li>
                        </ul>
                    </div>
                    <div class="productsSection tab-content" id="Newsletters">
                        <ul class="medium-block-grid-4 small-block-grid-1">
                            <li>
                                <a href="<?php echo get_template_directory_uri();?>/images/newsletter1.jpg" class="image-link"><img src="<?php echo get_template_directory_uri();?>/images/newsletter1.jpg" /></a>
                            </li>
                            <li>
                                <a href="<?php echo get_template_directory_uri();?>/images/newsletter2.jpg" class="image-link"><img src="<?php echo get_template_directory_uri();?>/images/newsletter2.jpg" /></a>
                            </li>
                            <li>
                                <a href="<?php echo get_template_directory_uri();?>/images/newsletter3.jpg" class="image-link"><img src="<?php echo get_template_directory_uri();?>/images/newsletter3.jpg" /></a>                                
                            </li>
                            <li>
                                <a href="<?php echo get_template_directory_uri();?>/images/newsletter4.jpg" class="image-link"><img src="<?php echo get_template_directory_uri();?>/images/newsletter4.jpg" /></a>
                            </li>
                            <li>
                                <a href="<?php echo get_template_directory_uri();?>/images/newsletter5.jpg" class="image-link"><img src="<?php echo get_template_directory_uri();?>/images/newsletter5.jpg" /></a>
                            </li>
                            <li>
                                <a href="<?php echo get_template_directory_uri();?>/images/newsletter6.jpg" class="image-link"><img src="<?php echo get_template_directory_uri();?>/images/newsletter6.jpg" /></a>                                
                            </li>
                            <li>
                                <a href="<?php echo get_template_directory_uri();?>/images/newsletter7.jpg" class="image-link"><img src="<?php echo get_template_directory_uri();?>/images/newsletter7.jpg" /></a>
                            </li>
                            <li>
                                <a href="<?php echo get_template_directory_uri();?>/images/newsletter8.jpg" class="image-link"><img src="<?php echo get_template_directory_uri();?>/images/newsletter8.jpg" /></a>
                            </li>
                        </ul>
                    </div>
					<?php 
	$event_args = array(
			'post_type' => 'super-simple-events',
			'posts_per_page' => 10,
			'orderby' => 'meta_value',
			'order' => 'ASC',
 			'meta_key' => 'sse_start_date_alt',
			'meta_query' => array(
							  array(
								'key' => 'between_dates',
								'value' => date( 'Y-m-d H:i:s', strtotime( '+1 days',current_time( 'timestamp'))),
								'compare' => '>='
						 	  )
							)
				
		);
		$events = new WP_Query( $event_args );
?>

                    <div class="productsSection tab-content hide" id="Events">
                        <ul class="medium-block-grid-3 small-block-grid-1 events-list">
                            <?php if($events->have_posts()):?>
             
	<?php 
	 $i=1;
	while ( $events->have_posts() ) : $events->the_post(); ?>
	                  <li class="<?php echo  ($i==1)?'grey':''?>">
                       <a href="<?php echo esc_url( get_permalink() ); ?>">
					   <?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail(); ?>
						<?php endif; ?></a>
						<?php $start_date_post = get_post_meta( get_the_ID(), 'sse_start_date_alt',true );
						
			if(!empty($start_date_post)){ ?>
			<div class="date"><?php echo date_i18n('d', strtotime($start_date_post));?><span><?php echo date_i18n('M', strtotime($start_date_post));?></span></div>
				<?php 
				}
				?>
                        
                        <h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
                            </li>
		
			
		
	<?php 
	$i++;
	endwhile; ?>


<?php else : ?>

	<div class="sse-widget-entry-title">
		No upcoming events
	</div>

<?php endif; ?>
                 </ul>
                    </div>
					 <?php
	  global $post;
$blogs = get_posts( array(
    'posts_per_page' => 10,
	'post_type' => 'post',
	'category' => 58,
	'post_status' => 'publish'
) );
	  ?>
                <div class="productsSection tab-content hide" id="blog-section">
                        <ul class="medium-block-grid-3 small-block-grid-1 blog-list eq-parent">
                            <?php if ( $blogs ) {
							$j = 1;
    foreach ( $blogs as $post ) :
        setup_postdata( $post ); ?>
		<li class="<?php echo  ($j==1)?'grey':''?> eq-child">
		   <!--<a href=""><img src="images/blog-img1.jpg" /></a>-->
		   <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
							
								<?php the_post_thumbnail(); ?>
							
							<?php endif; ?>
		    
            <h2><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>
           <?php $content = get_the_content();
                 $trimmed_content = wp_trim_words( $content, 20, '...' ); ?>
           <p><?php echo $trimmed_content; ?></p>
          </li>
       
    <?php
	$j++;
    endforeach; 
    wp_reset_postdata();
}
		 ?>
       
                        </ul>
                    </div>
                </div>
            </div>
        </div>
       <?php get_footer(); ?>
