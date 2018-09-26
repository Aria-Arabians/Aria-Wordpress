<?php

/* Add horse in Right Now */


function horse_right_now_content() {
    $args = array(
        'public' => true,
        '_builtin' => false
    );
    $output = 'object';
    $operator = 'and';
    $post_types = get_post_types($args, $output, $operator);

    foreach ($post_types as $post_type) {
        $num_posts = wp_count_posts($post_type->name);
        $num = number_format_i18n($num_posts->publish);

        $text = _n($post_type->labels->singular_name, $post_type->labels->name, intval($num_posts->publish));
        if (current_user_can('edit_posts')) {
            $num = "<a href='edit.php?post_type=$post_type->name'>$num</a>";
            $text = "<a href='edit.php?post_type=$post_type->name'>$text</a>";
        }
        echo '<tr><td class="first b b-' . $post_type->name . '">' . $num . '</td>';
        echo '<td class="t ' . $post_type->name . '">' . $text . '</td></tr>';
    }
}

add_action('right_now_content_table_end', 'horse_right_now_content');

/* Display horse picture */

function ST4_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'horse_mini');
        return $post_thumbnail_img[0];
    }
}

function horse_picture_columns($defaults) {
    $defaults['featured_image'] = __('Picture', 'wp_horse');
    return $defaults;
}

function horse_img_content_only($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        if ($column_name == 'featured_image') {
            $post_featured_image = ST4_get_featured_image($post_ID);
            if ((!empty($post_featured_image))) {
                echo '<div style="padding:3px;overflow:hidden;border:1px solid #ccc;width:40px;height:40px;display:block"><img style="width:100%;height:auto;" src="' . $post_featured_image . '" alt="" title="' . get_the_title() . '" /></div>';
            } else {
                echo '';
            }
        }
    }
}

add_filter('manage_horse_posts_columns', 'horse_picture_columns', 10);
add_action('manage_horse_posts_custom_column', 'horse_img_content_only', 10, 2);

//Functions for auto place content
//Check metadatas
function test_if_meta($arr, $key, $before = '', $after = '') {
    if ($text = $arr[$key][0])
        return $before . $text . $after;
}

//Add post horse to author page
function custom_post_author_archive($query) {
    if ($query->is_author)
        $query->set('post_type', array('horse', 'post'));
    remove_action('pre_get_posts', 'custom_post_author_archive');
}

add_action('pre_get_posts', 'custom_post_author_archive');

//Place content

function place_special_horse_content($content) {
    global $post;

    $postid = get_the_ID();
    
	$list_content= "<p>(".horse_list_page_parent($postid).")</p>";
	$list_content.= " <p class='small'>".horse_list_short_desc($postid)."</p>";
    //all postmeta is here:
    //$horseinfo = get_post_custom(get_the_ID());
    //print_r($horseinfo); //uncomment to see all post meta in everypost
      //$extrahorse = horse_single_page_parent($postid);
	     //$thumbnail='';
		 /*$special .= 
            '<a href="' . get_permalink($post->ID) . '"><span class="horse_image">' . get_the_post_thumbnail($postid, 'horse_img') . '</span></a>' ;*/
    /*$special='<div class="horse_info horse_' . get_the_id() . '" >';

    
            $special .= '<ul>' .
            '<li class="horse_category"><span>' . __('In', 'wp_horse') . '</span> ' . get_the_term_list($post->ID, 'horse-category') . '</li>' .
            '<li class="horse_gender"><span>' . __('Gender', 'wp_horse') . '</span> ' . get_the_term_list($post->ID, 'horse-gender') . '</li>' .
            
            '<li class="horse_breed"><span>' . __('Breed', 'wp_horse') . '</span> ' . get_the_term_list($post->ID, 'horse-breed', '', ', ', '') . '</li>' .
             
            '<li class="horse_color"><span>' . __('Colors', 'wp_horse') . '</span> ' . get_the_term_list($post->ID, 'horse-color', '', ', ', '') . '</li>' .
            '</ul></div>';*/

    
    //if ('horse' == get_post_type() && is_single() && is_main_query()) {
        //return $special . $content . $extrahorse;
    //}

    if ('horse' == get_post_type() && is_archive() && is_main_query()) {
        return $list_content;
    }
	/*if ('horse' == get_post_type() && is_home()) {
        return $special;
    }*/

    return $content;
}

add_filter('the_content', 'place_special_horse_content', 10);
add_filter('the_excerpt', 'place_special_horse_content', 11);

//Special content for horse Page

