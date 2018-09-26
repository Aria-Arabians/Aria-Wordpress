<?php
/**
 * Template Name: Basic Page
 *
 */
get_header(); ?>
<div id="primary-page" class="content-area-desging">
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="basic-page-content">
            <div class="row">
                <div class="medium-12 columns">
	               <?php  the_content(); ?>
                </div>
            </div>
        </div>
	<?php endwhile; ?>
</div>
<?php get_footer(); ?>