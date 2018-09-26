<?php

/*

Plugin Name: AHW Horse Manager

Text Domain: wp_horse

Domain Path: /lang

Description: AHW Horse Manager offers an easy way to manage detailed information across your collection

Version: 1.2

*/

  /*Definitions*/

		if ( !defined('WP_CONTENT_URL') )

		    define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');

		if ( !defined('WP_CONTENT_DIR') )

		    define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );



		if (!defined('PLUGIN_URL'))

		    define('PLUGIN_URL', WP_CONTENT_URL . '/plugins');

		if (!defined('PLUGIN_PATH'))

		    define('PLUGIN_PATH', WP_CONTENT_DIR . '/plugins');



		define('TC_FILE_PATH', dirname(__FILE__));

		define('TC_DIR_NAME', basename(TC_FILE_PATH));



    //include the main class file

    require_once PLUGIN_PATH .'/'.TC_DIR_NAME . '/inc/cpt-horses.php';

    require_once PLUGIN_PATH .'/'.TC_DIR_NAME . '/inc/extend.php';

    require_once PLUGIN_PATH .'/'.TC_DIR_NAME . '/inc/widgets.php';

    require_once PLUGIN_PATH .'/'.TC_DIR_NAME . '/inc/metabox/boxes.php';



    define( 'CMB_META_BOX_URL', PLUGIN_URL.'/'.TC_DIR_NAME . '/inc/metabox/' );


class horse_MANAGER {

	function __construct() {

		$this->horse_MANAGER();

	}

	function horse_MANAGER() {

		global $wp_version;

    add_theme_support( 'post-thumbnails' );

    add_image_size( 'horse_img', 200, 200, true );

    add_image_size( 'horse_mini', 50, 50, true );
    add_thickbox();

	  }

  }

function wp_schools_enqueue_scripts() {
wp_enqueue_script( 'custom-jcrop-js', plugin_dir_url( __FILE__ )  . '/js/jquery.Jcrop.js', array ( 'jquery' ), 1.1, true);
wp_enqueue_style( 'custom-jcrop-css', plugin_dir_url( __FILE__ )  . '/inc/jquery.Jcrop.css');
wp_enqueue_style( 'custom-css', plugin_dir_url( __FILE__ )  . '/inc/custom.css');

}
add_action( 'admin_enqueue_scripts', 'wp_schools_enqueue_scripts', 11);


  //Starts everything

  add_action( 'init', 'horsemanager_setup',1 );

  function horsemanager_setup(){

    //Load the text domain, first of all

    load_plugin_textdomain('wp_horse', true, dirname( plugin_basename( __FILE__ ) ) . '/lang' );


    //Enables horse and Lost Types

    $horsePostType = new horsePostType();

		//Register the post type

		add_action('init', array($horsePostType,'register'),3 );


	//add_action( 'init', 'horse_add_pages');


    //Register horse type taxonomies

    add_action( 'init', 'create_horse_category_taxonomy');

    add_action( 'init', 'create_horse_color_taxonomy');

    //add_action( 'init', 'create_horse_status_taxonomy');

    add_action( 'init', 'create_horse_genre_taxonomy');

    //add_action( 'init', 'create_horse_age_taxonomy');

    add_action( 'init', 'create_horse_breed_taxonomy');

    add_action( 'init', 'create_horse_bloodline_taxonomy');

    //add_action( 'init', 'create_horse_coat_taxonomy');

    //add_action( 'init', 'create_horse_pattern_taxonomy');



    add_action( 'init', 'horse_remove_horses_support');

    add_action( 'admin_menu' , 'remove_taxonomies_boxes' );

    //add_shortcode( 'horse_shortcode', 'horse_shortcode_form' );

    add_shortcode( 'horse_search', 'horse_search_form' );

    add_filter('widget_text', 'do_shortcode');

    add_action( 'admin_print_styles','action_admin_print_styles' );



    //Widgets

    add_action('widgets_init', create_function('', 'return register_widget("horse_Widget_Searchform");'));

    add_action('widgets_init', create_function('', 'return register_widget("horse_Widget_Display");'));


  }



    function horse_especial_queries(){

        global $wp;

        $wp->add_query_var('meta_key');

        $wp->add_query_var('meta_value');

        $wp->add_query_var('meta_compare');

    }



  	function horse_remove_horses_support() {

  		remove_post_type_support( 'horse', 'excerpt' );

  		remove_post_type_support( 'horse', 'comments' );

  	}

    // Add needed scripts  array( 'jquery' )

    function horse_manager_scripts() {

	          wp_enqueue_script('jquery_check', plugins_url('/js/jquery_check.js', __FILE__), array('jquery')

	       );
    }

    add_action( 'wp_enqueue_scripts', 'horse_manager_scripts' );



    function horse_manager_stylesheet() {

        // Respects SSL, Style.css is relative to the current file

        wp_register_style( 'horse-style', plugins_url('/inc/horse_styles.css', __FILE__) );

        wp_enqueue_style( 'horse-style' );

    }

    add_action( 'wp_enqueue_scripts', 'horse_manager_stylesheet' );


    /*Allow upload files*/

    function insert_attachment($file_handler,$post_id,$setthumb='false') {

    	// check to make sure its a successful upload

    	if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();



    	require_once(ABSPATH . "wp-admin" . '/includes/image.php');

    	require_once(ABSPATH . "wp-admin" . '/includes/file.php');

    	require_once(ABSPATH . "wp-admin" . '/includes/media.php');



    	$attach_id = media_handle_upload( $file_handler, $post_id );



    	if ($setthumb) update_post_meta($post_id,'_thumbnail_id',$attach_id);

    	return $attach_id;

    }

	

	/*Allow upload files*/

    function multiple_attachment($file_handler,$post_id,$setthumb='false') {

    	// check to make sure its a successful upload

    	if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

    	require_once(ABSPATH . "wp-admin" . '/includes/image.php');

    	require_once(ABSPATH . "wp-admin" . '/includes/file.php');

    	require_once(ABSPATH . "wp-admin" . '/includes/media.php');

        $attach_id = media_handle_upload( $file_handler, $post_id );

        if ($setthumb) 

		 add_post_meta($post_id,'_thumbnail_id',$attach_id);

    	 return $attach_id;

    }

add_action('admin_menu', 'ada_add_pages');



// action function for above hook

function ada_add_pages() {

add_submenu_page('edit.php?post_type=horse', __('Options','wp_horse'), __('Options','wp_horse'), 'manage_options', 'horse_options_page', 'horse_options_page' );

}

function horse_options_page() {

    include('horse_options_page.php');

}

function action_admin_print_styles() {

	global $current_screen;
?>

<style type="text/css">

.horse-header{background: url('<?php echo PLUGIN_URL ."/".TC_DIR_NAME . '/inc/img/horse-32.png' ;?>') no-repeat left center;padding:4px 0 4px 30px}

.suggesstion-box ul{
    background: #fff none repeat scroll 0 0;
    border: 1px solid;
    padding: 3px 8px;

    position: absolute;
    width: 180px;
    z-index: 2000;
}

.suggesstion-box ul li{
	padding:3px 0;
	border-bottom:1px solid #ccc;
	cursor:pointer;
}

</style>

<?php

}