function place_special_horse_content_in_horses($content) {

    $page = __('horse-list', 'wp_horse');

    if (is_page($page)) {

        $data .= '<h3>' . __('Browse horses by Status', 'wp_horse') . '</h3><ul>' . wp_list_categories('echo=0&show_count=1&taxonomy=horse-status&title_li=') . '</ul>' .
                '<h3>' . __('Browse horses by Category', 'wp_horse') . '</h3><ul>' . wp_list_categories('echo=0&show_count=1&taxonomy=horse-category&title_li=') . '</ul>' .
                '<h3>' . __('Search horses', 'wp_horse') . '</h3>' . do_shortcode('[horse_search]');
    }

    return $content . $data;
}

add_filter('the_content', 'place_special_horse_content_in_horses', 20);

//print performance
function horse_know_performance($visible = false) {

    $stat = sprintf('%d queries in %.3f seconds, using %.2fMB memory', get_num_queries(), timer_stop(0, 3), memory_get_peak_usage() / 1024 / 1024
    );

    echo $visible ? $stat : "<!-- {$stat} -->";
}

add_action('wp_footer', 'horse_know_performance', 20);

/* Change horse post title field */

function horse_change_default_title($title) {
    $screen = get_current_screen();

    if ('horse' == $screen->post_type) {
        $title = __('Enter horse name here', 'wp_horse');
    }

    return $title;
}

add_filter('enter_title_here', 'horse_change_default_title',22);


/* Place pending mod note */

function horse_place_note($content) {

    if (is_preview() && 'horse' == get_post_type())
        $note = '<div class="note">' . __('This post is still waiting for moderator approval.', 'wp_horse') . '<a href="' . get_edit_post_link(get_the_ID()) . '">' . __('Edit this post and add more info', 'wp_horse') . '</a></div>';

    return $content . $note;
}

add_filter('the_content', 'horse_place_note', 20);


/* Shortcode Search form */

function horse_search_form() {

    $types = get_terms('horse-category', array('hide_empty' => 1));
    foreach ($types as $type) {
        $horse_types .= "<option value='$type->slug'" . selected($type->slug, true, false) . ">$type->name" . "&nbsp;(" . "$type->count" . ")" . "</option>";
    }

    $statuses = get_terms('horse-status', array('hide_empty' => 1));
    foreach ($statuses as $status) {
        $horse_status .= "<option value='$status->slug'" . selected($status->slug, true, false) . ">$status->name" . "&nbsp;(" . "$status->count" . ")" . "</option>";
    }

    $genders = get_terms('horse-gender', array('hide_empty' => 1));
    foreach ($genders as $gender) {
        $horse_genders .= "<option value='$gender->slug'" . selected($gender->slug, true, false) . ">$gender->name" . "&nbsp;(" . "$gender->count" . ")" . "</option>";
    }

    $sizes = get_terms('horse-size', array('hide_empty' => 1));
    foreach ($sizes as $size) {
        $horse_sizes .= "<option value='$size->slug'" . selected($size->slug, true, false) . ">$size->name" . "&nbsp;(" . "$size->count" . ")" . "</option>";
    }

    $ages = get_terms('horse-age', array('hide_empty' => 1));
    foreach ($ages as $age) {
        $horse_ages .= "<option value='$age->slug'" . selected($size->slug, true, false) . ">$age->name" . "&nbsp;(" . "$age->count" . ")" . "</option>";
    }

    $searchform .= '<form action="' . get_home_url() . '/" method="get" id="searchhorseform"><fieldset><ol>' .
            '<li id="item-status"><label for="horse_status">' . __('Status', 'wp_horse') . '</label><select id="horse_status" name="horse-status">' .
            '<option value="0"></option>' .
            $horse_status .
            '</select></li>' .
            '<li id="item-category"><label for="horse_category">' . __('Category', 'wp_horse') . '</label><select id="horse_category" name="horse-category">' .
            '<option value="0"></option>' .
            $horse_types .
            '</select></li>' .
            '<li id="item-gender"><label for="horse_gender">' . __('Gender', 'wp_horse') . '</label><select id="horse_gender" name="horse-gender">' .
            '<option value="0"></option>' .
            $horse_genders .
            '</select></li>' .
            '<li id="item-size"><label for="horse_size">' . __('Size', 'wp_horse') . '</label><select id="horse_size" name="horse-size">' .
            '<option value="0"></option>' .
            $horse_sizes .
            '</select></li>' .
            '<li id="item-age"><label for="horse_age">' . __('Age', 'wp_horse') . '</label><select id="horse_size" name="horse-size">' .
            '<option value="0"></option>' .
            $horse_ages .
            '</select></li>' .
            '<input type="hidden" name="post_type" value="horse" />' .
            '<br /><input type="submit" id="searchhorse" name="search" value="' . __('Search horse', 'wp_horse') . '">' .
            '' .
            '' .
            '</ol></fieldset></form>';

    return $searchform;
}

