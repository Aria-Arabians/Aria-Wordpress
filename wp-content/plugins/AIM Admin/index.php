<?php

/*
Plugin Name: Aria International Manager - Admin Theme 
Plugin URI: n/a
Description: Admin theme for Horse management
Author: Andrew Farr
Version: 1.0
Author URI: http://adwtt.com
*/

function my_admin_theme_style() {
    wp_enqueue_style('my-admin-theme', plugins_url('wp-admin.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'my_admin_theme_style');
add_action('login_enqueue_scripts', 'my_admin_theme_style');

add_action('admin_head', 'remove_date_drop');
function remove_date_drop(){

$screen = get_current_screen();

    if ( 'team' == $screen->post_type ){
        add_filter('months_dropdown_results', '__return_empty_array');
    }
}

add_action( 'load-edit.php', 'page_status_filter' );
function page_status_filter() {

	$screen = get_current_screen();

	if ( 'post' == $screen->post_type || 'horse' == $screen->post_type ){
        add_filter( 'wp_dropdown_cats', '__return_false' );

    }
}


// Rename "posts" section "blog"
function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'News';
    $submenu['edit.php'][10][0] = 'Add Post';
    $submenu['edit.php'][16][0] = 'News Tags';
}
function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'News';
    $labels->singular_name = 'News';
    $labels->add_new = 'Add Post';
    $labels->add_new_item = 'Add Post';
    $labels->edit_item = 'Edit Post';
    $labels->new_item = 'Post';
    $labels->view_item = 'View Post';
    $labels->search_items = 'Search Posts';
    $labels->not_found = 'No Posts found';
    $labels->not_found_in_trash = 'No Posts found in Trash';
    $labels->all_items = 'All Posts';
    $labels->menu_name = 'News';
    $labels->name_admin_bar = 'News';
}
 
add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );


// Remove admin menu items we don't need
function custom_menu_page_removing() {
    remove_menu_page( 'edit-comments.php' );
    //remove_menu_page( 'wpcf7' );
    remove_menu_page( 'cptui' );

    remove_submenu_page( 'edit.php?post_type=horse', 'post_status=publish' );
}
add_action( 'admin_menu', 'custom_menu_page_removing' );

// Rearrange the admin menu
  function custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;
    return array(
      'index.php', // Dashboard
      'edit.php?post_type=horse',  // Horses
      'edit.php?post_type=page', // Pages
      'edit.php?post_type=services', // Client Services
      'edit.php?post_type=news', // News
      'edit.php', // Blog
      'edit.php?post_type=super-simple-events', // Events
      'wpcf7', // Events
      'separator1', // First separator
      'upload.php', // Media
      'themes.php', // Appearance
      'plugins.php', // Plugins
      'users.php', // Users
      'tools.php', // Tools
      'link-manager.php', // Links
      'options-general.php', // Settings
    );
  }

  add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
  add_filter('menu_order', 'custom_menu_order');


/**
*
*	Only Show Published Horse Profiles by Default:
*
*
**/

function rkv_filter_admin_published_default() {
	// get our types
	$types = 'horse';//rkv_fetch_post_types();

	// bail if nothing comes back
	if ( empty( $types ) ) {
		return;
	}

	// ensure our types is indeed an array
	$types	= ! is_array( $types ) ? (array) $types : $types;

	// call global submenu item
	global $submenu;

	// loop our types and adjust the URL
	foreach( $types as $type ) {
		// handle post on its own since the type is
		// not declared in the $submenu string
		if ( $type == 'post' ) {
			// edit main link for posts
			$submenu['edit.php'][5][2] = 'edit.php?post_status=publish';
		} else {
			// edit main link for all other types
			$submenu['edit.php?post_type=' . esc_attr( $type ) ][5][2] = 'edit.php?post_type=' . esc_attr( $type ) . '&post_status=publish';
		}
	}

}
add_action ( 'admin_menu', 'rkv_filter_admin_published_default', 20 );

/**
 * fetch all public post types and filter
 *
 * @return [array]  post types for inclusion
 */
function rkv_fetch_post_types() {
	// set array of our default to include posts and pages
	$types = array( 'post', 'page' );

	// set args for looking up custom post types
	$args = array(
		'public'    => true,
		'_builtin'  => false
	);

	// call our types
	$custom = get_post_types( $args, 'names', 'and' );

	// if no custom types exist, just return our defaults
	if ( empty( $custom ) ) {
		return $types;
	}

	// merge our CPTs with the normal
	$types = array_merge( $types, $custom );

	// return it filtered
	return apply_filters( 'rkv_admin_publish_link_types', $types );
}
?>