<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>
<div class="basic-page-content">
            <div class="row">
                <div class="medium-12 columns">
                    <div class="row basic-text">
                        <div class="large-10 medium-12 small-12 large-centered columns" style="min-height:500px;">
                            <h1 class="page-title text-center"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentysixteen' ); ?></h1>
                            <div class="separator m-tb30"><img src="http://blanketux.com/ariabeta/wp-content/uploads/2017/08/separator3.png" /></div>
                            <div class="row">
                                <div class="medium-10 small-12 medium-centered columns">
                                    <p class="text-center"><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentysixteen' ); ?></p>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
</div>
<?php get_footer(); ?>
