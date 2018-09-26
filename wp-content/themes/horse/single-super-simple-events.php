<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
get_header(); ?>
    <?php while ( have_posts() ) : the_post(); ?>        
        <div class="basic-page-content">
            <div class="row">
                <div class="medium-12 columns">
                    <div class="row basic-text">
                        <div class="large-10 medium-12 small-12 large-centered columns">
                            <h1><?php the_title(); ?></h1>
                            <h3>Story by <span class="capitalize"><?php echo get_author_name(); ?></span></h3>
                            <div class="separator m-tb30"><img src="http://blanketux.com/ariabeta/wp-content/uploads/2017/08/separator3.png" /></div>
                            <div class="row">
                                <div class="medium-10 small-12 medium-centered columns">
                                    <?php the_content(); ?>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <hr />
                    <?php echo do_shortcode('[sb name="Share-icon"]'); ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php get_footer(); ?>