function save_pdf_meta_data($id) {
    /* --- security verification --- */

    /*if(!wp_verify_nonce($_POST['wp_pdf_attachment_nonce'], plugin_basename(__FILE__))) {

      return $id;

    }*/ // end if

       

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {

      return $id;

    } // end if

       

    if('page' == $_POST['post_type']) {

		if(!current_user_can('edit_page', $id)) {

			return $id;

		} // end if

    } else {

        if(!current_user_can('edit_page', $id)) {

            return $id;

        } // end if

    } // end if

    /* - end security verification - */


    // Make sure the file array isn't empty
    if(!empty($_FILES['horse_pdf_attachment']['name'])) {

        // Setup the array of supported file types. In this case, it's just PDF.
        $supported_types = array('application/pdf'); 

        // Get the file type of the upload
        $arr_file_type = wp_check_filetype(basename($_FILES['horse_pdf_attachment']['name']));

        $uploaded_type = $arr_file_type['type'];
  

        // Check if the type is supported. If not, throw an error.
        if(in_array($uploaded_type, $supported_types)) {

            // Use the WordPress API to upload the file
            $upload = wp_upload_bits($_FILES['horse_pdf_attachment']['name'], null, file_get_contents($_FILES['horse_pdf_attachment']['tmp_name']));

            if(isset($upload['error']) && $upload['error'] != 0) {

                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);

            } else {

                update_post_meta($id, 'horse_pdf', $upload);     

            } // end if/else

        } else {

            wp_die("The file type that you've uploaded is not a PDF.");

        } // end if/else

    } // end if

     

} // end save_custom_meta_data

add_action('save_post', 'save_pdf_meta_data');

//save post aciton

add_action('save_post', 'save_horse_image');

