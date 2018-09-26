<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
                <div id="footer" class="row full-row">
                        <a href="<?php echo get_site_url() ?>"><div id="footer-logo">
                        </div></a>
                    <div class="row foot-nav">
                        <ul>
                            <li><a href="<?php echo get_site_url() ?>/about-us">about us</a></li>
                            <li><a href="<?php echo get_site_url() ?>/news">news</a></li>
                            <li><a href="<?php echo get_site_url() ?>/sahara-collection">collection</a></li>
                            <li><a href="<?php echo get_site_url() ?>/contact">contact</a></li>
                        </ul>
                        <ul id="social-footer">
                            <li><a target="_blank" href="https://www.facebook.com/SaharaScottsdale/"><i class="fab fa-facebook-square"></i></a></li>
                            <!--<li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fab fa-vimeo"></i></a></li>-->
                        </ul>
                    </div>

                    <div class="row full-row">
                        <div id="masthead">
                            <p><a href="<?php echo get_site_url() ?>/wp-admin" style="text-decoration:none;color:inherit;">&copy;</a> SAHARA SCOTTSDALE</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /scroller inner -->
     </div><!-- /scroller -->
    </div><!-- /pusher -->

</div><!-- /container -->
<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/classie.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/mlpushmenu.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
  jQuery('.image-link').magnificPopup({type:'image'});
});

new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ), {
    type: 'cover'
} );

</script>
</body>
</html>
