<?php

/*
Plugin Name: Sahara Scottsdale Login Page
Plugin URI: n/a
Description: Custom Sahara Scottsdale login page
Author: Andrew Farr
Version: 1.0
Author URI: http://adwtt.com
*/

function my_login_theme_style() {
    wp_enqueue_style('my-login-theme', plugins_url('wp-login.css', __FILE__));
}
add_action('login_enqueue_scripts', 'my_login_theme_style');

add_action( 'login_form', 'wpse17709_login_form' );
function wpse17709_login_form()
{
    add_filter( 'gettext', 'wpse17709_gettext', 10, 2 );
}

function wpse17709_gettext( $translation, $text )
{
    if ( 'Log In' == $text ) {
        return 'login';
    }
    return $translation;
}


?>