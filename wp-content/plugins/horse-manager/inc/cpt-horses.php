<?php
class horsePostType {
    var $labels;
	var $post_type_options;
    var $post_type_taxonomies;

	function __construct() {
		$this->horsePostType();
	}
    function horsePostType() {
		$this->labels = array(
		'name' => __('Horses','wp_horse'),
		'singular_name' => _x('Horse', 'post type singular name', 'wp_horse'),
		'add_new' => __('Add Horse +','wp_horse'),
		'add_new_item' => __('Add Horse +','wp_horse'),
		'edit_item' => __('Edit Horse','wp_horse'),
		'new_item' => __('New Horse','wp_horse'),
		'view_item' => __('View This Horse','wp_horse'),
		'search_items' => __('Search Horses','wp_horse'),
		'not_found' =>  __('Not Found!','wp_horse'),
		'not_found_in_trash' => __('Nothing found in Trash','wp_horse'),
		'parent_item_colon' => ''
		);

		$this->post_type_options = array(
			'labels'=>$this->labels,
			'public'=>true,
			'supports' => array('title','editor',/*'author',*/'thumbnail'),
			'hierarchical' => true,
      'menu_position' => 120,
      'menu_icon' => PLUGIN_URL.'/horse-manager/inc/img/horse-16.png',
      'has_archive' => true,
			'rewrite' => array('slug' => 'horse', 'with_front' => TRUE)
		);

	}

	function register() {
	   register_post_type('horse', $this->post_type_options);
       flush_rewrite_rules();
    }

}
//Add horse category
function create_horse_category_taxonomy()
{
    $labels = array('name' => _x( 'Category','wp_horse'),'menu_name' => __( 'Categories','wp_horse'), 'add_new_item' => __( 'Add Horse category','wp_horse'));
    register_taxonomy( 'horse-category', 'horse', array( 'hierarchical' => true, 'labels' => $labels, 'query_var' => 'horse-category', 'public' =>TRUE, 'show_admin_column'=>TRUE,'show_in_nav_menus'=>false, 'rewrite' => array( 'slug' => __('horse-category','wp_horse'),'with_front' => FALSE ) ) );
    flush_rewrite_rules();

}
//Add horse status
function create_horse_status_taxonomy()
{
        $labels = array('name' => _x( 'Status','wp_horse'),'menu_name' => __( 'Status','wp_horse'), __( 'Add horse status','wp_horse'));
		register_taxonomy( 'horse-status', 'horse', array( 'hierarchical' => false, 'labels' => $labels, 'query_var' => 'horse-status', 'public' =>TRUE, 'show_admin_column'=>TRUE,'show_in_nav_menus'=>FALSE,'rewrite' => array( 'slug' => __('status','wp_horse'), 'hierarchical' => false,'with_front' => FALSE ) ) );
       flush_rewrite_rules();
}

//Add horse genre
function create_horse_genre_taxonomy()
{
        $labels = array('name' => _x( 'Gender','wp_horse'),'menu_name' => __( 'Genders','wp_horse'), 'add_new_item' => __( 'Add horse gender','wp_horse'));
		register_taxonomy( 'horse-gender', 'horse', array( 'hierarchical' => false, 'labels' => $labels, 'query_var' => 'horse-gender', 'public' =>TRUE, 'show_admin_column'=>TRUE,'show_in_nav_menus'=>FALSE, 'rewrite' => array( 'slug' => __('genre','wp_horse'), 'hierarchical' => false,'with_front' => FALSE ) ) );
    flush_rewrite_rules();
}

//Add horse size
function create_horse_bloodline_taxonomy()
{

    $labels = array('name' => _x( 'Bloodline','wp_horse'),'menu_name' => __( 'Bloodline','wp_horse'), 'add_new_item' => __( 'Add Bloodline','wp_horse'));
		register_taxonomy( 'horse-bloodline', 'horse', array( 'hierarchical' => false, 'labels' => $labels, 'query_var' => 'horse-bloodline','meta_box_cb'=> false, 'public' =>TRUE, 'show_in_nav_menus'=>FALSE, 'rewrite' => array( 'slug' => __('bloodline','wp_horse'), 'hierarchical' => false,'with_front' => FALSE ) ) );
    flush_rewrite_rules();
}

//Add horse age
function create_horse_age_taxonomy()
{

    $labels = array('name' => _x( 'Age','wp_horse'),'menu_name' => __( 'Ages','wp_horse'), 'add_new_item' => __( 'Add horse age','wp_horse'));
		register_taxonomy( 'horse-age', 'horse', array( 'hierarchical' => false, 'labels' => $labels, 'query_var' => 'horse-age', 'public' =>TRUE, 'show_in_nav_menus'=>FALSE, 'rewrite' => array( 'slug' => __('age','wp_horse'), 'hierarchical' => false,'with_front' => FALSE ) ) );
    flush_rewrite_rules();
}