function save_horse_image($post_id) {

    /* --- security verification --- */
    /*if(!wp_verify_nonce($_POST['horse_photo_attachment_nonce'], plugin_basename(__FILE__))) {

      return $post_id;

    }*/ // end if

    // check autosave
	if ( defined('DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

		return $post_id;

	}

	// check permissions
	if ( 'page' == $_POST['post_type'] ) {

		if ( !current_user_can( 'edit_page', $post_id ) ) {

			return $post_id;

		}

	} elseif ( !current_user_can( 'edit_post', $post_id ) ) {

		return $post_id;

	}
    /* - end security verification - */

    // Make sure the file array isn't empty
	//echo "<pre>";print_r($_FILES);
	//die;

	if(!empty($_POST['horse_att_img'])) {

		foreach($_POST['horse_att_img'] as $attachid) {

			if(!empty($attachid)) {

				delete_post_meta($post_id,'_thumbnail_id',$attachid);

				wp_delete_post($attachid);

			}

		}

	}

    /*if (!empty($_FILES)){

		foreach ($_FILES as $file => $array) {

			if(!empty($array['name']) && $file!='horse_pdf_attachment')	{

				$newupload = multiple_attachment($file,$post_id);

			}

		}

	} */// end if

	//	Pedigree is modeled as a binary tree: S for Sire, D for Dam.
	//	These values are uppercase everwhere except in post meta; update_post_meta() is case insensitive, so we use lowercase.
	//
	//	Respective Arrays (only difference being the first character)
	//	sire_array = ['s', 'ss', 'sd', 'sss', 'ssd', 'sds', 'sdd', 'ssss', 'sssd', 'ssds', 'ssdd', 'sdss', 'sdsd', 'sdds', 'sddd'],
	//	dam_array = ['d', 'ds', 'dd', 'dss', 'dsd', 'dds', 'ddd', 'dsss', 'dssd', 'dsds', 'dsdd', 'ddss', 'ddsd', 'ddds', 'dddd'];
	//
	////////////////  EXAMPLE TREE: SIRE  //////////////////
	//                                                    //
	//                ___________S__________              //
	//               /                      \             //
	//          ____SS____             _____SD____        //
	//         /          \           /           \       //
	//       SSS         SSD         SDS         SDD      //
	//     /    \      /     \     /    \      /     \    //
	//   SSSS  SSSD  SSDS  SSDD  SDSS  SDSD  SDDS  SDDD   //
	// 												      //
	////////////////////////////////////////////////////////

	$S = $_POST['S'];
	update_post_meta($post_id, 's', $S);
		$SS = $_POST['SS'];
		update_post_meta($post_id, 'ss', $SS);
		$SD = $_POST['SD'];
		update_post_meta($post_id, 'sd', $SD);
			$SSS = $_POST['SSS'];
			update_post_meta($post_id, 'sss', $SSS);
			$SSD = $_POST['SSD'];
			update_post_meta($post_id, 'ssd', $SSD);
			$SDS = $_POST['SDS'];
			update_post_meta($post_id, 'sds', $SDS);
			$SDD = $_POST['SDD'];
			update_post_meta($post_id, 'sdd', $SDD);
				$SSSS = $_POST['SSSS'];
				update_post_meta($post_id, 'ssss', $SSSS);
				$SSSD = $_POST['SSSD'];
				update_post_meta($post_id, 'sssd', $SSSD);
				$SSDS = $_POST['SSDS'];
				update_post_meta($post_id, 'ssds', $SSDS);
				$SSDD = $_POST['SSDD'];
				update_post_meta($post_id, 'ssdd', $SSDD);
				$SDSS = $_POST['SDSS'];
				update_post_meta($post_id, 'sdss', $SDSS);
				$SDSD = $_POST['SDSD'];
				update_post_meta($post_id, 'sdsd', $SDSD);
				$SDDS = $_POST['SDDS'];
				update_post_meta($post_id, 'sdds', $SDDS);
				$SDDD = $_POST['SDDD'];
				update_post_meta($post_id, 'sddd', $SDDD);

	$D = $_POST['D'];
	update_post_meta($post_id, 'd', $D);
		$DS = $_POST['DS'];
		update_post_meta($post_id, 'ds', $DS);
		$DD = $_POST['DD'];
		update_post_meta($post_id, 'dd', $DD);
			$DSS = $_POST['DSS'];
			update_post_meta($post_id, 'dss', $DSS);
			$DSD = $_POST['DSD'];
			update_post_meta($post_id, 'dsd', $DSD);
			$DDS = $_POST['DDS'];
			update_post_meta($post_id, 'dds', $DDS);
			$DDD = $_POST['DDD'];
			update_post_meta($post_id, 'ddd', $DDD);
				$DSSS = $_POST['DSSS'];
				update_post_meta($post_id, 'dsss', $DSSS);
				$DSSD = $_POST['DSSD'];
				update_post_meta($post_id, 'dssd', $DSSD);
				$DSDS = $_POST['DSDS'];
				update_post_meta($post_id, 'dsds', $DSDS);
				$DSDD = $_POST['DSDD'];
				update_post_meta($post_id, 'dsdd', $DSDD);
				$DDSS = $_POST['DDSS'];
				update_post_meta($post_id, 'ddss', $DDSS);
				$DDSD = $_POST['DDSD'];
				update_post_meta($post_id, 'ddsd', $DDSD);
				$DDDS = $_POST['DDDS'];
				update_post_meta($post_id, 'ddds', $DDDS);
				$DDDD = $_POST['DDDD'];
				update_post_meta($post_id, 'dddd', $DDDD);


    $sire_array = compact('S', 'SS', 'SD', 'SSS', 'SSD', 'SDS', 'SDD', 'SSSS', 'SSSD', 'SSDS', 'SSDD', 'SDSS', 'SDSD', 'SDDS', 'SDDD');
    $dam_array = compact('D', 'DS', 'DD', 'DSS', 'DSD', 'DDS', 'DDD', 'DSSS', 'DSSD', 'DSDS', 'DSDD', 'DDSS', 'DDSD', 'DDDS', 'DDDD');

    // May need to find a way to pull this out of save_horse_image() (here), since it gets called again when a new horse is generated.
    pedigree_update_engine($sire_array);
    pedigree_update_engine($dam_array);

    // Pesudo code for adding pedigree horses not found in the database:
    //
    // If (any of the horses above do not exist in the database) { 
    //
    //   $new_horse_array = array_push( $new_horses ); Maybe use compact() to store variable name/value pairs
    //
    //   for each (horse in new_horse_array) {
    //
    //     1. add a new horse post -  wp_insert_new_horese()
    //     2. include relevant POSTed pedigree data in this horse's meta tags (use node name to determine starting point/s&d levels to cut when adding meta data {e.g. if horse SSD becomes root, horse SSDS becomes S})
    //     3. Add the "pedigree only" category to ensure post does not surface on front end.
    //          
    //   }
    // }
    //
    // Look for wp_insert_new_horese() in pet-manager.php and extend.php (aria og backup) to implement
    //===============================================================    
      

	//save progeny
	//if( isset($_POST['progeny']) ) {

        $post_progeny = $_POST['progeny'];

	    delete_post_meta($post_id,'progeny_id');

	    if ( is_array($post_progeny) == true) {

            foreach($post_progeny as $pro_id){

        	   add_post_meta($post_id,'progeny_id',$pro_id);

    	    }
        
        } else {

            add_post_meta($post_id,'progeny_id',$post_progeny);

        }  

	//}

        // Save attachment list order, sans deleted items
        $attach_list_order = $_POST['attach-list-order'];
        $attach_list_deletions = $_POST['attach-list-deletions'];

        if ($attach_list_order !== '') {

            // Convert the comma separated POST values into arrays
            $new_list = explode(",",$attach_list_order);
            $delete_list = explode(",",$attach_list_deletions);

            // Remove any matching elements (aka deleted attachment IDs)
            $new_list = array_diff($new_list, $delete_list);

            delete_post_meta($post_id,'attach-list');

            // Delete deleted attachments from media library

            foreach ($delete_list as $deleted) {
                wp_delete_attachment( $deleted );
            }

            foreach ($new_list as $currentElement) {
                add_post_meta($post_id,'attach-list',$currentElement);
            }
        }

        // Save current tab
	        /*
	        $current_tab = $_POST['current-tab'];

	        delete_post_meta($post_id,'current-tab');

	        add_post_meta($post_id,'current-tab',$current_tab);
	        */


        // Delete categories
        $deleted_categories = $_POST['deleted-categories'];

        if ($deleted_categories !== '') {

            $deleted_list = explode(",", $deleted_categories);

            foreach ($deleted_list as $cat) {
                $this_cat_ID = get_cat_ID( $cat );

                wp_delete_term( $this_cat_ID, 'horse-category' );
            }

        }


} 

//add_action('do_meta_boxes', 'remove_thumbnail_box');
function remove_thumbnail_box() {

    remove_meta_box( 'postimagediv','horse','side' );

}

//add_filter( 'posts_where', 'title_like_posts_where', 10, 2 );
function title_like_posts_where( $where, &$wp_query ) {

    global $wpdb;

    if ( $post_title_like = $wp_query->get( 'post_title_like' ) ) {

        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql( $wpdb->esc_like( $post_title_like ) ) . '%\'';

    }

    return $where;

}



function selectpedigree_ajax_callback() { 

    $posttitle = $_POST['title'];

	$current_post_id = $_POST['cr_post_id'];

	$search_type = $_POST['search_type'];
       

	$posts_array = get_posts(

		array(

			'posts_per_page' => -1,
			     'post_type' => 'horse',
			'post_status'    => 'any',
			             "s" => $posttitle

			//'post_title_like' => $posttitle

		)

    );

    // Store the length of the POSTed 'match' value.
    $match_length = strlen($_POST['match']);

	if(!empty($posts_array && $match_length > 0)){

    	echo '<ul style="max-height: 120px; overflow: scroll">';

    	foreach($posts_array as $parent){

            // Store the first x characters of the current parent's name, where x = $match_length.
            $parent_match = substr($parent->post_title, 0, $match_length);

            /*?>console.log(<?php ?>);<?php*/

            // If the 'match' and 'parent_match' values are identical (but the horses they belong to aren't), continue on.
            if ($parent->ID != $current_post_id && strtolower($parent_match) == strtolower($_POST['match'])) {

                // Echo a list of selectable names, with the onclick callback determined by which search box we're using (mother or father).
                /*if($search_type=='mother'){ 

                    echo '<li onclick="selectMotherId('.$parent->ID.',\''.$parent->post_title.'\')">' . $parent->post_title . '</li>';   

                }else{*/

                    echo '<li onclick="selectParentId('.$parent->ID.',\''.addslashes($parent->post_title).'\')">' . $parent->post_title . '</li>';

                //}  

            }

        }

	   echo '</ul>';

	} else {

        // If there's nothing in the potential match array, say so. This still fails in some cases (leaving a blank box).
        echo '<ul>';
            echo 'No records found.';
        echo '</ul>';

	}

exit;

}

function savecropimg_ajax_callback(){

	$file_path    = get_attached_file($_POST['attchment_id']);
	$filename_err = explode(".",$file_path);
	$file_ext     = end($filename_err);
	$file_ext     = strtolower($file_ext);
	$jpeg_quality = 100;
	$targ_w       = $_POST['w'];
	$targ_h       = $_POST['h'];
	$src          = $file_path;

    //$new_src = substr($src, -4);                           // Strips last four characters from $src
    //$new_src = pathinfo($src)['dirname'];                  // Strips everything but the directiory info
    $new_src = preg_replace('/\\.[^.\\s]{3,4}$/', '', $src); // roughly strips file extensions

	switch($file_ext){
                case 'jpg':
                    $img_r = imagecreatefromjpeg($src);
                    break;
                case 'jpeg':
                    $img_r = imagecreatefromjpeg($src);
                    break;

                case 'png':
                    $img_r = imagecreatefrompng($src);
                    break;
                case 'gif':
                    $img_r = imagecreatefromgif($src);
                    break;
                default:
                    $img_r = imagecreatefromjpeg($src);
            }

	
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
	
    imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);
	switch($file_ext){
                case 'jpg' || 'jpeg':
                    $new_src = $new_src."_".round($targ_w)."x".round($targ_h)."_cropped.jpg";
                    imagejpeg($dst_r,$new_src,$jpeg_quality);
                    break;
                case 'png':
                    $new_src = $new_src."_".round($targ_w)."x".round($targ_h)."_cropped.png";
                    imagepng($$dst_r,$new_src);
                    break;

                case 'gif':
                    $new_src = $new_src."_".round($targ_w)."x".round($targ_h)."_cropped.gif";
                    imagegif($dst_r,$new_src,$jpeg_quality);
                    break;
                default:
                    $new_src = $new_src."_".round($targ_w)."x".round($targ_h)."_cropped.jpeg";
                    imagejpeg($dst_r,$new_src,$jpeg_quality);
            }

    $parent_post_id = $_POST['this-post'];
    $wp_upload_dir  = wp_upload_dir();
    $path           = $wp_upload_dir['path'] . '/';
    $filename       = $new_src;
    $filetype       = wp_check_filetype( basename( $filename ), null );
    $attachment     = array(
        'guid'           => $filename,
        'post_mime_type' => $filetype['type'],
        'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
        'post_content'   => '',
        'post_status'    => 'inherit'
    );

    // Insert attachment to the database
    $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

    require_once( ABSPATH . 'wp-admin/includes/image.php' );

    // Generate meta data
    $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
    wp_update_attachment_metadata( $attach_id, $attach_data );

    $response = array(
        'attach_id'     => $attach_id,
        'attach_url'    => wp_get_attachment_url($attach_id),
        'src'           => $src,
        'newsrc'        => $new_src,
        'wp_upload_dir' => $wp_upload_dir
    );

    echo json_encode($response);


exit;
}


