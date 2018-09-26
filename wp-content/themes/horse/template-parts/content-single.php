<?php

/**

 * The template part for displaying single posts

 *

 * @package WordPress

 * @subpackage Twenty_Sixteen

 * @since Twenty Sixteen 1.0

 */

?>

<?php $pos = strpos($_SERVER['REQUEST_URI'], 'partners/');if ($pos === false) {?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->



	<?php twentysixteen_excerpt(); ?>



	<?php //twentysixteen_post_thumbnail(); ?>



	<div class="entry-content">

		<?php

			the_content();



			wp_link_pages( array(

				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',

				'after'       => '</div>',

				'link_before' => '<span>',

				'link_after'  => '</span>',

				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',

				'separator'   => '<span class="screen-reader-text">, </span>',

			) );



			if ( '' !== get_the_author_meta( 'description' ) ) {

				get_template_part( 'template-parts/biography' );

			}

		?>

	</div><!-- .entry-content -->



	<footer class="entry-footer">

		<?php twentysixteen_entry_meta(); ?>

		<?php

			edit_post_link(

				sprintf(

					/* translators: %s: Name of current post */

					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),

					get_the_title()

				),

				'<span class="edit-link">',

				'</span>'

			);

		?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->

<?php }	else{ $pid = get_the_ID();
global $wpdb;
$link_array = explode('/',rtrim($_SERVER['REQUEST_URI'], '/'));
$page_lurl= end($link_array);

$results_term = $wpdb->get_results( 'SELECT term_taxonomy_id FROM wp_term_taxonomy WHERE term_id = (select term_id from wp_terms where slug="'.$page_lurl.'")', ARRAY_A);
//echo "SELECT post_id FROM wp_postmeta WHERE meta_key = '_data_pet_pattern' and meta_value like '%".$results_term[0]['term_taxonomy_id']."%'";
$results_post = $wpdb->get_results( "SELECT post_id FROM wp_postmeta WHERE meta_key = '_data_pet_pattern' and meta_value like '%".$results_term[0]['term_taxonomy_id']."%'", ARRAY_A);
//print_r($results_term); 
//echo "<pre>";print_r($results_post);
?>
<style>#secondary{display: none;}</style>

<div class="productSlider">
		<div class="initCarousel">				
		<?php do_shortcode("[multiple_images post_id=$pid]"); ?>                
		</div>        
</div>        
<div class="product-name">            
	<div class="row">                
		<div class="medium-12 columns">                    
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>                
		</div>            
	</div>        
</div>        
<div class="main-content">            
	<div class="row">                
		<div class="medium-12 columns">                       
			<div class="product-description">   
				<?php the_content(); ?> 
			</div>                    
			
			<?php if(!empty($results_post)){ ?>
			<div class="productsSection">
				<div class="product-heading">                            
				<img src="http://blanketux.com/ariabeta/wp-content/themes/horse/images/heading-line.png" />                            
					<h2>In Partnership with aria</h2>                            
				<img src="http://blanketux.com/ariabeta/wp-content/themes/horse/images/heading-line.png" />                        </div>                        
					<ul class="medium-block-grid-3 small-block-grid-1">
					<?php foreach($results_post as $k=>$v){						
						$get_horse_details = get_post($v[post_id]);
						$get_horse_details_meta = get_post_meta($v[post_id]);
						//echo '<pre>';print_r($get_horse_details);
						//echo $get_horse_details_meta['_thumbnail_id'][0];
						$results_img = $wpdb->get_results( 'SELECT guid FROM wp_posts WHERE ID ='.$get_horse_details_meta['_thumbnail_id'][0], ARRAY_A);
						
						//$gender = get_post_meta($v[post_id], '_data_pet_gender', true);
						//print_r($gender);
						?>
					<li><a href="<?php echo $get_horse_details->guid; ?>"><img src="<?php echo $results_img[0]['guid'];?>" /></a>
					<h2><a href="<?php echo $get_horse_details->guid; ?>"><?php echo $get_horse_details->post_title; ?></a></h2>
					<!--<p>Al Ayad × Baraaqa AA)</p>
					<p class="small">2008 GREY PUREBRED ARABIAN STALLLION</p>-->
					</li>
					<?php } ?>
			</div> 
			<?php } ?>	
		</div>
    </div>        
</div>
<?php }?>		

