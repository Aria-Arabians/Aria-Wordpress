<?php

/**

 * Include and setup custom metaboxes and fields.

 *

 * @category HorseManager

 * @package  Metaboxes

 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)

 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress

 */
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );


/**

 * Define the metabox and field configurations.

 *

 * @param  array $meta_boxes

 * @return array

 */

function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list

	$prefix = '_data_';
	$meta_boxes[] =

		array(

			'id'         => 'horse_details',

			'title'      => 'Horse Details',

			'pages'      => array( 'horse' ), // Post type

			'context'    => 'normal',

			'priority'   => 'high',

			'show_names' => true, // Show field names on the left

			'fields'     => array(

				/*	array(

					'name' => __('Horse Details','wp_horse'),

					'desc' => __('Fill the horse information here, you can add and change all info anytime.','wp_horse'),

					'id'   => $prefix . 'horse_title_2',

					'type' => 'title',

				),*/

				array(

					'name' => __('Gender','wp_horse'),

					'id' => $prefix . 'horse_gender',

					'taxonomy' => 'horse-gender',

					'type' => 'taxonomy_select',

				),

				

				array(

					'name' => __('Breeding','wp_horse'),

					'id'   => $prefix . 'horse_breed',

					'taxonomy' => 'horse-breed',

					'type' => 'taxonomy_select',

				),

				array(

				'name' => __('Bloodline','wp_horse'),

				'id' => $prefix . 'horse_bloodline',

				'taxonomy' => 'horse-bloodline',

				'type' => 'taxonomy_select',

				),


			array(

				'name' => __('Colors','wp_horse'),

				'id' => $prefix . 'horse_color',

				'taxonomy' => 'horse-color',

				'type' => 'taxonomy_select',

			),

			array(

				'name' => __('Year Foaled','wp_horse'),

				'desc' => '',

				'id'   => $prefix . 'horse_year_foaled',

				'type' => 'text_medium',

			),

			 array(

				'name' => __('Breeding Fee','wp_horse'),

				'desc' => '',

				'id'   => $prefix . 'horse_breeding_fee',

				'type' => 'text_medium',

			),

			/*array(

       	'name' => __('Age','wp_horse'),

       	'id' => $prefix . 'horse_age',

       	'taxonomy' => 'horse-age',

       	'type' => 'taxonomy_select',

			),array(

				'name'    => __('Status','wp_horse'),

				'desc'    => 'field description (optional)',

				'id'      => $prefix . 'horse_status',

				'type'    => 'taxonomy_select',

				'taxonomy'    => 'horse-status'

			),array(

      	'name' => __('Coat','wp_horse'),

      	'id' => $prefix . 'horse_coat',

      	'taxonomy' => 'horse-coat',

      	'type' => 'taxonomy_multicheck',

      ),array(

      	'name' => __('Pattern','wp_horse'),

      	'id' => $prefix . 'horse_pattern',

      	'taxonomy' => 'horse-pattern',

      	'type' => 'taxonomy_select',

      ),array(

				'name'    => __('Vaccines','wp_horse'),

				'id'      => $prefix . 'horse_vaccines',

				'type'    => 'radio_inline',

				'options' => array(

					array( 'name' => __('Vacinated','wp_horse'), 'value' => __('Vacinated','wp_horse'), ),

					array( 'name' => __('Dose Interval','wp_horse'), 'value' => __('Dose Interval','wp_horse'), ),

					array( 'name' => __('Unknown','wp_horse'), 'value' => __('Unknown','wp_horse'), ),

				),

			),

			array(

				'name'    => __('Desexed','wp_horse'),

				'id'      => $prefix . 'horse_desex',

				'type'    => 'select',

				'options' => array(

					array( 'name' => '', 'value' => '', ),

					array( 'name' => __('Desexed','wp_horse'), 'value' => __('Desexed','wp_horse'), ),

					array( 'name' => __('No desexed','wp_horse'), 'value' => __('No desexed','wp_horse'), ),

				),

			),
			array(

				'name'    => __('Special needs','wp_horse'),

				'id'      => $prefix . 'horse_needs',

				'type'    => 'select',

				'options' => array(

          array( 'name' => '', 'value' => '', ),

					array( 'name' => __('Special needs','wp_horse'), 'value' => __('Special needs','wp_horse'), ),

					array( 'name' => __('No special needs','wp_horse'), 'value' => __('No special needs','wp_horse'), ),

				),

			),

			array(

				'name'    => __('Contact','wp_horse'),

				'desc'    => __('Set to display or not the contact form on this horse page so users can contact you by email.','wp_horse'),

				'id'      => $prefix . 'horse_email_option',

				'type'    => 'radio',

				'options' => array(

					array( 'name' => __('Yes','wp_horse'), 'value' => 'yes', ),

					array( 'name' => __('No','wp_horse'), 'value' => 'no', ),

				),

			),

			array(

				'name' => __('Lost & Found Information','wp_horse'),

				'desc' => __('Add an address here to display a map if your lost or found a wondering horse.','wp_horse'),

				'id'   => $prefix . 'horse_title_3',

				'type' => 'title',

			),

			array(

				'name' => __('Address','wp_horse'),

				'desc' => __('Address or place reference','wp_horse'),

				'id'   => $prefix . 'horse_address',

				'type' => 'text_medium',

			),

			array(

				'name' => __('Date','wp_horse'),

				'desc' => '',

				'id'   => $prefix . 'horse_date',

				'type' => 'text_date_timestamp',

			),

			array(

	            'name' => __('Time','wp_horse'),

	            'desc' => '',

	            'id'   => $prefix . 'horse_time',

	            'type' => 'text_time',

	        ),

			array(

				'name' => __('Contact','wp_horse'),

				'desc' => __('Inform a e-mail address so people can contact you.','wp_horse'),

				'id'   => $prefix . 'horse_title_3',

				'type' => 'title',

			),*/
/*		array(

				'name' => __('Contact e-mail','wp_horse'),

				'desc' => '',

				'id'   => $prefix . 'horse_another_email',

				'type' => 'text_medium',

			),*/

		),

	);
	/*$meta_boxes[] = array(
		'id' => 'horse_photo',

        'title' => 'Photo',

        'callback' => 'horse_photo_attachment',

        'pages' => array( 'horse' ),


        'priority' => 'normal'
	);*/
   $meta_boxes[] = array(

		'id'         => 'horse_video',

		'title'      => 'Horse videos',

		'pages'      => array( 'horse' ), // Post type

		'context'    => 'normal',

		'priority'   => 'high',

		'show_names' => true, // Show field names on the left

		'fields'     => array(

		  array(

				'name' => __('Add video','wp_horse'),

				//'desc' => 'Paste your iframe embed code.',

				'id'   => $prefix . 'horse_video',

				'type' => 'iframe',

			),

		),

	); 

	/*$meta_boxes[] = array(

		'id'         => 'horse_progeny',

		'title'      => 'Progeny',

		'pages'      => array( 'horse' ), // Post type

		'context'    => 'normal',

		'priority'   => 'default',

		'show_names' => true, // Show field names on the left

		'fields'     => array(

		  array(

				'name' => __('Aria Aphrodite','wp_horse'),

				'desc' => '',

				'id'   => $prefix . 'horse_aria_aphrodite',

				'type' => 'checkbox',

			),

			array(

				'name' => __('Aria Triumph','wp_horse'),

				'desc' => '',

				'id'   => $prefix . 'horse_aria_triumph',

				'type' => 'checkbox',

			),

			array(

				'name' => __('Coming Soon','wp_horse'),

				'desc' => '',

				'id'   => $prefix . 'horse_comming_soon',

				'type' => 'checkbox',

			),

			array(

				'name' => __('NBW Angels Kiss','wp_horse'),

				'desc' => '',

				'id'   => $prefix . 'horse_angels_kiss',

				'type' => 'checkbox',

			),

		),

	);*/

	/*$meta_boxes[] = array(

		'id'         => 'horse_photo',

		'title'      => 'Horse Photos',

		'pages'      => array( 'horse' ), // Post type

		'context'    => 'normal',

		'priority'   => 'high',

		'show_names' => true, // Show field names on the left

		'fields'     => array(

		  array(

				'name' => __('Photo','wp_horse'),

				'desc' => '',

				'id'   => $prefix . 'horse_photo',

				'type' => 'file',

			),

		),

	);*/
	// Add other metaboxes as needed
	return $meta_boxes;

}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );

