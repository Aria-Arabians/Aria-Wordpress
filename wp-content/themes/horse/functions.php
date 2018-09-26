<?php
/**
 * Horse functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'horse_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own horse_setup() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */

function wpsites_query( $query ) {
if ( $query->is_archive() && $query->is_main_query() && !is_admin() ) {
        $query->set( 'posts_per_page', 200 );
    }
}
add_action( 'pre_get_posts', 'wpsites_query' );

function horse_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/horse
	 * If you're building a theme based on Twenty Sixteen, use a find and replace
	 * to change 'horse' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'horse' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Twenty Sixteen 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 158,
		'width'       => 158,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );
    //add_image_size( 'horselist-thumb', 370, 370, true );
	//add_image_size( 'horsesingle-thumb', 450, 350, true );
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'horse' ),
		'social'  => __( 'Social Links Menu', 'horse' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', horse_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // horse_setup
add_action( 'after_setup_theme', 'horse_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function horse_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'horse_content_width', 840 );
}
add_action( 'after_setup_theme', 'horse_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function horse_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'horse' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'horse' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'horse' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'horse' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'horse' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'horse' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'horse_widgets_init' );

if ( ! function_exists( 'horse_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Sixteen.
 *
 * Create your own horse_fonts_url() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function horse_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'horse' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'horse' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'horse' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function horse_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'horse_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function horse_scripts() {
	// Add custom fonts, used in the main stylesheet.
	//wp_enqueue_style( 'horse-fonts', horse_fonts_url(), array(), null );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'grid', get_template_directory_uri() . '/css/grid.css' );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.0.1/css/all.css' );
	
	// Theme stylesheet.
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	

	// Load the html5 shiv.
	wp_enqueue_script( 'horse-plugin-js', get_template_directory_uri() . '/js/plugins.js', array(), '3.7.3',true );
	
	// Load the html5 shiv.
	wp_enqueue_script( 'horse-site', get_template_directory_uri() . '/js/site.js', array(), '3.7.3',true );
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);

	wp_enqueue_script( 'owlcarousel', get_template_directory_uri() . '/inc/owl/owl.carousel.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'owlcarousel-init', get_template_directory_uri() . '/inc/owl/owl.carousel-init.js', array( 'jquery' ), false, true );
	wp_enqueue_style( 'owlcarousel-style', get_template_directory_uri() . '/inc/owl/assets/owl.carousel.css' );
	wp_enqueue_style( 'owlcarousel-theme', get_template_directory_uri() . '/inc/owl/assets/owl.theme.css' );

	wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i', false ); 
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		//wp_enqueue_script( 'comment-reply' );
	}

	/*if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'horse-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}


	wp_enqueue_script( 'horse-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'horse-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'horse' ),
		'collapse' => __( 'collapse child menu', 'horse' ),
	) );*/
}
add_action( 'wp_enqueue_scripts', 'horse_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function horse_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'horse_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function horse_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function horse_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
//add_filter( 'wp_calculate_image_sizes', 'horse_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function horse_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
//add_filter( 'wp_get_attachment_image_attributes', 'horse_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */

// Control news excertp length
add_filter('wp_trim_excerpt', function($text){    
   $max_length = 130;

    global $post;

    if ($post->post_type == 'news') {
		if(mb_strlen($text, 'UTF-8') > $max_length){
			$split_pos = mb_strpos(wordwrap($text, $max_length), "\n", 0, 'UTF-8');
			$text = mb_substr($text, 0, $split_pos, 'UTF-8')."...";
		}
	}

   return $text;
});

function horse_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}

function site_uri_callback() {
	return get_site_url();
}
add_shortcode( 'site_uri', 'site_uri_callback' );


function home_collection_horses() {
	$args = array(
    'post_type' => 'horse',
    'order'     => 'DSC',
	'tax_query' => array(
					    array(
					        'taxonomy' => 'horse-category',
					        'field' => 'slug',
					        'terms' => 'our-arabians'
					    )
					)
    );   

    $html = '';           

	$the_query = new WP_Query( $args );
	$counter = 0;
	if($the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$counter++;

			$the_query->the_post();

			$thumbnail = get_the_post_thumbnail_url();
			$title = get_the_title();

			$html.= '<a href="'.get_post_permalink().'"><div class="">
						<div class="featured-horse" style="background-image: url('.$thumbnail.')">
							<div class="home-featured-title">
								<div class="wrapper">
								</div>
							</div>
							<span class="featured-horse">'.$title.'</span>
						</div>
					</div></a>';
		}
	}
	return $html;
}
add_shortcode( 'collection_horses', 'home_collection_horses' );

function begin_collection_wrapper($curr) {
	$place_points = [1,4,7,10,13,16,19,22,25,28];

	foreach($place_points as $cell) {
		if ($cell == $curr) {
			return true;
		}
	}

	return false;
}

function end_collection_wrapper($curr) {
	$place_points = [3,6,9,12,15,18,21,24,27];

	foreach($place_points as $cell) {
		if ($cell == $curr) {
			return true;
		}
	}

	return false;
}


// Shorten excerpts
function tn_custom_excerpt_length( $length ) {
	return 18;
}
add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );


