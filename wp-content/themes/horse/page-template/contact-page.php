<?php
/**
 * Template Name: Contact Page
 *
 */ 
get_header(); ?>
<div id="primary-page" class="content-area-desging contact-page">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post(); 
		?>
	   <?php  the_content(); ?>
		<?php endwhile;
		?>
</div>
<?php get_footer(); ?>