function selectprogeny_ajax_callback() {

	global $wpdb; // this is how you get access to the database

    $gender = strtolower($_POST['gender']);

	$posts_array = get_posts(

	    array(

	        'posts_per_page' => -1,
	        'post_type'      => 'horse',
			'post_status'    => 'any',

	        //'tax_query' => array(
	        //    array(
	        //        'taxonomy' => 'horse-gender',
	        //        'field' => 'slug',
	        //        'terms' => $gender,
	        //    )
	        //)
	    )

	);

$html = '';

$html.=  '<tbody>';

if(!empty($posts_array)){

	foreach($posts_array as $progeny){

		if ($progeny->ID != $_POST['cr_post_id']) {

			$html.=  '<tr>

			<th style="width:18%"><label for="">'.ucfirst($progeny->post_title).'</label></th>

			<td><input name="progeny[]" id="horse_progeny_'.$progeny->ID.'" type="checkbox" value="'.$progeny->ID.'"></td>

			</tr>';

		}

	}

} else {

	$html.=  '<tr>

	<td>No record found</td>

	</tr>';

}

$html.=  '</tbody>';

echo $html;

exit; // this is required to terminate immediately and return a proper response

}

// end save_custom_meta_data

function selectparent_ajax_callback() {

    global $post;

    $ajaxResp = array();

    $father = $_POST['father'];

    $ajaxResp['The father is']= $father;

    update_post_meta($post->ID, 'father', $_POST['father']);

    echo json_encode($ajaxResp);

    exit;
}

function selectparents_ajax_callback(){

	$ajaxResp    = array();
    $child_id    = $_POST['child_id'];
	$parent_type = $_POST['parent_type'];

	$S_name = get_post_meta($child_id, 's', true);
	$ajaxResp['S'] = $S_name;
	$SS_name = get_post_meta($child_id, 'ss', true);
	$ajaxResp['SS'] = $SS_name;
	$SD_name = get_post_meta($child_id, 'sd', true);
	$ajaxResp['SD'] = $SD_name;
		$SSS_name = get_post_meta($child_id, 'sss', true);
		$ajaxResp['SSS'] = $SSS_name;
		$SSD_name = get_post_meta($child_id, 'ssd', true);
		$ajaxResp['SSD'] = $SSD_name;
		$SDS_name = get_post_meta($child_id, 'sds', true);
		$ajaxResp['SDS'] = $SDS_name;
		$SDD_name = get_post_meta($child_id, 'sdd', true);
		$ajaxResp['SDD'] = $SDD_name;
			$SSSS_name = get_post_meta($child_id, 'ssss', true);
			$ajaxResp['SSSS'] = $SSSS_name;
			$SSSD_name = get_post_meta($child_id, 'sssd', true);
			$ajaxResp['SSSD'] = $SSSD_name;
			$SSDS_name = get_post_meta($child_id, 'ssds', true);
			$ajaxResp['SSDS'] = $SSDS_name;
			$SSDD_name = get_post_meta($child_id, 'ssdd', true);
			$ajaxResp['SSDD'] = $SSDD_name;
			$SDSS_name = get_post_meta($child_id, 'sdss', true);
			$ajaxResp['SDSS'] = $SDSS_name;
			$SDSD_name = get_post_meta($child_id, 'sdsd', true);
			$ajaxResp['SDSD'] = $SDSD_name;
			$SDDS_name = get_post_meta($child_id, 'sdds', true);
			$ajaxResp['SDDS'] = $SDDS_name;
			$SDDD_name = get_post_meta($child_id, 'sddd', true);
			$ajaxResp['SDDD'] = $SDDD_name;

	$D_name = get_post_meta($child_id, 'd', true);
	$ajaxResp['D'] = $D_name;
		$DS_name = get_post_meta($child_id, 'ds', true);
		$ajaxResp['DS'] = $DS_name;
		$DD_name = get_post_meta($child_id, 'dd', true);
		$ajaxResp['DD'] = $DD_name;
			$DSS_name = get_post_meta($child_id, 'dss', true);
			$ajaxResp['DSS'] = $DSS_name;
			$DSD_name = get_post_meta($child_id, 'dsd', true);
			$ajaxResp['DSD'] = $DSD_name;
			$DDS_name = get_post_meta($child_id, 'dds', true);
			$ajaxResp['DDS'] = $DDS_name;
			$DDD_name = get_post_meta($child_id, 'ddd', true);
			$ajaxResp['DDD'] = $DDD_name;
				$DSSS_name = get_post_meta($child_id, 'dsss', true);
				$ajaxResp['DSSS'] = $DSSS_name;
				$DSSD_name = get_post_meta($child_id, 'dssd', true);
				$ajaxResp['DSSD'] = $DSSD_name;
				$DSDS_name = get_post_meta($child_id, 'dsds', true);
				$ajaxResp['DSDS'] = $DSDS_name;
				$DSDD_name = get_post_meta($child_id, 'dsdd', true);
				$ajaxResp['DSDD'] = $DSDD_name;
				$DDSS_name = get_post_meta($child_id, 'ddss', true);
				$ajaxResp['DDSS'] = $DDSS_name;
				$DDSD_name = get_post_meta($child_id, 'ddsd', true);
				$ajaxResp['DDSD'] = $DDSD_name;
				$DDDS_name = get_post_meta($child_id, 'ddds', true);
				$ajaxResp['DDDS'] = $DDDS_name;
				$DDDD_name = get_post_meta($child_id, 'dddd', true);
				$ajaxResp['DDDD'] = $DDDD_name;

	echo json_encode($ajaxResp);	 

    exit;

}
//add meta box for pedigree