// Remove Continue Reading Link
function custom_excerpt_more($more) {
   global $post;
   $more_text = '...';
   return '…';
}
add_filter('excerpt_more', 'custom_excerpt_more');

function home_featured_news($atts) {
	$args = array(
    'post_type'      => 'post',
    'order'          => 'DSC',
    'posts_per_page' => '100',
    );   

    $html = '';           

	$the_query = new WP_Query( $args );

	$counter = 0;

	if($the_query->have_posts() ) {

		$post_limit = shortcode_atts( array(
						'posts' => '100'
					), $atts);
		$post_limit = $post_limit['posts'];

		while ( $the_query->have_posts() && $counter < $post_limit ) {
			$counter++;
			$the_query->the_post();

			$thumbnail = get_the_post_thumbnail_url();
			$title = get_the_title();

			$html.= '<div class="small-12 medium-12 columns">
						<div class="card">
							<div class="home-featured-title">
								<div class="wrapper">
									<div class="home-news-thumb" style="background-image: url('.$thumbnail.')"></div>
									<div class="home-news-text">
										<a href="'.get_permalink().'"><h3>'.$title.'</h3></a>
										<p>'.get_the_excerpt().'</p>
										<a href="'.get_permalink().'">VIEW STORY ›</a>
									</div>
								</div>
							</div>
						</div>
					</div>';
		}
	}
	return $html;
}
add_shortcode( 'featured_news', 'home_featured_news' );

function modify_read_more_link() {
return 'VIEW STORY &#8250;';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );

function list_our_services($atts) {
	$args = array(
    'post_type'=> 'services',
    'order'    => 'ASC'
    );   

    $html = '';           

	$the_query = new WP_Query( $args );

	$counter = 0;

	if($the_query->have_posts() ) {

		$post_limit = shortcode_atts( array(
						'posts' => '100'
					), $atts);
		$post_limit = $post_limit['posts'];

		while ( $the_query->have_posts() && $counter < $post_limit ) {
			$counter++;
			$the_query->the_post();

			$thumbnail = get_the_post_thumbnail_url();
			$title = get_the_title();

			$final = '';

			if ($counter == $the_query->post_count) {
				$final = "final";
			}

			$html.= '
				<div class="row service-row">
					<div class="small-12 medium-8 medium-push-2 columns '.$final.'">
						<div class="service">
							<h3>'.$title.'</h3>
							<p>'.get_the_content().'</p>
						</div>
					</div>
				</div>';
		}
	}
	return $html;
}
add_shortcode( 'our_services', 'list_our_services' );