//Add horse breed
function create_horse_breed_taxonomy()
{

    $labels = array('name' => _x( 'Breeds','wp_horse'),'menu_name' => __( 'Breeds','wp_horse'), 'add_new_item' => __( 'Add horse breed','wp_horse'));
		register_taxonomy( 'horse-breed', 'horse', array( 'hierarchical' => false, 'labels' => $labels, 'query_var' => 'horse-breed', 'public' =>TRUE, 'show_in_nav_menus'=>FALSE,'rewrite' => array( 'slug' => __('breed','wp_horse'), 'hierarchical' => false,'with_front' => FALSE ) ) );
    flush_rewrite_rules();
}//Add horse breedfunction create_horse_partners_taxonomy(){    $labels = array('name' => _x( 'Partners','wp_horse'),'menu_name' => __( 'Partners','wp_horse'), 'add_new_item' => __( 'Add partner','wp_horse'));		register_taxonomy( 'horse-partners', 'horse', array( 'hierarchical' => false, 'labels' => $labels, 'query_var' => 'horse-partners', 'public' =>TRUE, 'show_in_nav_menus'=>FALSE,'rewrite' => array( 'slug' => __('partners','wp_horse'), 'hierarchical' => false,'with_front' => FALSE ) ) );    flush_rewrite_rules();}

//Add horse coat
function create_horse_coat_taxonomy()
{
        $labels = array('name' => _x( 'Coat','wp_horse'),'menu_name' => __( 'Coats','wp_horse'), 'add_new_item' => __( 'Add horse coat','wp_horse'));
		register_taxonomy( 'horse-coat', 'horse', array( 'hierarchical' => false, 'labels' => $labels, 'query_var' => 'horse-coat','public' =>TRUE, 'show_in_nav_menus'=>FALSE, 'rewrite' => array( 'slug' => __('coat','wp_horse'), 'hierarchical' => false,'with_front' => FALSE ) ) );
    flush_rewrite_rules();
}

//Add horse pattern
function create_horse_pattern_taxonomy()
{

    $labels = array('name' => _x( 'Partners','wp_horse'),'menu_name' => __( 'Partners','wp_horse'), __( 'Add Partners','wp_horse'));
		register_taxonomy( 'horse-pattern', 'horse', array( 'hierarchical' => false, 'labels' => $labels, 'query_var' => 'horse-pattern', 'public' =>TRUE, 'show_in_nav_menus'=>FALSE,'rewrite' => array( 'slug' => __('pattern','wp_horse'), 'hierarchical' => false,'with_front' => FALSE ) ) );
    flush_rewrite_rules();
}

//Add horse color
function create_horse_color_taxonomy()
{
        $labels = array('name' => _x( 'Color','wp_horse'),'menu_name' => __( 'Colors','wp_horse'), __( 'Add horse color','wp_horse'));
		register_taxonomy( 'horse-color', 'horse', array( 'hierarchical' => false, 'labels' => $labels, 'query_var' => 'horse-color', 'public' =>TRUE, 'show_in_nav_menus'=>FALSE, 'rewrite' => array( 'slug' => __('color','wp_horse'), 'hierarchical' => false,'with_front' => FALSE ) ) );
    flush_rewrite_rules();
}


//add_filter('post_link', 'horsetype_permalink', 10, 3);
//add_filter('post_type_link', 'horsetype_permalink', 10, 3);

function horsetype_permalink($permalink, $post_id, $leavename) {
	if (strpos($permalink, '%horse-category%') === FALSE) return $permalink;

        // Get post
        $post = get_post($post_id);
        if (!$post) return $permalink;

        // Get taxonomy terms
        $terms = wp_get_object_terms($post->ID, 'horse-category','orderby=term_order');
        if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0])) $taxonomy_slug = $terms[0]->slug;
        else $taxonomy_slug = __('no-horse-category','wp_horse');
        return str_replace('%horse-category%', $taxonomy_slug, $permalink);
}


function remove_taxonomies_boxes() {
      remove_meta_box( 'tagsdiv-horse-color', 'horse', 'side' );
      remove_meta_box( 'tagsdiv-horse-status', 'horse', 'side' );
      remove_meta_box( 'tagsdiv-horse-pattern', 'horse', 'side' );
      remove_meta_box( 'tagsdiv-horse-coat', 'horse', 'side' );
      remove_meta_box( 'tagsdiv-horse-gender', 'horse', 'side' );
      remove_meta_box( 'tagsdiv-horse-size', 'horse', 'side' );
      remove_meta_box( 'tagsdiv-horse-breed', 'horse', 'side' );
      remove_meta_box( 'tagsdiv-horse-age', 'horse', 'side' );
    }


?>