//add meta box for photo uploads
add_action('wp_ajax_cvf_upload_files', 'cvf_upload_files_callback');
function cvf_upload_files_callback(){
   
    $parent_post_id   = isset( $_POST['post_id'] ) ? $_POST['post_id'] : 0;  // The parent ID of our attachments
    $valid_formats    = array("jpg", "png", "gif", "bmp", "jpeg"); // Supported file types
    $max_file_size    = 1024 * 500; // in kb
    $max_image_upload = 20; // Define how many images can be uploaded to the current post
    $wp_upload_dir    = wp_upload_dir();
    $path             = $wp_upload_dir['path'] . '/';
    $count            = 0;
    $uploaded_file    = '';
    $attachments      = get_posts( 
					    	array(
						        'post_type'      => 'attachment',
						        'posts_per_page' => -1,
						        'post_parent'    => $parent_post_id,
						        'exclude'        => get_post_thumbnail_id() // Exclude post thumbnail to the attachment count
						    )
					    );

    // Image upload handler
    if( $_SERVER['REQUEST_METHOD'] == "POST" ){
       
        // Check if user is trying to upload more than the allowed number of images for the current post
        if( ( count( $attachments ) + count( $_FILES['files']['name'] ) ) > $max_image_upload ) {
            $upload_message[] = "Sorry you can only upload " . $max_image_upload . " images for each Ad";
        } else {
           
            foreach ( $_FILES['files']['name'] as $f => $name ) {
                $extension = pathinfo( $name, PATHINFO_EXTENSION );
                // Generate a randon code for each file name
                $new_filename = cvf_td_generate_random_code( 20 )  . '.' . $extension;
               
                if ( $_FILES['files']['error'][$f] == 4 ) {
                    continue;
                }
               
                if ( $_FILES['files']['error'][$f] == 0 ) {
                    // Check if image size is larger than the allowed file size
                    if ( $_FILES['files']['size'][$f] > $max_file_size ) {
                        $upload_message[] = "$name filesize is too large! (512kb).";
                        continue;
                   
                    // Check if the file being uploaded is in the allowed file types
                    } elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
                        $upload_message[] = "$name is not a valid format";
                        continue;
                   
                    } else{
                        // If no errors, upload the file...
                        if( move_uploaded_file( $_FILES["files"]["tmp_name"][$f], $path.$new_filename ) ) {
                           
                            $count++;

                            $filename = $path.$new_filename;
                            $filetype = wp_check_filetype( basename( $filename ), null );
                            $wp_upload_dir = wp_upload_dir();
                            $attachment = array(
                                'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ),
                                'post_mime_type' => $filetype['type'],
                                'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
                                'post_content'   => '',
                                'post_status'    => 'inherit'
                            );
                            // Insert attachment to the database
                            $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );
                           
						  $uploaded_file.= '<li id="img_li_'.$attach_id.'"><div class="img-overlay">
									<img src="'.$wp_upload_dir['url'] . '/' . basename( $filename ).'" width="150" id="horse_img_'.$attach_id.'"/>
									<div class="attach-buttons">

                                    <a class="move-img"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="24 23 49 49" style="fill:#fff" xml:space="preserve">
                                        <g>
                                            <path d="M73,48.4l-10.4-9.6v4.8H52.4V33.4h4.8L47.6,23l-8.9,10.4h4.8v10.2H33.4v-4.8L23,48.4l10.4,8.9v-4.8h10.2v10.2h-4.8L47.6,73
                                                l9.6-10.4h-4.8V52.4h10.2v4.8L73,48.4z"/>
                                        </g>
                                        </svg></a>

                                    <a href="#TB_inline?width=600&height=550&inlineId=cropper-popup" onclick="set_img_src('. $attach_id.')" class="thickbox crop-img"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 512 512" fill="#fff" xml:space="preserve">
                                        <polygon points="350.552,354 186.337,354 350,189.458 350,327 421,327 421,162.054 421,118.861 495.424,44.512 466.937,15.758 
                                            391.503,91 350.552,91 184,91 184,162 320.906,162 157,325.148 157,162.054 157,91.458 157,20 87,20 87,91 16,91 16,162 87,162 
                                            87,353.674 87,424 157.812,424 350,424 350,496 421,496 421,424 491,424 491,354 421.148,354 "/>
                                        </svg></a>

                                    <a onclick="delete_img('.$attach_id.');" href="javascript:void(0)" class="delete-img"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 26 26" class="icon icons8-Trash" ><g id="surface1"><path style="fill:#fff" d="M 11 -0.03125 C 10.164063 -0.03125 9.34375 0.132813 8.75 0.71875 C 8.15625 1.304688 7.96875 2.136719 7.96875 3 L 4 3 C 3.449219 3 3 3.449219 3 4 L 2 4 L 2 6 L 24 6 L 24 4 L 23 4 C 23 3.449219 22.550781 3 22 3 L 18.03125 3 C 18.03125 2.136719 17.84375 1.304688 17.25 0.71875 C 16.65625 0.132813 15.835938 -0.03125 15 -0.03125 Z M 11 2.03125 L 15 2.03125 C 15.546875 2.03125 15.71875 2.160156 15.78125 2.21875 C 15.84375 2.277344 15.96875 2.441406 15.96875 3 L 10.03125 3 C 10.03125 2.441406 10.15625 2.277344 10.21875 2.21875 C 10.28125 2.160156 10.453125 2.03125 11 2.03125 Z M 4 7 L 4 23 C 4 24.652344 5.347656 26 7 26 L 19 26 C 20.652344 26 22 24.652344 22 23 L 22 7 Z M 8 10 L 10 10 L 10 22 L 8 22 Z M 12 10 L 14 10 L 14 22 L 12 22 Z M 16 10 L 18 10 L 18 22 L 16 22 Z "></path></g></svg></a>	</div>
									</div>
<input type="hidden" id="attachment_hidden_'.$attach_id.'" value="" name="horse_att_img[]"/>
									<input type="hidden" id="thumbnail_id_'.$attach_id.'" value="'.$attach_id.'" name="thumbnail_id_'.$attach_id.'"/>
									<input type="hidden" id="orginal_img_'.$attach_id.'" value="'.$wp_upload_dir['url'] . '/' . basename( $filename ).'" name="orginal_img_'.$attach_id.'"/>			
									</li>';
                            require_once( ABSPATH . 'wp-admin/includes/image.php' );
                           
                            // Generate meta data
                            $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
                            wp_update_attachment_metadata( $attach_id, $attach_data );
                           
                        }
                    }
                }
            }
        }
    }
    // Loop through each error then output it to the screen
    if ( isset( $upload_message ) ) :
        foreach ( $upload_message as $msg ){       
            printf( __('<p class="bg-danger">%s</p>', 'wp-trade'), $msg );
        }
    endif;
   
    // If no error, show success message
    if( $count != 0 ){
        echo $uploaded_file;  
    }
   
    exit();
}