// LIST HORSE PAGE FUNCTIONALITY
function list_horses_by_category($atts) {

	$horse_category = shortcode_atts( array(
						'category' => 'our-arabians'
					), $atts);
		$horse_category = $horse_category['category'];

	$horse_category = explode('/', $horse_category);

	$args = array(
    'post_type'      => 'horse',
    'order'          => 'DSC',
    'posts_per_page' => '100',
    'tax_query'      => array(
					        array(
					            'taxonomy' => 'horse-category',
					            'field' => 'slug',
					            'terms' => $horse_category
					        )
					    )
    );   

    $html = '';           

	$the_query = new WP_Query( $args );

	//echo "<pre>";
	//print_r($the_query->get_posts());
	//echo "</pre>";
	$counter = 0;

	if($the_query->have_posts() ) {

		while ( $the_query->have_posts() ) {

			$counter++;
			$the_query->the_post();

			$thumbnail = get_the_post_thumbnail_url();
			$title = get_the_title();

			$father = get_post_meta( get_the_ID(), "s", true );
			$mother = get_post_meta( get_the_ID(), "d", true );

			$color_id = unserialize(get_post_meta( get_the_ID() )['_data_horse_color'][0])[0];
            $breed_id = unserialize(get_post_meta( get_the_ID() )['_data_horse_breed'][0])[0];
            $gender_id = unserialize(get_post_meta( get_the_ID() )['_data_horse_gender'][0])[0];
			$color_name = get_term($color_id, 'horse-color')->name;
            $breed_name = get_term($breed_id, 'horse-breed')->name;
            $gender_name = get_term($gender_id, 'horse-gender')->name;
			

			$html.= '<div class="small-12 medium-6 large-4 columns end">
						<a href="'.get_post_permalink().'">
							<div class="horse-list-card">
								<div class="home-featured-title">
									<div class="horse-list-thumb" style="background-image: url('.$thumbnail.')"><div class="list-thumb-border"></div></div>
									<div class="wrapper-container">
										<div class="wrapper">
											<h3>'.$title.'</h3>
											<p>('.$father.' X '.$mother.')</p>
											<p>'.get_post_meta( get_the_ID() )["_data_horse_year_foaled"][0].' '.$color_name.' '.$breed_name.' '.$gender_name.'</p>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>';
		}
	} else {

		if (counter == 0) {
			$category_tag = $horse_category[0];
			$category_name = substr($horse_category[0], strpos($horse_category[0], "-") + 1);

			if ($category_tag[0] == 'e') {
				$category_name = str_replace("-", " ", $category_tag);
			}


			$html.= '<div class="none">No <strong>'.$category_name.'</strong> here yet. Check back soon!</div>';
		}
	}

	return $html;
}
add_shortcode( 'list_horses', 'list_horses_by_category' );


function list_social_icons() {
	echo '<div class="row full-row share-row"><ul class="share-buttons">
  <li><a href="https://www.facebook.com/sharer/sharer.php?u='.urlencode(get_site_url()).'&t=" title="Share on Facebook" target="_blank" onclick="window.open(\'https://www.facebook.com/sharer/sharer.php?u=\' + encodeURIComponent(document.URL) + \'&t=\' + encodeURIComponent(document.URL)); return false;"><img alt="Share on Facebook" src="../../wp-content/themes/horse/images/social_flat_rounded_rects_svg/Facebook.svg" /></a></li>
  <li><a href=\"https://twitter.com/intent/tweet?source='.urlencode(get_site_url()).'&text=:'.urlencode(get_site_url()).'\" target=\"_blank\" title="Share on Twitter"" onclick="window.open(\'https://twitter.com/intent/tweet?text=\' + encodeURIComponent(document.title) + \':%20\'  + encodeURIComponent(document.URL)); return false;"><img alt="Share on Twitter" src="../../wp-content/themes/horse/images/social_flat_rounded_rects_svg/Twitter.svg" /></a></li>
  <li><a href="https://plus.google.com/share?url='.urlencode(get_site_url()).'" target="_blank" title="Share on Google+" onclick="window.open(\'https://plus.google.com/share?url=\' + encodeURIComponent(document.URL)); return false;"><img alt="Share on Google+" src="../../wp-content/themes/horse/images/social_flat_rounded_rects_svg/Google+.svg" /></a></li>
</ul><p class="share-buttons">share this page</p></div>';
}
add_shortcode( 'social_icons', 'list_social_icons' );