<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary-page" class="content-area-desging">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post(); 
		?>
		<!--<div class="banner-section">            
            <div class="row">
                <div class="medium-12 columns">
                    <h1 class="PlayfairDisplay"><?php the_title() ?></h1>
                </div>
            </div>        
        </div>-->
	   <?php  the_content(); ?>
		<?php endwhile;
		?>

</div>


<?php get_footer(); ?>
