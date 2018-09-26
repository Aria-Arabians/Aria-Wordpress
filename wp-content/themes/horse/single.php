<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
get_header(); ?>
    <?php while ( have_posts() ) : the_post(); 
        echo horse_image_slider(get_the_ID());
    ?>        
        <div class="basic-page-content">
            <div class="row">
                <div class="medium-12 columns">
                    <div class="row basic-text">
                        <div class="large-10 medium-12 small-12 large-centered columns">
                            <h2><?php the_title(); ?></h2>
                            <!--<h3>Posted by <span class="capitalize">Colonial Wood<?php //echo get_author_name(); ?></span></h3>-->
                            <div class="row">
                                <div class="medium-10 small-12 medium-centered columns">
                                    <?php the_content(); ?>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <hr />
                    <?php echo do_shortcode('[social_icons]'); ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php get_footer(); ?>