// Random code generator used for file names.
function cvf_td_generate_random_code($length=10) {
 
   $string = '';
   $characters = "23456789ABCDEFHJKLMNPRTVWXYZabcdefghijklmnopqrstuvwxyz";
 
   for ($p = 0; $p < $length; $p++) {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
 
   return $string;
 
}


add_action( 'wp_ajax_searchprogeny', 'selectprogeny_ajax_callback' );
add_action( 'wp_ajax_searchpedigree', 'selectpedigree_ajax_callback' );
add_action( 'wp_ajax_parents', 'selectparents_ajax_callback' );
add_action( 'wp_ajax_parent', 'selectparent_ajax_callback' );
add_action( 'admin_footer', 'progeny_js' ); 
add_action( 'wp_ajax_savecropimg', 'savecropimg_ajax_callback' );

function progeny_js() {?>

<script type="text/javascript">

var count = 2;

function add_member(){

	var inputdiv = '<div id="horse_img_'+count+'"><input type="file" id="horse_photo_attachment" name="image_'+count+'" value="" size="25" /> <a href="javascript:void(0)" onclick="remove_member('+count+')">Remove</a></div>';

	jQuery('#horse_photo').append(inputdiv);

	count++;

}

function remove_member(divid){

   jQuery("#horse_img_"+divid).remove();

}

function crawlList(event, ui) {
	jQuery("#save-reminder").addClass("expand");
	//console.log(jQuery('.attach_list li')[0].id);

	// Select all the attachment thumbnail DOM nodes
	var listOfAttachments = jQuery('.attach_list li'),
		  listToPost = [];

	// Pack them into an array
	for (var i = 0; i < listOfAttachments.length; i++ ) {
			listToPost.push(listOfAttachments[i].id.substr(7));
	}

	// Store those values in the attach-list-order input to be POSTed off.
	jQuery('#attach-list-order').val(listToPost);
	//console.log(listToPost);
}

function overAttach() {
	jQuery(this).children('img').toggleClass('attach-hover');
	jQuery(this).children('div').toggleClass('attach-hover');
}

function offAttach() {
	jQuery(this).children('img').toggleClass('attach-hover');
	jQuery(this).children('div').toggleClass('attach-hover');
}

var deletionsList = [];

function listDeletions(id) {
    deletionsList.push(id);

    jQuery('#attach-list-deletions').val(deletionsList);
    //console.log(deletionsList);
}

function delete_img(liid){
    
    listDeletions(liid);
    crawlList();
    // Decrement the attachment count
    attachment_count--;

    // Fade the deleted attachment
    jQuery("#img_li_"+liid).animate({opacity: 0}, 250, function() {

        // If there aren't any attachments left, close the attachment section
        if (attachment_count == 0) {

                jQuery(".attach_list").animate({height: '0px'}, 250);
                jQuery("#img_li_"+liid).hide();

            }

        // Otherwise, slide the remaining attachments over (by squeezing the deleted attachment to 0px wide)
        else if (attachment_count > 0) {
            jQuery("#img_li_"+liid).animate({width: '0px'}, 250, function() {

                jQuery("#img_li_"+liid).hide();

            });
            
        };
    });

   jQuery("#attachment_hidden_"+liid).val(liid);

   jQuery("#save-post").focus();

   jQuery("#save-reminder").addClass("expand");

}

function set_img_src(id){

	jQuery('#cropbox-1').attr("src",'');
	jQuery('#cropbox-1').attr("src",jQuery('#orginal_img_'+id).val());
	jQuery('#attchment_id').val(jQuery('#thumbnail_id_'+id).val());

	if (typeof jcrop_api != 'undefined') 

		jcrop_api.destroy();

		jQuery('#cropbox-1').Jcrop({
			minSize: [100,100], 
			setSelect: [0,0,16,20],
			aspectRatio :6/5, 
			boxWidth: 500,boxHeight: 500,
			onSelect: updateCoords
		}, function(){

			// use the Jcrop API to get the real image size
			var bounds = this.getBounds();
			boundx = bounds[0];
			boundy = bounds[1];

			// Store the Jcrop API in the jcrop_api variable
			jcrop_api = this;
		});  

}

// SAVE CROP FUNCTION
function saveFormData(formid){

	var id = jQuery('#attchment_id').val();
	var this_post = jQuery('#this-post').val();
	var data = {
		'action': 'savecropimg',
		'this-post': jQuery('#this-post').val(),
		'x': jQuery('#x').val(),
		'y':jQuery('#y').val(),
		'w':jQuery('#w').val(),
		'h':jQuery('#h').val(),
		'attchment_id': jQuery('#attchment_id').val()
	};

	ajaxindicatorstart('Processing, Please wait.');

	jQuery.post(ajaxurl, data, function(response) {

		// When we close the cropping window, parse the JSON response and
		// add the new crop into our attachment section
		jQuery("#TB_closeWindowButton").trigger( "click" );
		var responseObject = jQuery.parseJSON(response);

        console.log(JSON.stringify(responseObject));

		// Once the crop comes back, add the attachment to the list
		attachment_count++;

		crawlList();

		jQuery('.attach_list')
			.prepend('<li id="img_li_'+responseObject.attach_id+'" class="new-attach">\
				<div class="img-overlay">\
					<img src="'+responseObject.attach_url+'" id="horse_img_'+responseObject.attach_id+'"/>\
                    <div id="img_edit_'+responseObject.attach_id+'" class="attach-buttons">\
					<a class="move-img">\
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="24 23 49 49" style="fill:#fff" xml:space="preserve"><g>\
                            <path d="M73,48.4l-10.4-9.6v4.8H52.4V33.4h4.8L47.6,23l-8.9,10.4h4.8v10.2H33.4v-4.8L23,48.4l10.4,8.9v-4.8h10.2v10.2h-4.8L47.6,73l9.6-10.4h-4.8V52.4h10.2v4.8L73,48.4z"/></g>\
                        </svg>\
                    </a>\
					<a href="#TB_inline?width=600&height=550&inlineId=cropper-popup" onclick="set_img_src('+responseObject.attach_id+')" class="thickbox crop-img">\
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 512 512" fill="#fff" xml:space="preserve"><polygon points="350.552,354 186.337,354 350,189.458 350,327 421,327 421,162.054 421,118.861 495.424,44.512 466.937,15.758 391.503,91 350.552,91 184,91 184,162 320.906,162 157,325.148 157,162.054 157,91.458 157,20 87,20 87,91 16,91 16,162 87,162 87,353.674 87,424 157.812,424 350,424 350,496 421,496 421,424 491,424 491,354 421.148,354 "/>\
                        </svg>\
                    </a>\
                    <a onclick="delete_img('+responseObject.attach_id+');" href="javascript:void(0)" class="delete-img">\
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 26 26" class="icon icons8-Trash" ><g id="surface1"><path style="fill:#fff" d="M 11 -0.03125 C 10.164063 -0.03125 9.34375 0.132813 8.75 0.71875 C 8.15625 1.304688 7.96875 2.136719 7.96875 3 L 4 3 C 3.449219 3 3 3.449219 3 4 L 2 4 L 2 6 L 24 6 L 24 4 L 23 4 C 23 3.449219 22.550781 3 22 3 L 18.03125 3 C 18.03125 2.136719 17.84375 1.304688 17.25 0.71875 C 16.65625 0.132813 15.835938 -0.03125 15 -0.03125 Z M 11 2.03125 L 15 2.03125 C 15.546875 2.03125 15.71875 2.160156 15.78125 2.21875 C 15.84375 2.277344 15.96875 2.441406 15.96875 3 L 10.03125 3 C 10.03125 2.441406 10.15625 2.277344 10.21875 2.21875 C 10.28125 2.160156 10.453125 2.03125 11 2.03125 Z M 4 7 L 4 23 C 4 24.652344 5.347656 26 7 26 L 19 26 C 20.652344 26 22 24.652344 22 23 L 22 7 Z M 8 10 L 10 10 L 10 22 L 8 22 Z M 12 10 L 14 10 L 14 22 L 12 22 Z M 16 10 L 18 10 L 18 22 L 16 22 Z "></path></g>\
                        </svg>\
                    </a>\
                    </div>\
                    </div>\
				<input type="hidden" id="attachment_hidden_'+responseObject.attach_id+'" value="" name="horse_att_img[]"/>\
				<input type="hidden" id="thumbnail_id_'+responseObject.attach_id+'" value="'+responseObject.attach_id+'" name="thumbnail_id_'+responseObject.attach_id+'"/>\
				\
				<input type="hidden" id="orginal_img_'+responseObject.attach_id+'" value="'+responseObject.attach_url+'" name="orginal_img_'+responseObject.attach_id+'"/>\
			</li>\
		');

        //Count the attachments. We'll refer back to this when handling attachment deletion animations.
        //var attachment_count = jQuery('.attach_list li').length;



        // Handle hover animation for these attachments
        jQuery('.img-overlay:first').on("mouseover", overAttach)
                               .on("mouseout", offAttach);

        function overAttach() {
            jQuery(this).children('img').toggleClass('attach-hover');
            jQuery(this).children('div').toggleClass('attach-hover');
        }

        function offAttach() {
            jQuery(this).children('img').toggleClass('attach-hover');
            jQuery(this).children('div').toggleClass('attach-hover');
        }

        //Hover animation for svg attachment editing buttons
        jQuery('.img-overlay:first .attach-buttons a').on("mouseover", overEditButton )
                                    .on("mouseout", offEditButton );

        function overEditButton() {

            if ( jQuery(this).hasClass('delete-img') ) {
                jQuery(this).find('path').css('fill', 'red');
            } else if ( jQuery(this).hasClass('crop-img' )) {
                jQuery(this).find('polygon').css('fill', '#12cc12');
            } else {
                jQuery(this).find('path').css('fill', '#55b0ff');
            }
        }

        function offEditButton() {
            jQuery(this).find('path').css('fill', 'white');
            jQuery(this).find('polygon').css('fill', 'white');
        }

		jQuery('#img_li_'+responseObject.attach_id).animate({width: '150px'}, 250, function() {
		jQuery('#img_li_'+responseObject.attach_id).animate({opacity: 1}, 250);
		});
		crawlList();
		//Query('#horse_img_'+id).attr("src",'');
		//jQuery('#horse_img_'+id).attr("src",response);
		//jQuery('#orginal_img_'+id).val('');
		//jQuery('#orginal_img_'+id).val(response);
		ajaxindicatorstop();	
	});
}

jQuery(document).ready(function(){

    jQuery('#menu-media').before('<li><a href="" id="settings-divider" class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media menu-top-first" aria-haspopup="true"><div class="wp-menu-name">Advanced Settings</div></a></li>');

  //Validation for category select (must select a category to publish)

  <?php global $post_type;

	if($post_type=='horse'){ ?>

    jQuery('#publish, #save-post').click(function(e){

        if(jQuery('#taxonomy-horse-category input:checked').length==0){

            alert('Please select category');

            e.stopImmediatePropagation();

            return false;

        }else{

            return true;

        }

    });

    var publish_click_events = jQuery('#publish').data('events').click;

    if(publish_click_events){

        if(publish_click_events.length>1){

            publish_click_events.unshift(publish_click_events.pop());

        }

    }

    if(jQuery('#save-post').data('events') != null){

        var save_click_events = jQuery('#save-post').data('events').click;

        if(save_click_events){

            if(save_click_events.length>1){

                save_click_events.unshift(save_click_events.pop());

            }

        }

    }

	// Directs user to choose gender in order to list progeny. No longer necessary under new structure.

	/*if(jQuery("#_data_horse_gender").val()==''){

		jQuery("#horse_progeny .form-table").hide();

		jQuery("#horse_progeny .inside").append('<Span id="progeny_msg">Please first select gender (found in the details tab).</span>');

	}*/

  //Progeny selct on change

  <?php } ?>

  jQuery("#_data_horse_gender").change(function(){

      var gender = jQuery(this).val();

      if( gender ==''){

	     jQuery("#horse_progeny .form-table").hide();
		 jQuery("#horse_progeny #progeny_msg").show();

	  }else{

	    var data = {

			'action'     : 'searchprogeny',
			'gender'     :  gender,
			'cr_post_id' : '<?php global $post; echo $post->ID;?>'

		};

	     jQuery("#horse_progeny .form-table").show();

		 jQuery.post(ajaxurl, data, function(response) {

		 jQuery("#horse_progeny .form-table").html(response);

		 jQuery("#horse_progeny #progeny_msg").hide();

		});

	  }

  });


  // Pedigree dropdown and search

  jQuery("#mother-dropdown").change(function(){

      var mother_id = jQuery(this).val();

	  //jQuery("#hide-mother").val(mother_id);

	  parnets_ajax_call(mother_id,'m');

   });

   jQuery("#father-dropdown").change(function(){

      var father_id = jQuery(this).val();

	  //jQuery("#hide-father").val(father_id);

	   parnets_ajax_call(father_id,'f');

   });

  

  /*jQuery(".search-box").blur(function(){

  jQuery("#suggesstion-box").hide();

  });*/

  // BEGIN MANUAL SWITCH FUNCTION *DEPRECATED* -----------------------------------------
	jQuery("#set-manual_m").click(function(e){
		jQuery("#mother-dropdown").hide();
		jQuery("#set-manual_m").hide();
		jQuery("#search-mother").show();
		jQuery("#set-select_m").show();
		jQuery("#manual_m").val(1);
		//empty_boxes_m();
	});	
jQuery("#set-select_m").click(function(e){
	jQuery("#mother-dropdown").show();
	//jQuery("#mother-dropdown option:selected").remove();
	jQuery("#set-manual_m").show();
	jQuery("#search-mother").hide();
	jQuery("#set-select_m").hide();
	jQuery("#manual_m").val('');
	//empty_boxes_m();
	var mother_id = jQuery("#"+activeField+"").val();
	if(mother_id !== ''){
	  parnets_ajax_call(mother_id,'m');
	}
    
	
});	

  jQuery("#set-manual").click(function(e){
	jQuery("#father-dropdown").hide();
	jQuery("#set-manual").hide();
	jQuery("#search-father").show();
	jQuery("#set-select").show();
	jQuery("#manual_f").val(1);
	//empty_boxes();
	
});	
jQuery("#set-select").click(function(e){
	jQuery("#father-dropdown").show();
	//jQuery("#father-dropdown option:selected").remove();
	jQuery("#set-manual").show();
	jQuery("#search-father").hide();
	jQuery("#set-select").hide();
	jQuery("#manual_f").val('');
	//empty_boxes();
	var father_id = jQuery("#"+activeField+"").val();
	if(father_id !== ''){
        console.log(father_id);
        //parnets_ajax_call(father_id,'f');
	}
	
});
// END MANUAL SWITCH FUNCTION *DEPRECATED* -----------------------------------------

    jQuery("#horse_pedigree *").keyup(function() {

        activeField = document.activeElement;

    });

//===================================================================
//===================================================================
//============== PEDIGREE SUGGESTION FUNCTIONALITY ==================

var sire_array = ['S', 'SS', 'SD', 'SSS', 'SSD', 'SDS', 'SDD', 'SSSS', 'SSSD', 'SSDS', 'SSDD', 'SDSS', 'SDSD', 'SDDS', 'SDDD'],
         dam_array = ['D', 'DS', 'DD', 'DSS', 'DSD', 'DDS', 'DDD', 'DSSS', 'DSSD', 'DSDS', 'DSDD', 'DDSS', 'DDSD', 'DDDS', 'DDDD'];

// Call the function for both Sire and Dam rows
pedigreeFieldListeners(sire_array);
pedigreeFieldListeners(dam_array);

// Where the suggestion magic happens
function pedigreeFieldListeners(gender_array) {

	// Loop through every input filed in the gender_array
    for (var i = 0; i < gender_array.length; i++) {

    	// Add a keyup event listener
    	jQuery("#"+gender_array[i]).keyup(function(){

    		// Save the clicked element for reference
    		var clicked = this.id;

    		// Prepare our request using the respective field's input value
		    var data = {

				'action'        : 'searchpedigree',
				'title'         : jQuery(this).val(),
				'cr_post_id'    : '<?php global $post; echo $post->ID;?>',
				//'search_type' : 'mother',
	            'match'         : jQuery("#"+this.id).val()

			};

			// Send the request off
			jQuery.post(ajaxurl, data, function(response) {

				// Show the suggestion box (using that saved element reference from earlier)
				jQuery("#"+clicked+"-suggest-box").show();

				// And fill the box with the response
				jQuery("#"+clicked+"-suggest-box").html(response);

			});
		});

		// And a listener to hide the suggest box when we click out
		jQuery("#"+gender_array[i]).focusout(function(){

			var focused_element = this.id;

        	setTimeout(function () {

				jQuery("#"+focused_element+"-suggest-box").hide();

            }, 200);
    });
	}
}


//============  END PEDIGREE SUGGESTION FUNCTIONALITY ===============
//===================================================================
//===================================================================

    // For photo page
    jQuery(".upload-form .btn-upload").click(function(e){

	    e.preventDefault();

        var fd = new FormData();
        var files_data = jQuery('.upload-form .files-data'); // The <input type="file" /> field
       
        // Loop through each data and create an array file[] containing our files data.
        jQuery.each(jQuery(files_data), function(i, obj) {
            jQuery.each(obj.files,function(j,file){
                fd.append('files[' + j + ']', file);
            })
        });
       
        // our AJAX identifier
        fd.append('action', 'cvf_upload_files');  
       
        // uncomment this code if you do not want to associate your uploads to the current page.
        fd.append('post_id', <?php echo $post->ID; ?>);
        ajaxindicatorstart('Processing, Please wait.');

        jQuery.ajax({
            type        : 'POST',
            url         : '<?php echo admin_url( 'admin-ajax.php' ); ?>',
            data        : fd,
            contentType : false,
            processData : false,
            success     : function(response){
		                jQuery('.attach_list').append(response);
		                crawlList();
		                jQuery('.img-overlay').on("mouseover", overAttach).on("mouseout", offAttach);
						ajaxindicatorstop();
            }
        });
                                
	});

	});

// Figure out how to generalize this behavior to all input fields.

function selectParentId(id,title) {

    var parent_row = activeField.name[0],
    		  node = activeField.name;

    //console.log("Node: " + node);

	parnets_ajax_call(id, parent_row, node, title);
}

function parnets_ajax_call(child_id, parent_row, node, title){

    var node_depth = node.length,
        node_cat = node[(node.length-1)];

    //console.log("Child id, parent type, category, and node: " + child_id, parent_row, node_cat, node);

    var data = {

		    'action' : 'parents',

		  'child_id' : child_id,

		'parent_row' : parent_row,

		'node_depth' : node_depth,

		  'node_cat' : node_cat

	};

	jQuery.post(ajaxurl,data).done(function( response ) {

	    JSON.parse(response, function (key,value) {

	       //console.log("key: " + node + key, "| Value: " + value);

           jQuery('#' + node + key).attr('value', value);

           jQuery('#'+node).attr('value', title);

	    });   

	});

}

  function updateCoords(c)
  {
    jQuery('#x').val(c.x);
    jQuery('#y').val(c.y);
    jQuery('#w').val(c.w);
    jQuery('#h').val(c.h);
  };

  function checkCoords()
  {
    if (parseInt(jQuery('#w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
  };
function ajaxindicatorstart(text){
		
		if(jQuery("#resultLoading").size() == 0){
			jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="<?php echo plugin_dir_url( __FILE__ )?>/js/Loader.gif"><div>'+text+'</div></div><div class="bg"></div></div>');
		}
	
		jQuery('#resultLoading').css({
			'width':'100%',
			'height':'100%',
			'position':'fixed',
			'z-index':'10000000',
			'top':'0',
			'left':'0',
			'right':'0',
			'bottom':'0',
			'margin':'auto'
		});
	
		jQuery('#resultLoading .bg').css({
			'background':'#ffffff',
			'opacity':'0.7',
			'width':'100%',
			'height':'100%',
			'position':'absolute',
			'top':'0'
		});
	
		jQuery('#resultLoading>div:first').css({
			'width': '250px',
			'height':'75px',
			'text-align': 'center',
			'position': 'fixed',
			'top':'0',
			'left':'0',
			'right':'0',
			'bottom':'0',
			'margin':'auto',
			'font-size':'16px',
			'z-index':'10',
			'color':'#000000'
	
		});
	
		jQuery('#resultLoading .bg').height('100%');
		   jQuery('#resultLoading').fadeIn(300);
		jQuery('body').css('cursor', 'wait');
	}
 function ajaxindicatorstop(){
		jQuery('#resultLoading .bg').height('100%');
		   jQuery('#resultLoading').fadeOut(300);
		jQuery('body').css('cursor', 'default');
	}

</script>

<?php }

function update_edit_form() {

    echo ' enctype="multipart/form-data"';

} // end update_edit_form

add_action('post_edit_form_tag', 'update_edit_form');





// end wp_custom_attachment

$horse_MANAGER = new horse_MANAGER();


add_filter('manage_horse_posts_columns', 'thumbnail_column');

function thumbnail_column($columns) {

    global $typenow;
    $post_type = 'horse';
    if ($typenow == $post_type) {
        return array(
            'cb' => '<input type="checkbox" />',
            'featured_image' => __(''),
            'title' => __('HORSE'),
            'taxonomy-horse-category' => __('CATEGORY'),
            'author' => __('AUTHOR'),
            'date' => __('STATUS'),
        );
    }
}

//Add rows data
add_action( 'manage_horse_posts_custom_column' , 'my_custom_column', 10, 2 );
function my_custom_column($column, $post_id ){
    switch ( $column ) {
        case 'taxonomy-horse-category':
        echo get_post_meta( $post_id , 'wpcf-Category' , true );
        break;
    }
}


add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');
function tsm_filter_post_type_by_taxonomy() {
    global $typenow;
    $post_type = 'horse'; // change to your post type
    $taxonomy  = 'horse-category'; // change to your taxonomy
    if ($typenow == $post_type) {
        $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' => __("{$info_taxonomy->label}"),
            'taxonomy'        => $taxonomy,
            'name'            => $taxonomy,
            'orderby'         => 'name',
            'selected'        => $selected,
            'show_count'      => true,
            'hide_empty'      => true,
        ));
    };
}

/**
 * Filter posts by taxonomy in admin
 * @author  Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_filter('parse_query', 'tsm_convert_id_to_term_in_query');
function tsm_convert_id_to_term_in_query($query) {
    global $pagenow;
    $post_type = 'team'; // change to your post type
    $taxonomy  = 'group'; // change to your taxonomy
    $q_vars    = &$query->query_vars;
    if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
        $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
        $q_vars[$taxonomy] = $term->slug;
    }
}
?>