/**

 * Initialize the metabox class.

 */

function cmb_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) )

		require_once 'init.php';
}

add_action('add_meta_boxes', 'add_horse_img_meta_boxes');
function add_horse_img_meta_boxes() {
    // Define the custom attachment for posts
	
	// Start by adding our menu box
	add_meta_box(

        'horse_menu',

        'Menu',

        'horse_menu_ui',

        'horse',

        'normal'

    );


    add_meta_box(

        'horse_photo',

        'Photo',

        'horse_photo_attachment',

        'horse',

        'normal'

    );

	add_meta_box(

        'horse_pedigree',

        'Pedigree',

        'horse_pedigree_callback',

        'horse',

        'normal'

    );

	add_meta_box(

        'horse_progeny',

        'Select Featured Progeny',

        'horse_progeny_callback',

        'horse',

        'normal'

    );

	// Define the custom attachment for posts

    /*add_meta_box(

        'horse_pdf',

        'Pdf Attachment',

        'horse_pdf_callback',

        'horse',

        'side'

    );*/

} // end add_custom_meta_boxes
//callbacks of metaboxes

if( !wp_script_is('jquery-ui') ) { 
   wp_enqueue_script( 'jquery-ui' , 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js' );
}

// Implement the menu layer
function horse_menu_ui() { 

	global $post;

	?>

	<script type="text/javascript">
	jQuery(document).ready( function() {
		// Store tabs in an array for future toggling reference
		var tabs = ["#postdivrich",
					"#acf_502",
					"#horse_details",
					"#edit-slug-box",
					"#horse_profile",
					"#horse_photo",
					"#horse_video",
					"#horse_pedigree",
					"#horse_progeny",
					"#horse-categorydiv",
					"#postimagediv"];

		// Our Tabbing function: hide anything that isn't the selected tab.
		function tabToggler(tab) {

			//console.log(tab);

			jQuery('input[name="current-tab"]').val(tab);

			var tabId = "#" + tab,
				tabClass = "." + tab;

			jQuery('#horse_menu_list li').each(function (e, i) {
				if ( i.className !== tab ) {
					jQuery(i).removeClass('current-tab');
				}
			});
			jQuery(tabClass).addClass('current-tab');

			// Show the selected metabox, hide everything else
			jQuery(tabId).show();

			tabs.forEach(function(c) {
				if (c !== tabId) {
					jQuery(c).hide();
				}
			});

			if (tab == 'postdivrich') {
				jQuery('#horse_details').show();
				jQuery('#postimagediv').show();
				jQuery('#edit-slug-box').show();
				jQuery('.horse_details').addClass('current-tab');
				jQuery('#acf_502').show();
			}
		}

		//Display the menu
		var menu = "<ul id='horse_menu_list'>\
						<li class='postdivrich'>Details</li>\
						<li class='horse_photo'>Photos</li>\
						<li class='horse_video'>Video</li>\
						<li class='horse_pedigree'>Pedigree</li>\
						<li class='horse_progeny'>Progeny</li>\
						<li class='horse-categorydiv'>Category</li>\
					</ul>\
					<input type='hidden' name='current-tab' value=''/>";

		jQuery("#horse_menu>.inside").append(menu);

		jQuery('#post-body').attr('class', 'metabox-holder columns-1');

		//Default view: Owner information only

		<?php $currentTab = 'postdivrich'; /*if (get_post_meta($post->ID)['current-tab']) { $currentTab = get_post_meta($post->ID)['current-tab']; }*/?>
		tabToggler('<?php echo $currentTab; ?>');

		// Add an event listener to all the tabs
		jQuery('#horse_menu_list>li').click(function( e ) {

			// On click pass class to tabToggler and run the whole thing
			var clickedClass = this.className;

			if ( !jQuery(e.currentTarget).hasClass('current-tab') ) {
				tabToggler(clickedClass);
			}
		})

		// Alert for displaying the name of uploaded attachments
		jQuery('input[type="file"]').change(function(e){

			// List of file names
            var files = e.target.files;

            // If this is the first upload, write the upload container 
            // and the "Selected files" lable
			if (!jQuery('#upload-filename-container')[0]) {
				jQuery('#upload-outline').append('<div id="upload-filename-container"><span class="selected">Selected files:</span></div>');
			}

            jQuery('.selected').after(function() {
            	for (var i = 0; i < files.length; i++) {

	            	var fileName = files[i].name;

		            jQuery('#upload-filename-container').append('<div id="upload-filename">'+fileName+'</div>');

		            jQuery('#horse_photo input[type="submit"]').removeClass('inactive-upload');

		            //console.log(jQuery('input[type="file"]'));
	        	}
	    	});
        });

		// Set/replace default field values
		function defaultDetails() {

			//Menu Stuff
			//jQuery('#menu-media').before('<li><a href="" id="settings-divider" class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media menu-top-first" aria-haspopup="true"><div class="wp-menu-name">Advanced Settings</div></a></li>');

			jQuery('#postbox-container-2 td').has('select').addClass('selectbox');

			// Details Tab
			jQuery('#_data_horse_gender option[value=""]').html('Select Maturity & Gender');
			jQuery('#_data_horse_breed option[value=""]').html('Select Breed');
			jQuery('#_data_horse_bloodline option[value=""]').html('Select Bloodline');
			jQuery('#_data_horse_color option[value=""]').html('Select Color');
			jQuery('#_data_horse_year_foaled').attr('placeholder', 'Enter year foaled');
	        jQuery('#_data_horse_breeding_fee').attr('placeholder', 'Enter breeding fee');

	        // Video Tab
	        jQuery('#_data_horse_video').attr('placeholder', 'Paste iframe embed code here.');

	        // Photo tab
	        jQuery('#horse_photo input[type="submit"]').addClass('inactive-upload');

	        jQuery('#upload-button-hidden').hover(function(e) {
			    jQuery('#upload-button').toggleClass('hover');
			})

			// Category tab

			// Write a hidden input for storing the deleted categories
			/*jQuery('#taxonomy-horse-category').before('<input type="hidden" name="deleted-categories" value=""/>');

			// Overlay interaction divs

			jQuery('.selectit').prepend('<ul class="cat-overlay"><li><span class="dashicons dashicons-trash"></span></li></ul>');*/

			// Simple renaming
			jQuery('#horse-categorydiv>h2').html('Select Featured Categories');
			jQuery('#horse-category-add-toggle').html('<!--<span class="dashicons dashicons-plus-alt" style="font-size:14px; position:relative; top:2px"></span>--> + ADD CATEGORY');
	    }

	    //window.requestAnimationFrame(defaultDetails);

	    defaultDetails();

	    // For storing categories to delete on POST
	    var deletedCategories = [];

	    // Handle hover animation for these category elements
	    jQuery('#horse-categorychecklist .children li').on("mouseover", overCat)
					           .on("mouseout", offCat);

	    function overCat() {
	    	//console.log(jQuery(this).find('.cat-overlay'));
	    	jQuery(this).find('.cat-overlay').css('opacity', '1');
	    }

	    function offCat() {
	    	jQuery(this).find('.cat-overlay').css('opacity', '0');
	    }

	    // Handle deletion for categories
	    jQuery('.cat-overlay span.dashicons-trash').click( function(e) {
	    	//console.log(e.currentTarget);

	    	var trashParent = jQuery(e.currentTarget).closest('label');
					catName = trashParent[0].innerText;

				jQuery(trashParent).parent().remove();

				deletedCategories.push(catName);

				jQuery('input[name="deleted-categories"]').val(deletedCategories)
	    });

        // Attachment thumbnail dragging/sorting functionality
        var placeholderElement = jQuery('<div></div>');

        // Make the list of attachments sortable,
        jQuery( ".attach_list" ).sortable({
			appendTo: document.getElementsByClassName('attach_list'),
			cursor: "-webkit-grabbing",

			placeholder: "ui-state-highlight",

		    // Add it before the element you're dragging.
		    // This assumes that you can only ever drag one element at a time.
		    activate: function(event, ui) {
		      placeholderElement.insertBefore(ui.item[0]);

		      // Explicitly set the height and width to preserve
		      // flex calculations
		      placeholderElement.width(ui.item[0].offsetWidth);
		      placeholderElement.height(ui.item[0].offsetHeight);
		    },

		    // Remove it when you're done dragging.
		    deactivate: function() {
		      placeholderElement.remove();
		    },

		    update: function (event, ui) {
		    	crawlList();
		    }
		});

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

    	var deletionsList = [];
    	
    	function listDeletions(id) {
    		deletionsList.push(id);

    		jQuery('#attach-list-deletions').val(deletionsList);
    		//console.log(deletionsList);
    	}

    	jQuery('input[value="Upload"]').click(function() {
    		jQuery('#upload-filename-container').remove();
    		jQuery('input[value="Upload"]').addClass('inactive-upload');
    	});

    	function overAttach() {
	    	jQuery(this).children('img').toggleClass('attach-hover');
	    	jQuery(this).children('div').toggleClass('attach-hover');
	    }

	    function offAttach() {
	    	jQuery(this).children('img').toggleClass('attach-hover');
	    	jQuery(this).children('div').toggleClass('attach-hover');
	    }

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
    });
	</script>

<?php }


function horse_photo_attachment() {

    global $post;?>			
							<div id="save-reminder">
								<p>Click "Update" below or changes will be lost.</p>
								<p>Refresh the page to undo.</p>
							</div>

							<ul class="attach_list">
							<input id="attach-list-order" name="attach-list-order" type="hidden" value="">
							<input id="attach-list-deletions" name="attach-list-deletions" type="hidden" value="">
	<?php
    wp_nonce_field(plugin_basename(__FILE__), 'horse_photo_attachment_nonce');
	                $args = array(
								'post_type' => 'attachment',
								'numberposts' => null,
								'post_status' => null,
								'post_parent' => $post->ID
							);
							$attachments = get_posts($args);

							//echo '<pre>';
							//print_r (get_post_meta($post->ID)['attach-list']);
							//echo '</pre>';

							$queryLength = count($attachments);
							$metaLength = count(get_post_meta($post->ID)['attach-list']);
							
							if ( empty(get_post_meta($post->ID)['attach-list']) == true ) {
								
								delete_post_meta($post->ID, 'attach-list');

								foreach ($attachments as $attachment) {

									add_post_meta($post->ID, 'attach-list', $attachment->ID);

								}

							}

							$attachments = get_post_meta($post->ID)['attach-list'];

						
							if ($attachments) { ?>

								
								<?php foreach ($attachments as $attachment) { ?>
									
									<li id="img_li_<?php echo $attachment;?>">

									<div class="img-overlay">
									<img src="<?php echo wp_get_attachment_url($attachment);?>" id="horse_img_<?php echo $attachment;?>"/>
									<div id="img_edit_<?php echo $attachment;?>" class="attach-buttons">
										<a class="move-img"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="24 23 49 49" style="fill:#fff" xml:space="preserve">
										<g>
											<path d="M73,48.4l-10.4-9.6v4.8H52.4V33.4h4.8L47.6,23l-8.9,10.4h4.8v10.2H33.4v-4.8L23,48.4l10.4,8.9v-4.8h10.2v10.2h-4.8L47.6,73
												l9.6-10.4h-4.8V52.4h10.2v4.8L73,48.4z"/>
										</g>
										</svg></a>


										<a href="#TB_inline?width=600&height=550&inlineId=cropper-popup" onclick="set_img_src('<?php echo $attachment;?>')" class="thickbox crop-img"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 512 512" fill="#fff" xml:space="preserve">
										<polygon points="350.552,354 186.337,354 350,189.458 350,327 421,327 421,162.054 421,118.861 495.424,44.512 466.937,15.758 
											391.503,91 350.552,91 184,91 184,162 320.906,162 157,325.148 157,162.054 157,91.458 157,20 87,20 87,91 16,91 16,162 87,162 
											87,353.674 87,424 157.812,424 350,424 350,496 421,496 421,424 491,424 491,354 421.148,354 "/>
										</svg></a>

										<a onclick="delete_img('<?php echo $attachment;?>');" href="javascript:void(0)" class="delete-img"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 26 26" class="icon icons8-Trash" ><g id="surface1"><path style="fill:#fff" d="M 11 -0.03125 C 10.164063 -0.03125 9.34375 0.132813 8.75 0.71875 C 8.15625 1.304688 7.96875 2.136719 7.96875 3 L 4 3 C 3.449219 3 3 3.449219 3 4 L 2 4 L 2 6 L 24 6 L 24 4 L 23 4 C 23 3.449219 22.550781 3 22 3 L 18.03125 3 C 18.03125 2.136719 17.84375 1.304688 17.25 0.71875 C 16.65625 0.132813 15.835938 -0.03125 15 -0.03125 Z M 11 2.03125 L 15 2.03125 C 15.546875 2.03125 15.71875 2.160156 15.78125 2.21875 C 15.84375 2.277344 15.96875 2.441406 15.96875 3 L 10.03125 3 C 10.03125 2.441406 10.15625 2.277344 10.21875 2.21875 C 10.28125 2.160156 10.453125 2.03125 11 2.03125 Z M 4 7 L 4 23 C 4 24.652344 5.347656 26 7 26 L 19 26 C 20.652344 26 22 24.652344 22 23 L 22 7 Z M 8 10 L 10 10 L 10 22 L 8 22 Z M 12 10 L 14 10 L 14 22 L 12 22 Z M 16 10 L 18 10 L 18 22 L 16 22 Z "></path></g></svg></a>
									</div>
									</div>


									
									<input type="hidden" id="attachment_hidden_<?php echo $attachment->ID;?>" value="" name="horse_att_img[]"/>
									<input type="hidden" id="thumbnail_id_<?php echo $attachment;?>" value="<?php echo $attachment;?>" name="thumbnail_id_<?php echo $attachment;?>"/>
									
									<input type="hidden" id="orginal_img_<?php echo $attachment;?>" value="<?php echo wp_get_attachment_url($attachment);?>" name="orginal_img_<?php echo $attachment;?>"/>			
									
									</li>
									
								<?php } ?>

								<script>

									//Count the attachments. We'll refer back to this when handling attachment deletion animations.
								    var attachment_count = jQuery('.attach_list li').length;



								    // Handle hover animation for these attachments
								    jQuery('.img-overlay').on("mouseover", overAttach)
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
								    jQuery('.attach-buttons a').on("mouseover", overEditButton )
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
							    </script>
								
							
   
<?php }  ?>

<!-- UPLOADER HTML
		todo: See about implementing main
-->

</ul>
<div class = "col-md-6 upload-form">
                                <div class= "upload-response"></div>
                                <div class = "form-group">
                                	<div id="upload-outline">
	                                    <label id="upload-text"><?php __('Select Files:', 'cvf-upload'); ?>Click to add images<br><div id="upload-button">BROWSE</div></label>
	                                    <input id="upload-button-hidden" type = "file" name = "files[]" accept = "image/*" class = "files-data form-control" multiple />
                                    </div>
                                </div>
                                <div class = "form-group">
                                    <input type = "submit" value = "Upload" class = "btn btn-primary btn-upload" />
                                </div>
                            </div>
<div id="cropper-popup" style="display:none">
<div><img src="" id="cropbox-1"/></div>
       <form  method="post" onSubmit="return checkCoords();" id="crop-form">
       		<input type="hidden" id="this-post" name="this-post" value= <?php echo $post->ID; ?> />
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />
			<input type="hidden" id="attchment_id" name="attchment_id" val=""/>
			<input type="submit" value="Crop Image" class="btn btn-large btn-inverse" onClick="saveFormData('crop-form');"/>
		</form>
	</div>
	  
<?php 
} 

function horse_pedigree_callback() {
	global $post; 

	$S = get_post_meta($post->ID, 's', true);
		$SS = get_post_meta($post->ID, 'ss', true);
		$SD = get_post_meta($post->ID, 'sd', true);
			$SSS = get_post_meta($post->ID, 'sss', true);
			$SSD = get_post_meta($post->ID, 'ssd', true);
			$SDS = get_post_meta($post->ID, 'sds', true);
			$SDD = get_post_meta($post->ID, 'sdd', true);
				$SSSS = get_post_meta($post->ID, 'ssss', true);
				$SSSD = get_post_meta($post->ID, 'sssd', true);
				$SSDS = get_post_meta($post->ID, 'ssds', true);
				$SSDD = get_post_meta($post->ID, 'ssdd', true);
				$SDSS = get_post_meta($post->ID, 'sdss', true);
				$SDSD = get_post_meta($post->ID, 'sdsd', true);
				$SDDS = get_post_meta($post->ID, 'sdds', true);
				$SDDD = get_post_meta($post->ID, 'sddd', true);

	$D = get_post_meta($post->ID, 'd', true);
		$DS = get_post_meta($post->ID, 'ds', true);
		$DD = get_post_meta($post->ID, 'dd', true);
			$DSS = get_post_meta($post->ID, 'dss', true);
			$DSD = get_post_meta($post->ID, 'dsd', true);
			$DDS = get_post_meta($post->ID, 'dds', true);
			$DDD = get_post_meta($post->ID, 'ddd', true);
				$DSSS = get_post_meta($post->ID, 'dsss', true);
				$DSSD = get_post_meta($post->ID, 'dssd', true);
				$DSDS = get_post_meta($post->ID, 'dsds', true);
				$DSDD = get_post_meta($post->ID, 'dsdd', true);
				$DDSS = get_post_meta($post->ID, 'ddss', true);
				$DDSD = get_post_meta($post->ID, 'ddsd', true);
				$DDDS = get_post_meta($post->ID, 'ddds', true);
				$DDDD = get_post_meta($post->ID, 'dddd', true);
?>

<!-- PEDIGREE TABLE HTML -->

<table class="form-table cmb_metabox">
  <tr class="sire-row">
    <th id="sire-dam">Sire</th>
  </tr>
  <tr class="dam-row">
    <th id="sire-dam">Dam</th>
  </tr>
</table>

<script>
	var activeField;

	// Code to dynamically 
	function renderPedigree(gender, node_id_array) {

		// Import pedigree meta data
		var S    = "<?php echo $S; ?>",
			SS   = "<?php echo $SS; ?>",
			SD   = "<?php echo $SD; ?>",
			SSS  = "<?php echo $SSS; ?>",
			SSD  = "<?php echo $SSD; ?>",
			SDS  = "<?php echo $SDS; ?>",
			SDD  = "<?php echo $SDD; ?>",
			SSSS = "<?php echo $SSSS; ?>",
			SSSD = "<?php echo $SSSD; ?>",
			SSDS = "<?php echo $SSDS; ?>",
			SSDD = "<?php echo $SSDD; ?>",
			SDSS = "<?php echo $SDSS; ?>",
			SDSD = "<?php echo $SDSD; ?>",
			SDDS = "<?php echo $SDDS; ?>",
			SDDD = "<?php echo $SDDD; ?>",

			D    = "<?php echo $D; ?>",
			DS   = "<?php echo $DS; ?>",
			DD   = "<?php echo $DD; ?>",
			DSS  = "<?php echo $DSS; ?>",
			DSD  = "<?php echo $DSD; ?>",
			DDS  = "<?php echo $DDS; ?>",
			DDD  = "<?php echo $DDD; ?>",
			DSSS = "<?php echo $DSSS; ?>",
			DSSD = "<?php echo $DSSD; ?>",
			DSDS = "<?php echo $DSDS; ?>",
			DSDD = "<?php echo $DSDD; ?>",
			DDSS = "<?php echo $DDSS; ?>",
			DDSD = "<?php echo $DDSD; ?>",
			DDDS = "<?php echo $DDDS; ?>",
			DDDD = "<?php echo $DDDD; ?>";

		// Define the depth limit, starting point, and lineage identifier (s{ire} or d{am})
		var tree_depth = 4,
			curr_depth = 1,
		   column_rows = [0, 1, 2, 4, 8],
		// Define table element node titles (representing a binary tree) and current cell counter
		 	  nia_cell = 0,
			 	   nia = node_id_array; // Less verbose for easier typing


		//jQuery('#horse_pedigree').css('background', 'red');
		// Keep adding columns until we hit tree_depth
		while (curr_depth <= tree_depth) {
			//console.log("Begin column: "+curr_depth);

			// Add a table column
			jQuery('.'+gender+'-row').append('<td><table class="'+gender+'-column-'+curr_depth+'"></table></td>');

				// Add n rows to the column, where n = column_rows[curr_depth] (1, 2, 4, 8)		
				for (var i = 0; i < column_rows[curr_depth]; i++) {
					//console.log(nia[nia_cell]);

					jQuery('.'+gender+'-column-'+curr_depth).append('<tr><td><input type="text" id="'+nia[nia_cell]+'" name="'+nia[nia_cell]+'" placeholder="enter name" autocomplete="off" value="'+eval(nia[nia_cell])+'"><div id="'+nia[nia_cell]+'-suggest-box" class="suggesstion-box" style="display: none;"></td></tr');

					// Increment nia_cell
					nia_cell++;

				} // END FOR loop

			//console.log("End column: "+curr_depth);

			// Increment curr_depth and repeat for next column
			curr_depth++;

		} // END WHILE loop

	} // END FUNCTION renderPedigree()

	var sire_array = ['S', 'SS', 'SD', 'SSS', 'SSD', 'SDS', 'SDD', 'SSSS', 'SSSD', 'SSDS', 'SSDD', 'SDSS', 'SDSD', 'SDDS', 'SDDD'],
		 dam_array = ['D', 'DS', 'DD', 'DSS', 'DSD', 'DDS', 'DDD', 'DSSS', 'DSSD', 'DSDS', 'DSDD', 'DDSS', 'DDSD', 'DDDS', 'DDDD'];

	try {
		jQuery(document).ready(renderPedigree('sire', sire_array));
		jQuery(document).ready(renderPedigree('dam', dam_array));
	}
	catch(err) {
		console.log(err);
	}
</script>

<?php 	}
function horse_progeny_callback() {

         global $post;

         $query = [];

         $mothernames = array(
			'post_type'  => 'horse',
			'meta_query' => array(

				array(
					'key'     => 'd',
					'value'   => get_the_title(),
					'compare' => '=',
				),
			),
		);

         $fathernames = array(
			'post_type'  => 'horse',
			'meta_query' => array(

				array(
					'key'     => 's',
					'value'   => get_the_title(),
					'compare' => '=',
				),
			),
		);
		$motherquery = new WP_Query( $mothernames );
		$fatherquery = new WP_Query( $fathernames );

		 //$names= wp_get_object_terms( $post->ID, 'horse-gender' );

		 $selected_progeny_ids = get_post_meta( $post->ID, 'progeny_id');
	  ?>

<table class="form-table cmb_metabox">
<?php
	
	//echo "<pre>";
	//print_r($motherquery);
	//echo "</pre>";

	if ($motherquery || $fatherquery){

	    //$gender =  $names[0]->slug; 

	    $posts_array = get_post_meta( $post->ID, 'progeny_id');
	  
	  	echo '<ul id="progeny-list">';

	  	if ( empty($motherquery->posts) ) {
	  		$query = $fatherquery;
	  	} elseif ( empty($fatherquery->posts) ) {
	  		$query = $motherquery;
	  	}

	  	if ( empty($query->posts)) {
	  		echo '<li><label>'.get_the_title().' is not listed on any pedigree charts in your records.</label> </li>';
	  	}

	    foreach ($query->posts as $progeny) {

		    $checked ='';

	        if ($progeny->ID != $post->ID) {

			   if(in_array($progeny->ID,$selected_progeny_ids)){
			     $checked = "checked";			 

			   }
			   

				echo '<li>
				    <label for="">
				     	<input name="progeny" id="horse_progeny_'.$progeny->ID.'" type="checkbox" value="'.$progeny->ID.'" '.$checked.'>
				     	'.ucfirst(get_the_title($progeny->ID)).'
			     	</label>

			     	<a href="post.php?post='.$progeny->ID.'&action=edit" target="_blank">View this horse »</a>
			    	</li>';

	        }

        }
        echo '</ul>';

	}

 ?>

</table>

<?php 

}

function horse_pdf_callback() {

    global $post; 

    $img = get_post_meta($post->ID, 'horse_pdf', true);

	

    wp_nonce_field(plugin_basename(__FILE__), 'wp_pdf_attachment_nonce');

     

    $html = '<p class="description">';

        $html .= 'Upload your PDF here.';

    $html .= '</p>';

    $html .= '<input type="file" id="horse_pdf_attachment" name="horse_pdf_attachment" value="" size="25" />';

	if(!empty($img))

	{

	$html .='<p><a href="'.$img['url'].'">Download PDF Here</a></p>';

	}

     

    echo $html;

 

}