/* Only edit your own posts */

function horse_parse_query_useronly($wp_query) {
    if (strpos($_SERVER['REQUEST_URI'], '/wp-admin/edit.php') !== false) {
        if (!current_user_can('level_10')) {
            global $current_user;
            $wp_query->set('author', $current_user->id);
        }
    }
}

add_filter('parse_query', 'horse_parse_query_useronly');

/* Add horse thumb in feeds */

function insertThumbnailRSS($content) {
    global $post;
    if (has_post_thumbnail($post->ID)) {


        if ($post->post_type == 'horse') {
            $content = '' . get_the_post_thumbnail($post->ID, 'thumbnail') . '' . $content;
        }
    }
    return $content;
}

add_filter('the_excerpt_rss', 'insertThumbnailRSS');
add_filter('the_content_feed', 'insertThumbnailRSS');
add_action( 'init', 'wp_insert_new_horese' );
function wp_insert_new_horese( $postarr, $wp_error = false ) {
    global $wpdb;
 
    $user_id = get_current_user_id();
 
    $defaults = array(
        'post_author' => $user_id,
        'post_content' => '',
        'post_content_filtered' => '',
        'post_title' => '',
        'post_excerpt' => '',
        'post_status' => 'draft',
        'post_type' => 'post',
        'comment_status' => '',
        'ping_status' => '',
        'post_password' => '',
        'to_ping' =>  '',
        'pinged' => '',
        'post_parent' => 0,
        'menu_order' => 0,
        'guid' => '',
        'import_id' => 0,
        'context' => '',
    );
 
    $postarr = wp_parse_args($postarr, $defaults);
 
    unset( $postarr[ 'filter' ] );
 
    $postarr = sanitize_post($postarr, 'db');
 
    // Are we updating or creating?
    $post_ID = 0;
    $update = false;
    $guid = $postarr['guid'];
 
    if ( ! empty( $postarr['ID'] ) ) {
        $update = true;
 
        // Get the post ID and GUID.
        $post_ID = $postarr['ID'];
        $post_before = get_post( $post_ID );
        if ( is_null( $post_before ) ) {
            if ( $wp_error ) {
                return new WP_Error( 'invalid_post', __( 'Invalid post ID.' ) );
            }
            return 0;
        }
 
        $guid = get_post_field( 'guid', $post_ID );
        $previous_status = get_post_field('post_status', $post_ID );
    } else {
        $previous_status = 'new';
    }
 
    $post_type = empty( $postarr['post_type'] ) ? 'post' : $postarr['post_type'];
 
    $post_title = $postarr['post_title'];
    $post_content = $postarr['post_content'];
    $post_excerpt = $postarr['post_excerpt'];
    if ( isset( $postarr['post_name'] ) ) {
        $post_name = $postarr['post_name'];
    } elseif ( $update ) {
        // For an update, don't modify the post_name if it wasn't supplied as an argument.
        $post_name = $post_before->post_name;
    }
 
    $maybe_empty = 'attachment' !== $post_type
        && ! $post_content && ! $post_title && ! $post_excerpt
        && post_type_supports( $post_type, 'editor' )
        && post_type_supports( $post_type, 'title' )
        && post_type_supports( $post_type, 'excerpt' );
 
    /**
     * Filters whether the post should be considered "empty".
     *
     * The post is considered "empty" if both:
     * 1. The post type supports the title, editor, and excerpt fields
     * 2. The title, editor, and excerpt fields are all empty
     *
     * Returning a truthy value to the filter will effectively short-circuit
     * the new post being inserted, returning 0. If $wp_error is true, a WP_Error
     * will be returned instead.
     *
     * @since 3.3.0
     *
     * @param bool  $maybe_empty Whether the post should be considered "empty".
     * @param array $postarr     Array of post data.
     */
    if ( apply_filters( 'wp_insert_post_empty_content', $maybe_empty, $postarr ) ) {
        if ( $wp_error ) {
            return new WP_Error( 'empty_content', __( 'Content, title, and excerpt are empty.' ) );
        } else {
            return 0;
        }
    }
 
    $post_status = empty( $postarr['post_status'] ) ? 'draft' : $postarr['post_status'];
    if ( 'attachment' === $post_type && ! in_array( $post_status, array( 'inherit', 'private', 'trash', 'auto-draft' ), true ) ) {
        $post_status = 'inherit';
    }
 
    if ( ! empty( $postarr['post_category'] ) ) {
        // Filter out empty terms.
        $post_category = array_filter( $postarr['post_category'] );
    }
 
    // Make sure we set a valid category.
    if ( empty( $post_category ) || 0 == count( $post_category ) || ! is_array( $post_category ) ) {
        // 'post' requires at least one category.
        if ( 'post' == $post_type && 'auto-draft' != $post_status ) {
            $post_category = array( get_option('default_category') );
        } else {
            $post_category = array();
        }
    }
 
    // Don't allow contributors to set the post slug for pending review posts.
    if ( 'pending' == $post_status && !current_user_can( 'publish_posts' ) ) {
        $post_name = '';
    }
 
    /*
     * Create a valid post name. Drafts and pending posts are allowed to have
     * an empty post name.
     */
    if ( empty($post_name) ) {
        if ( !in_array( $post_status, array( 'draft', 'pending', 'auto-draft' ) ) ) {
            $post_name = sanitize_title($post_title);
        } else {
            $post_name = '';
        }
    } else {
        // On updates, we need to check to see if it's using the old, fixed sanitization context.
        $check_name = sanitize_title( $post_name, '', 'old-save' );
        if ( $update && strtolower( urlencode( $post_name ) ) == $check_name && get_post_field( 'post_name', $post_ID ) == $check_name ) {
            $post_name = $check_name;
        } else { // new post, or slug has changed.
            $post_name = sanitize_title($post_name);
        }
    }
 
    /*
     * If the post date is empty (due to having been new or a draft) and status
     * is not 'draft' or 'pending', set date to now.
     */
    if ( empty( $postarr['post_date'] ) || '0000-00-00 00:00:00' == $postarr['post_date'] ) {
        if ( empty( $postarr['post_date_gmt'] ) || '0000-00-00 00:00:00' == $postarr['post_date_gmt'] ) {
            $post_date = current_time( 'mysql' );
        } else {
            $post_date = get_date_from_gmt( $postarr['post_date_gmt'] );
        }
    } else {
        $post_date = $postarr['post_date'];
    }
 
    // Validate the date.
    $mm = substr( $post_date, 5, 2 );
    $jj = substr( $post_date, 8, 2 );
    $aa = substr( $post_date, 0, 4 );
    $valid_date = wp_checkdate( $mm, $jj, $aa, $post_date );
    if ( ! $valid_date ) {
        if ( $wp_error ) {
            return new WP_Error( 'invalid_date', __( 'Invalid date.' ) );
        } else {
            return 0;
        }
    }
 
    if ( empty( $postarr['post_date_gmt'] ) || '0000-00-00 00:00:00' == $postarr['post_date_gmt'] ) {
        if ( ! in_array( $post_status, array( 'draft', 'pending', 'auto-draft' ) ) ) {
            $post_date_gmt = get_gmt_from_date( $post_date );
        } else {
            $post_date_gmt = '0000-00-00 00:00:00';
        }
    } else {
        $post_date_gmt = $postarr['post_date_gmt'];
    }
 
    if ( $update || '0000-00-00 00:00:00' == $post_date ) {
        $post_modified     = current_time( 'mysql' );
        $post_modified_gmt = current_time( 'mysql', 1 );
    } else {
        $post_modified     = $post_date;
        $post_modified_gmt = $post_date_gmt;
    }
 
    if ( 'attachment' !== $post_type ) {
        if ( 'publish' == $post_status ) {
            $now = gmdate('Y-m-d H:i:59');
            if ( mysql2date('U', $post_date_gmt, false) > mysql2date('U', $now, false) ) {
                $post_status = 'future';
            }
        } elseif ( 'future' == $post_status ) {
            $now = gmdate('Y-m-d H:i:59');
            if ( mysql2date('U', $post_date_gmt, false) <= mysql2date('U', $now, false) ) {
                $post_status = 'publish';
            }
        }
    }
 
    // Comment status.
    if ( empty( $postarr['comment_status'] ) ) {
        if ( $update ) {
            $comment_status = 'closed';
        } else {
            $comment_status = get_default_comment_status( $post_type );
        }
    } else {
        $comment_status = $postarr['comment_status'];
    }
 
    // These variables are needed by compact() later.
    $post_content_filtered = $postarr['post_content_filtered'];
    $post_author = isset( $postarr['post_author'] ) ? $postarr['post_author'] : $user_id;
    $ping_status = empty( $postarr['ping_status'] ) ? get_default_comment_status( $post_type, 'pingback' ) : $postarr['ping_status'];
    $to_ping = isset( $postarr['to_ping'] ) ? sanitize_trackback_urls( $postarr['to_ping'] ) : '';
    $pinged = isset( $postarr['pinged'] ) ? $postarr['pinged'] : '';
    $import_id = isset( $postarr['import_id'] ) ? $postarr['import_id'] : 0;
 
    /*
     * The 'wp_insert_post_parent' filter expects all variables to be present.
     * Previously, these variables would have already been extracted
     */
    if ( isset( $postarr['menu_order'] ) ) {
        $menu_order = (int) $postarr['menu_order'];
    } else {
        $menu_order = 0;
    }
 
    $post_password = isset( $postarr['post_password'] ) ? $postarr['post_password'] : '';
    if ( 'private' == $post_status ) {
        $post_password = '';
    }
 
    if ( isset( $postarr['post_parent'] ) ) {
        $post_parent = (int) $postarr['post_parent'];
    } else {
        $post_parent = 0;
    }
 
    /**
     * Filters the post parent -- used to check for and prevent hierarchy loops.
     *
     * @since 3.1.0
     *
     * @param int   $post_parent Post parent ID.
     * @param int   $post_ID     Post ID.
     * @param array $new_postarr Array of parsed post data.
     * @param array $postarr     Array of sanitized, but otherwise unmodified post data.
     */
    $post_parent = apply_filters( 'wp_insert_post_parent', $post_parent, $post_ID, compact( array_keys( $postarr ) ), $postarr );
 
    /*
     * If the post is being untrashed and it has a desired slug stored in post meta,
     * reassign it.
     */
    if ( 'trash' === $previous_status && 'trash' !== $post_status ) {
        $desired_post_slug = get_post_meta( $post_ID, '_wp_desired_post_slug', true );
        if ( $desired_post_slug ) {
            delete_post_meta( $post_ID, '_wp_desired_post_slug' );
            $post_name = $desired_post_slug;
        }
    }
 
    // If a trashed post has the desired slug, change it and let this post have it.
    if ( 'trash' !== $post_status && $post_name ) {
        wp_add_trashed_suffix_to_post_name_for_trashed_posts( $post_name, $post_ID );
    }
 
    // When trashing an existing post, change its slug to allow non-trashed posts to use it.
    if ( 'trash' === $post_status && 'trash' !== $previous_status && 'new' !== $previous_status ) {
        $post_name = wp_add_trashed_suffix_to_post_name_for_post( $post_ID );
    }
 
    $post_name = wp_unique_post_slug( $post_name, $post_ID, $post_status, $post_type, $post_parent );
 
    // Don't unslash.
    $post_mime_type = isset( $postarr['post_mime_type'] ) ? $postarr['post_mime_type'] : '';
 
    // Expected_slashed (everything!).
    $data = compact( 'post_author', 'post_date', 'post_date_gmt', 'post_content', 'post_content_filtered', 'post_title', 'post_excerpt', 'post_status', 'post_type', 'comment_status', 'ping_status', 'post_password', 'post_name', 'to_ping', 'pinged', 'post_modified', 'post_modified_gmt', 'post_parent', 'menu_order', 'post_mime_type', 'guid' );
 
    $emoji_fields = array( 'post_title', 'post_content', 'post_excerpt' );
 
    foreach ( $emoji_fields as $emoji_field ) {
        if ( isset( $data[ $emoji_field ] ) ) {
            $charset = $wpdb->get_col_charset( $wpdb->posts, $emoji_field );
            if ( 'utf8' === $charset ) {
                $data[ $emoji_field ] = wp_encode_emoji( $data[ $emoji_field ] );
            }
        }
    }
 
    if ( 'attachment' === $post_type ) {
        /**
         * Filters attachment post data before it is updated in or added to the database.
         *
         * @since 3.9.0
         *
         * @param array $data    An array of sanitized attachment post data.
         * @param array $postarr An array of unsanitized attachment post data.
         */
        $data = apply_filters( 'wp_insert_attachment_data', $data, $postarr );
    } else {
        /**
         * Filters slashed post data just before it is inserted into the database.
         *
         * @since 2.7.0
         *
         * @param array $data    An array of slashed post data.
         * @param array $postarr An array of sanitized, but otherwise unmodified post data.
         */
        $data = apply_filters( 'wp_insert_post_data', $data, $postarr );
    }
    $data = wp_unslash( $data );
    $where = array( 'ID' => $post_ID );
 
    if ( $update ) {
        /**
         * Fires immediately before an existing post is updated in the database.
         *
         * @since 2.5.0
         *
         * @param int   $post_ID Post ID.
         * @param array $data    Array of unslashed post data.
         */
        do_action( 'pre_post_update', $post_ID, $data );
        if ( false === $wpdb->update( $wpdb->posts, $data, $where ) ) {
            if ( $wp_error ) {
                return new WP_Error('db_update_error', __('Could not update post in the database'), $wpdb->last_error);
            } else {
                return 0;
            }
        }
    } else {
        // If there is a suggested ID, use it if not already present.
        if ( ! empty( $import_id ) ) {
            $import_id = (int) $import_id;
            if ( ! $wpdb->get_var( $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE ID = %d", $import_id) ) ) {
                $data['ID'] = $import_id;
            }
        }
        if ( false === $wpdb->insert( $wpdb->posts, $data ) ) {
            if ( $wp_error ) {
                return new WP_Error('db_insert_error', __('Could not insert post into the database'), $wpdb->last_error);
            } else {
                return 0;
            }
        }
        $post_ID = (int) $wpdb->insert_id;
 
        // Use the newly generated $post_ID.
        $where = array( 'ID' => $post_ID );
    }
 
    if ( empty( $data['post_name'] ) && ! in_array( $data['post_status'], array( 'draft', 'pending', 'auto-draft' ) ) ) {
        $data['post_name'] = wp_unique_post_slug( sanitize_title( $data['post_title'], $post_ID ), $post_ID, $data['post_status'], $post_type, $post_parent );
        $wpdb->update( $wpdb->posts, array( 'post_name' => $data['post_name'] ), $where );
        clean_post_cache( $post_ID );
    }
 
    if ( is_object_in_taxonomy( $post_type, 'category' ) ) {
        wp_set_post_categories( $post_ID, $post_category );
    }
 
    if ( isset( $postarr['tags_input'] ) && is_object_in_taxonomy( $post_type, 'post_tag' ) ) {
        wp_set_post_tags( $post_ID, $postarr['tags_input'] );
    }
 
    // New-style support for all custom taxonomies.
    if ( ! empty( $postarr['tax_input'] ) ) {
        foreach ( $postarr['tax_input'] as $taxonomy => $tags ) {
            $taxonomy_obj = get_taxonomy($taxonomy);
            if ( ! $taxonomy_obj ) {
                /* translators: %s: taxonomy name */
                _doing_it_wrong( __FUNCTION__, sprintf( __( 'Invalid taxonomy: %s.' ), $taxonomy ), '4.4.0' );
                continue;
            }
 
            // array = hierarchical, string = non-hierarchical.
            if ( is_array( $tags ) ) {
                $tags = array_filter($tags);
            }
            if ( current_user_can( $taxonomy_obj->cap->assign_terms ) ) {
                wp_set_post_terms( $post_ID, $tags, $taxonomy );
            }
        }
    }
 
    if ( ! empty( $postarr['meta_input'] ) ) {
        foreach ( $postarr['meta_input'] as $field => $value ) {
            update_post_meta( $post_ID, $field, $value );
        }
    }
 
    $current_guid = get_post_field( 'guid', $post_ID );
 
    // Set GUID.
    if ( ! $update && '' == $current_guid ) {
        $wpdb->update( $wpdb->posts, array( 'guid' => get_permalink( $post_ID ) ), $where );
    }
 
    if ( 'attachment' === $postarr['post_type'] ) {
        if ( ! empty( $postarr['file'] ) ) {
            update_attached_file( $post_ID, $postarr['file'] );
        }
 
        if ( ! empty( $postarr['context'] ) ) {
            add_post_meta( $post_ID, '_wp_attachment_context', $postarr['context'], true );
        }
    }
 
    // Set or remove featured image.
    if ( isset( $postarr['_thumbnail_id'] ) ) {
        $thumbnail_support = current_theme_supports( 'post-thumbnails', $post_type ) && post_type_supports( $post_type, 'thumbnail' ) || 'revision' === $post_type;
        if ( ! $thumbnail_support && 'attachment' === $post_type && $post_mime_type ) {
            if ( wp_attachment_is( 'audio', $post_ID ) ) {
                $thumbnail_support = post_type_supports( 'attachment:audio', 'thumbnail' ) || current_theme_supports( 'post-thumbnails', 'attachment:audio' );
            } elseif ( wp_attachment_is( 'video', $post_ID ) ) {
                $thumbnail_support = post_type_supports( 'attachment:video', 'thumbnail' ) || current_theme_supports( 'post-thumbnails', 'attachment:video' );
            }
        }
 
        if ( $thumbnail_support ) {
            $thumbnail_id = intval( $postarr['_thumbnail_id'] );
            if ( -1 === $thumbnail_id ) {
                delete_post_thumbnail( $post_ID );
            } else {
                set_post_thumbnail( $post_ID, $thumbnail_id );
            }
        }
    }
 
    clean_post_cache( $post_ID );
 
    $post = get_post( $post_ID );
 
    if ( ! empty( $postarr['page_template'] ) ) {
        $post->page_template = $postarr['page_template'];
        $page_templates = wp_get_theme()->get_page_templates( $post );
        if ( 'default' != $postarr['page_template'] && ! isset( $page_templates[ $postarr['page_template'] ] ) ) {
            if ( $wp_error ) {
                return new WP_Error( 'invalid_page_template', __( 'Invalid page template.' ) );
            }
            update_post_meta( $post_ID, '_wp_page_template', 'default' );
        } else {
            update_post_meta( $post_ID, '_wp_page_template', $postarr['page_template'] );
        }
    }
 
    if ( 'attachment' !== $postarr['post_type'] ) {
        wp_transition_post_status( $data['post_status'], $previous_status, $post );
    } else {
        if ( $update ) {
            /**
             * Fires once an existing attachment has been updated.
             *
             * @since 2.0.0
             *
             * @param int $post_ID Attachment ID.
             */
            do_action( 'edit_attachment', $post_ID );
            $post_after = get_post( $post_ID );
 
            /**
             * Fires once an existing attachment has been updated.
             *
             * @since 4.4.0
             *
             * @param int     $post_ID      Post ID.
             * @param WP_Post $post_after   Post object following the update.
             * @param WP_Post $post_before  Post object before the update.
             */
            do_action( 'attachment_updated', $post_ID, $post_after, $post_before );
        } else {
 
            /**
             * Fires once an attachment has been added.
             *
             * @since 2.0.0
             *
             * @param int $post_ID Attachment ID.
             */
            do_action( 'add_attachment', $post_ID );
        }
 
        return $post_ID;
    }
 
    if ( $update ) {
        /**
         * Fires once an existing post has been updated.
         *
         * @since 1.2.0
         *
         * @param int     $post_ID Post ID.
         * @param WP_Post $post    Post object.
         */
        do_action( 'edit_post', $post_ID, $post );
        $post_after = get_post($post_ID);
 
        /**
         * Fires once an existing post has been updated.
         *
         * @since 3.0.0
         *
         * @param int     $post_ID      Post ID.
         * @param WP_Post $post_after   Post object following the update.
         * @param WP_Post $post_before  Post object before the update.
         */
        do_action( 'post_updated', $post_ID, $post_after, $post_before);
    }
 
 
    return $post_ID;
}
function horse_list_page_parent($postid) {
      $mother = get_post_meta($postid, 'mother', true);
	  $mothername = (!empty($mother))?get_the_title($mother):'';
	  $father = get_post_meta($postid, 'father', true);
	  $fathername = (!empty($father))?get_the_title($father):'';
	  return $fathername." - ".$mothername;
}
function horse_list_short_desc($postid){
    $year = get_post_meta( get_the_ID(), '_data_horse_year_foaled', true );
    $horse_color = wp_get_post_terms($postid, 'horse-color', array("fields" => "names"));
	$horse_breed = wp_get_post_terms($postid, 'horse-breed', array("fields" => "names"));
	$horse_gender = wp_get_post_terms($postid, 'horse-gender', array("fields" => "names"));
	return  $year." ".$horse_color[0]." ".$horse_breed[0]." ".$horse_gender[0];
}
/*function horse_single_page_parent($postid) {
        
	
	  $mother = get_post_meta($postid, 'mother', true);
	  $mothername = (!empty($mother))?get_the_title($mother):'';
	  $m_mother_id = get_post_meta($mother, 'mother', true);
	  $m_father_id = get_post_meta($mother, 'father', true);
	  $m_mother_name = (!empty($m_mother_id))?get_the_title($m_mother_id):'';
	  $m_father_name = (!empty($m_father_id))?get_the_title($m_father_id):'';
	      $m1_mother_id = get_post_meta($m_mother_id, 'mother', true);
		  $m1_father_id = get_post_meta($m_mother_id, 'father', true); 
		  $m1_mother_name = (!empty($m1_mother_id))?get_the_title($m1_mother_id):'';
		  $m1_father_name = (!empty($m1_father_id))?get_the_title($m1_father_id):'';
		  $m1f_mother_id = get_post_meta($m_father_id, 'mother', true);
		  $m1f_father_id = get_post_meta($m_father_id, 'father', true); 
		  $m1f_mother_name = (!empty($m1f_mother_id))?get_the_title($m1f_mother_id):'';
		  $m1f_father_name = (!empty($m1f_father_id))?get_the_title($m1f_father_id):'';
	  ///////////////////////////////////////////////////////////////////
	  $father = get_post_meta($postid, 'father', true);
	  $fathername = (!empty($father))?get_the_title($father):'';
	  $f_mother_id = get_post_meta($father, 'mother', true);
	  $f_father_id = get_post_meta($father, 'father', true);
	  $f_mother_name = (!empty($f_mother_id))?get_the_title($f_mother_id):'';
	  $f_father_name = (!empty($f_father_id))?get_the_title($f_father_id):'';
	  
	      $f1_mother_id = get_post_meta($f_mother_id, 'mother', true);
		  $f1_father_id = get_post_meta($f_mother_id, 'father', true); 
		  $f1_mother_name = (!empty($f1_mother_id))?get_the_title($f1_mother_id):'';
		  $f1_father_name = (!empty($f1_father_id))?get_the_title($f1_father_id):'';
		  
	      $f1f_mother_id = get_post_meta($f_father_id, 'mother', true);
		  $f1f_father_id = get_post_meta($f_father_id, 'father', true); 
		  $f1f_mother_name = (!empty($f1f_mother_id))?get_the_title($f1f_mother_id):'';
		  $f1f_father_name = (!empty($f1f_father_id))?get_the_title($f1f_father_id):'';
	  
	  
	  
      $retdata = '<table class="form-table cmb_metabox">
  <tr>
          <th>Mother:</th>
          <td><table>
              <tr>
              <td>'.$mothername.'
              </td>
            </tr>
              
            </table></td>
          <td><table>
              <tr>
              <td>'.$m_mother_name.'
                </td>
            </tr>
              <tr>
              <td>'.$m_father_name.'</td>
            </tr>
            </table></td>
          <td><table>
              <tr>
              <td>'.$m1_mother_name.'
                </td>
            </tr>
              <tr>
              <td>'.$m1_father_name.'</td>
            </tr>
              <tr>
              <td>'.$m1f_mother_name.'</td>
            </tr>
              <tr>
              <td>'.$m1f_father_name.'</td>
            </tr>
            </table></td>
        </tr>
  <tr>
          <th>Father:</th>
          <td><table>
              <tr>
              <td>'.$fathername.'
                </td>
            </tr>
              
            </table></td>
          <td><table>
              <tr>
              <td>'.$f_mother_name.'
                </td>
            </tr>
              <tr>
              <td>'.$f_father_name.'</td>
            </tr>
            </table></td>
          <td><table>
              <tr>
              <td>'.$f1_mother_name.'</td>
            </tr>
              <tr>
              <td>'.$f1_father_name.'</td>
            </tr>
              <tr>
              <td>'.$f1f_mother_name.'</td>
            </tr>
              <tr>
              <td>'.$f1f_father_name.'</td>
            </tr>
            </table></td>
        </tr>
</table>';
return $retdata;
 }*/
 function horse_image_slider($postid) {
    global $post;
	$html='';
	
    $args = array(
    	'post_type' => 'attachment',
    	'numberposts' => null,
    	'post_status' => null,
    	'post_parent' => $postid
    );
	$attachments = get_posts($args);
    $attach_list = get_post_meta($post->ID, 'attach-list');


    if ($attachments) {

        $html .='<div class="owl-init owl-carousel owl-height profile row full-row">';
        
        foreach ($attach_list as $attachment) {

            $html .=  "<img src='".wp_get_attachment_url($attachment, 'medium').")'></img>";
        }

    $html .='</div>';		

	}
                 
    return $html;

}

// Pull progeny list from plugin and display
function list_progeny($postid) {
    
    global $post;
            // Query the post details array
           $progenyArray = $post->$progeny;
           $progenyHtml = '<div class="progeny">
                            <div class="row">
                            <div class="medium-12 columns"> 
                            <h2>Progeny</h2><ul id="progeny_list">';

    //Strictly for debugging progeny list
    //echo '<pre>'; print_r($progenyArray['progeny_id']); echo '</pre>'; // Just checked progeny
    //echo '<pre>'; print_r($progenyArray); echo '</pre>'; // Top level post array
    

    // If they exist, cycle through confirmed progeny ids (only those "checked" in the plugin)

    if ( empty($progenyArray['progeny_id'][0]) == false )  {

        foreach ($progenyArray['progeny_id'] as $key) {

            // Display the associated title for each progeny id
            //echo $key;
            $progenyHtml .= "<a href=".get_permalink($key)."><li>".get_the_title($key)."</li></a>";
        }

        $progenyHtml .= '</ul></div></div></div>
                        <div class="separator">
                          <div class="row">
                            <div class="medium-12 columns"> <img src="'. get_template_directory_uri().'/images/heading-line.png" /> </div>
                          </div>
                        </div>';

        echo $progenyHtml;
    }


}
?>
