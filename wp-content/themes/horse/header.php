<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no; minimal-ui">
    <meta name="format-detection" content="telephone=no">
	<link rel="apple-touch-icon" sizes="57x57" href="http://assets.saharascottsdale.com/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="http://assets.saharascottsdale.com/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="http://assets.saharascottsdale.com/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="http://assets.saharascottsdale.com/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="http://assets.saharascottsdale.com/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="http://assets.saharascottsdale.com/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="http://assets.saharascottsdale.com/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="http://assets.saharascottsdale.com/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="http://assets.saharascottsdale.com/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="http://assets.saharascottsdale.com/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="http://assets.saharascottsdale.com/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="http://assets.saharascottsdale.com/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="http://assets.saharascottsdale.com/favicon-16x16.png">
	<link rel="manifest" href="http://assets.saharascottsdale.com/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="http://assets.saharascottsdale.com/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.js"></script>
	<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
    <?php wp_head(); ?>
    <style>
        html {
            margin-top: 0 !important;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- Push Wrapper -->
        <div class="mp-pusher" id="mp-pusher">

            <!-- mp-menu-->
            <nav id="mp-menu" class="mp-menu">
                <div class="mp-level">
                    <h2>
                        <img class="sahara_logo_mobile" src="<?php echo get_template_directory_uri() ?>/images/sahara-mobile-logo.png" />
                    </h2>
                        <ul>
                            <li><a href="<?php echo get_site_url() ?>">Home</a></li>
                            <li><a href="<?php echo get_site_url() ?>/about-us">About Us</a></li>
                            <li>
                                <a href="#">Breeding</a>
                                <ul>
                                    <li>
                                        <div class="mp-level">
                                            <h2>Breeding</h2>
                                            <a class="mp-back" href="#">back</a>
                                            <ul>
                                                <li><a href="<?php echo get_site_url() ?>/breeding-mares">Breeding Mares</a></li>
                                                <li><a href="<?php echo get_site_url() ?>/breeding-stallions">Breeding Stallions</a></li>
                                                <li><a href="<?php echo get_site_url() ?>/production">Production</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                             </li>
                            <li><a href="<?php echo get_site_url() ?>/stallions">Stallions</a></li>
                            <li><a href="<?php echo get_site_url() ?>/show-string">Show String</a></li>
                            <li><a href="<?php echo get_site_url() ?>/news">news</a></li>
                            <li><a href="<?php echo get_site_url() ?>/contact">contact</a></li>
                        </ul>
            </nav>
            <div class="scroller"><!-- this is for emulating position fixed of the nav -->
                <div class="scroller-inner">
                    <div id="wrapper" class="site">
                        <?php if(is_home() || is_front_page()) { ?>
                            <div class="header">
                                <div id="st-trigger-effects"><button class="mobile-btn" id="trigger">&#9776;</button></div>
                                <a href="<?php echo get_site_url() ?>" class="head-logo-link">
                                <img class="sahara_logo" src="<?php echo get_template_directory_uri() ?>/images/sahara-homepage-logo.png" srcset="<?php echo get_template_directory_uri() ?>/images/sahara-homepage-logo@2x.png 2x"/>
                                </a>
                            </div>
                            <div class="down">
                                <div class="down-circle">
                                    <a href="#menu-boxes"><img class="down-arrow" src="<?php echo get_template_directory_uri() ?>/images/down_arrow.svg"/></a>
                                </div>
                            </div>
                        <?php }

                        else { ?>
                        <div class="header subpage row full-row">
                            <div id="st-trigger-effects"><button class="mobile-btn" id="trigger">&#9776;</button></div>
                            <a href="<?php echo get_site_url() ?>">
                                <div id="footer-logo"></div>
                            </a>
                        </div>
        <script>
        </script>
<?php } ?>
