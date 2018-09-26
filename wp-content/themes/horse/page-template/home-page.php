<?php
/**
 * Template Name: Home Page
 *
 */ ?>
<div class="home-page">
<?php get_header(); ?>
<div id="primary-page" class="content-area-desging">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post(); 
		?>
	   <?php  the_content(); ?>
		<?php endwhile;
		?>
</div>
<?php get_footer(); ?>
</div>