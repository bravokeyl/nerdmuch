<?php

// Theme Options

include( get_template_directory().'/inc/meta-fields.php' );
include( get_template_directory().'/inc/related.php' );
include( get_template_directory().'/inc/review.php' );
include( get_template_directory().'/inc/super-menu.php' );
include( get_template_directory().'/inc/sci1-customize.php' );
include( get_template_directory().'/inc/live-style.php' );
include( get_template_directory().'/inc/sci1-help.php' );
include( get_template_directory().'/inc/widget-presets.php' );
include( get_template_directory().'/inc/widget-presets-func.php' );
include( get_template_directory().'/inc/gallery.php' );
include( get_template_directory().'/inc/image-sizes.php' );
include( get_template_directory().'/inc/archive-styles.php' );
include( get_template_directory().'/inc/top-menu-posts.php' );
include( get_template_directory().'/inc/share-functions.php' );
include( get_template_directory().'/inc/ajax-search.php' );
include( get_template_directory().'/inc/latest-posts-button.php' );


//Theme Javascript Files

function sci1_scripts() {
		wp_enqueue_style( 'styles', get_stylesheet_uri(),array(),filemtime(get_stylesheet_directory().'/style.css') );
	if (is_home() || is_page_template('alternative homepage.php') || is_front_page()) {
		wp_enqueue_script('jquery-masonry');
	}
		wp_enqueue_script('hoverIntent');
		wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'));
		wp_enqueue_script('sci1', get_template_directory_uri() . '/js/sci1-scripts.js', array('jquery'));
		wp_enqueue_script('respond', get_template_directory_uri() . '/js/respond.min.js', array('jquery'));
		wp_enqueue_script('smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js', array('jquery'));

	//comment validation scripts
	if(is_singular() && comments_open() ) {
		wp_enqueue_script('jquery_validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'));
		wp_enqueue_script('comment_validate', get_template_directory_uri() . '/js/comment_validate.js', array('jquery'));
	}

}
add_action('wp_enqueue_scripts', 'sci1_scripts');
/*
//defer javascript

add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
function add_defer_attribute($tag) {
return str_replace( ' src', ' defer="defer" src', $tag );
}

//css optimize load
add_filter('style_loader_tag', 'my_style_loader_tag_function');
function my_style_loader_tag_function($tag){
return str_replace( ' rel', ' media="print" rel', $tag );
}
*/

// Title

add_theme_support( 'title-tag' );

function same_title_tag(){
	if (is_home() ||  is_front_page()) {
    	return get_bloginfo( 'name' ).' &ndash; '. get_bloginfo('description');
	}
}
add_filter('pre_get_document_title', 'same_title_tag');



// Add RSS links to <head> section

add_theme_support( 'automatic-feed-links' );

//Content Width

if ( ! isset( $content_width ) ){ $content_width = ((get_option('sci1_site_width') - 20) * 0.75) - 20 - 84; }

//Background enable

$args = array(
	'default-color' => 'ebebeb',
	'default-image' => get_template_directory_uri() . '/images/background.jpg',
);
add_theme_support( 'custom-background', $args );

//Header-image enable

$args = array(
	'width'         => 294,
	'height'        => 115,
	'default-image' => get_template_directory_uri() . '/images/logo.png',
	'header-text'   => false,
	'random-default' => false,

);
add_theme_support( 'custom-header', $args );

//Translation

function sci1_mag_lang_setup(){
    load_theme_textdomain('science-magazine', get_template_directory() . '/lang');
}
add_action('after_setup_theme', 'sci1_mag_lang_setup');

//Editor-style

function sci1_editor_styles() {
    add_editor_style( 'inc/sci1-editor-style.css' );
}
add_action( 'init', 'sci1_editor_styles' );

//Post Formats

add_theme_support( 'post-formats', array('video', 'aside', 'gallery', 'image'));

//Rename Post Format

function rename_post_formats( $rename_format ) {
    if ( $rename_format == 'Aside' )
        return 'Review';

    return $rename_format;
}
add_filter( 'esc_html', 'rename_post_formats' );

function live_rename_formats() {
    global $post;
    if ( $post == 'post-new.php' || $post == 'post.php' ) { ?>
<script type="text/javascript">
        jQuery('document').ready(function() {
            jQuery("span.post-state-format").each(function() {
                if ( jQuery(this).text() == "Aside" )
                    jQuery(this).text("Review");
            });
        });
        </script>
<?php }
}
add_action('admin_head', 'live_rename_formats');

//Widgets and Areas

		//Areas
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Homepage',
		'id' => 'Homepage',
		'before_widget' => '<div class="home-widget"><div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	));



	register_sidebar(array(
		'name' => 'Category Sidebar',
		'id' => 'catsidebar',
		'before_widget' => '<div class="home-widget"><div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	));

	register_sidebar(array(
		'name' => 'Post Sidebar',
		'id' => 'postsidebar',
		'before_widget' => '<div class="home-widget"><div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	));

	register_sidebar(array(
		'name' => 'Page Sidebar',
		'id' => 'pagesidebar',
		'before_widget' => '<div class="home-widget"><div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3><div class="widget-title">',
		'after_title' => '</div></h3>',
	));

	if (class_exists('Woocommerce')) {
	register_sidebar(array(
		'name' => 'Woocommerce Sidebar',
		'id' => 'woocommercesidebar',
		'before_widget' => '<div class="home-widget"><div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3><div class="widget-title">',
		'after_title' => '</div></h3>',
	));
	}

	if(function_exists('bp_is_active')){
	register_sidebar(array(
		'name' => 'Buddypress Sidebar',
		'id' => 'bpsidebar',
		'before_widget' => '<div class="home-widget"><div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3><div class="widget-title">',
		'after_title' => '</div></h3>',
	));
	}
	if ( class_exists('bbPress') ) {
	register_sidebar(array(
		'name' => 'bbPress Sidebar',
		'id' => 'bbpress_sidebar',
		'before_widget' => '<div class="home-widget"><div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3><div class="widget-title">',
		'after_title' => '</div></h3>',
	));
	}


}

// Dynamic Widget area for alternative homepage
function alternative_homepage(){
if ( function_exists('register_sidebar') ) {
	$pageposts = get_posts(array('posts_per_page' => -1, 'post_type' => 'page', 'post_status' => 'publish', 'meta_query' => array(array('key' => '_wp_page_template', 'value' => 'alternative homepage.php')),));
	foreach ( $pageposts as $q ){
	$id = 'sidebar-'.esc_html($q->ID);
	$page_title = 'page-'.esc_html($q->post_title);
	if ($page_title && function_exists('register_sidebar')){
	register_sidebar(array(
		'id' => $id,
		'name' => $page_title ,
		'before_widget' => '<div class="home-widget"><div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	));
	}
	}
}
}
add_action( 'after_setup_theme', 'alternative_homepage' );

		//Widgets

include(get_template_directory()."/widgets/small-featured-images.php");
include(get_template_directory()."/widgets/small-featured-images2.php");
include(get_template_directory()."/widgets/big-featured-images.php");
include(get_template_directory()."/widgets/huge-featured-images.php");
include(get_template_directory()."/widgets/blogroll1.php");
include(get_template_directory()."/widgets/newsroll.php");
include(get_template_directory()."/widgets/blogroll2.php");
include(get_template_directory()."/widgets/video.php");
include(get_template_directory()."/widgets/about-us.php");
include(get_template_directory()."/widgets/ad-widget.php");
include(get_template_directory()."/widgets/thumbnails.php");
include(get_template_directory()."/widgets/ticker.php");
include(get_template_directory()."/widgets/super-slider.php");
include(get_template_directory()."/widgets/video-list-ajax.php");
include(get_template_directory()."/widgets/shortcode-widget.php");
include(get_template_directory()."/widgets/trending-posts.php");
include(get_template_directory()."/widgets/social-widget.php");
include(get_template_directory()."/widgets/custom-title-widget.php");



include(get_template_directory()."/widgets/slider.php");
include(get_template_directory()."/widgets/slider2.php");
include(get_template_directory()."/widgets/carousel.php");


		//Widgets style

function sci1_widgets_style(){
	echo
"<style type='text/css'>
	div.widget[id*=_sci1] .widget-title h3:before {content: '';background: url(".esc_url(get_template_directory_uri())."/images/stepfox-tiny-logo-widgets.png)no-repeat;width: 16px;height: 16px;float: left;margin-right: 5px;}
	div.widget[id*=_sci1] .widget-title h3{color: #0F7BB8;}
	div.widget[id*=_sci1] input[type=radio]{height:30px;border-radius:0;width:22%;margin: 0 1% 0 0;text-indent:0;font-size:12px;line-height:30px;color:#747474;font-weight:700;font-family: Open Sans;background-color: #D1D1D1;text-shadow: 1px 1px 0px #FFF;box-shadow: inset 1px 1px 1px #AAA;}
	div.widget[id*=_sci1] input[type=radio]:checked:before{border-radius:0;padding:0;margin:0;height:100%;width:100%;background-color: #0DA000;text-indent:0;font-size:12px;line-height:30px;color:#FFF;font-weight:700;font-family: Open Sans;text-shadow: 1px 1px 0px #000;box-shadow: none;}
	div.widget[id*=_sci1] .one-part:before{content: '1/4';}
	div.widget[id*=_sci1] .two-parts:before{content: '2/4';}
	div.widget[id*=_sci1] .three-parts:before{content: '3/4';}
	div.widget[id*=_sci1] .four-parts:before{content: '4/4';}
</style>"
;}
add_action('admin_print_styles-widgets.php', 'sci1_widgets_style');



// Register Custom Menus

function reg_menus() {
	register_nav_menus(
		array(
			'main-menu' =>'Main Menu',
			'bottom-menu' => 'Bottom Menu', )
	  	);
	  }

add_action( 'init', 'reg_menus' );




// Excerpt Limit

function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
		if(!empty($excerpt)) {
			$excerpt = implode(' ',$excerpt).'...';
		}else{
			$excerpt = '';
		}
  } elseif ( strpos( get_the_excerpt(), 'more-link' ) === false ) {
  	$excerpt = implode(' ',$excerpt).'...';
  } else {
    $excerpt = implode(' ',$excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;

}

function sci1_excerpt_length($length) {return 120;}
add_filter('excerpt_length', 'sci1_excerpt_length');


//Page view counter

function count_views($postID) {
	if (is_single()) {
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}
}

function get_views($postID) {
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return "0";
		}
		return $count;
}

// Get the page number

function sci1_pagination() {
  global $wp_query;
  $big = 999999999;
  echo paginate_links ( array (
		  'base' => str_replace ( $big, '%#%', get_pagenum_link ( $big ) ),
		  'format' => '?paged=%#%',
		  'current' => max ( 1, get_query_var ( 'paged' ) ),
		  'total' => $wp_query->max_num_pages,
  ) );
}

// Dont display sticky posts
function sticky_page_queries( $query ) {
      $query->set('ignore_sticky_posts', 1);

  }
add_action( 'pre_get_posts', 'sticky_page_queries' );
// Video Page number of posts
function video_page_queries( $query ) {
	$sci1_tv_widget_style = get_option('sci1_tv_widget_style');
	if ($sci1_tv_widget_style == 'one') {
			if(is_tax() && $query->is_main_query()){
      $query->set('posts_per_page', 50);
    }
	}elseif($sci1_tv_widget_style == 'two'||$sci1_tv_widget_style == 'three') {
			if(is_tax() && $query->is_main_query()){
      $query->set('posts_per_page', 8);
    }
	}
  }
add_action( 'pre_get_posts', 'video_page_queries' );

// category archive and search number of posts
function archive_page_queries( $query ) {
	$sci1_category_number = get_option('sci1_category_number');
	if (class_exists('Woocommerce')) {

	if(is_archive() && ! is_tax() && $query->is_main_query() && ! is_woocommerce()){
		  $query->set('posts_per_page', $sci1_category_number);
    }}else{

	if(is_archive() && ! is_tax()  && $query->is_main_query()){
		  $query->set('posts_per_page', $sci1_category_number);
    }}

}
add_action( 'pre_get_posts', 'archive_page_queries' );


function sci1_oembed_filter( $return, $data, $url ) {
 	$return = str_replace('frameborder="0"', 'style="border: none"', $return);
	return $return;
}
add_filter('oembed_dataparse', 'sci1_oembed_filter', 90, 3 );


//login page link to home
function loginpage_custom_link() {
	return home_url('/');
}
add_filter('login_headerurl','loginpage_custom_link');

//atom
function hatom_mod_post_content ($content) {
  if ( in_the_loop() && !is_page() ) {
    $content = '<span class="entry-content">'.$content.'</span>';
  }
  return $content;
}
add_filter( 'the_content', 'hatom_mod_post_content');

//add hatom data
function add_suf_hatom_data($content) {
    $t = get_the_modified_time('F jS, Y');
    $author = get_the_author();
    $title = get_the_title();
if (is_home() || is_singular() || is_archive() ) {
        $content .= '<div class="hatom-extra" style="display:none;visibility:hidden;"><span class="entry-title">'.$title.'</span> was last modified: <span class="updated"> '.$t.'</span> by <span class="author vcard"><span class="fn">'.$author.'</span></span></div>';
    }
    return $content;
    }
add_filter('the_content', 'add_suf_hatom_data');

//woocommerce
add_theme_support( 'woocommerce' );

function wp_enqueue_woocommerce_style(){
    wp_register_style( 'woocommerce', get_template_directory_uri() . '/inc/woocommerce.css' );
	if ( class_exists( 'woocommerce' ) ) {
		wp_enqueue_style( 'woocommerce' );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_enqueue_woocommerce_style' );

add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
  function jk_related_products_args( $args ) {

	$args['posts_per_page'] = 4; // 4 related products
	$args['columns'] = 4; // arranged in 2 columns
	return $args;
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 15 );

if ( ! function_exists( 'woocommerce_output_upsells' ) ) {
	function woocommerce_output_upsells() {
	    woocommerce_upsell_display( 4,4 ); // Display 4 products in rows of 4
	}
}

add_filter('loop_shop_per_page', create_function('$cols', 'return 16;') );


	//buddypress images

	define ( 'BP_AVATAR_THUMB_WIDTH', '75' );
	define ( 'BP_AVATAR_THUMB_HEIGHT', '75' );
	define ( 'BP_AVATAR_FULL_WIDTH', '250' );
	define ( 'BP_AVATAR_FULL_HEIGHT', '250' );

// this function goes in your functions.php file and requires google.js created in another gist
function google_load_file() {
		$this_post = get_queried_object();
		$author_id = $this_post->post_author;
		$name = get_the_author_meta('display_name', $author_id);

		wp_enqueue_script( 'author-tracking', get_stylesheet_directory_uri() . '/js/google.js', array(), '1.0.0', true );
		wp_localize_script( 'author-tracking', 'author', array( 'name' => $name ) );
}
add_action( 'wp_enqueue_scripts', 'google_load_file' );

//search image
function get_attachment_id_from_src ($image) {
		global $wpdb;
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image'";
		$id = $wpdb->get_var($query);
		return $id;
}

//jquery -> footer
//add_action('wp_enqueue_scripts', 'true_peremeshhaem_jquery_v_futer');
// function true_peremeshhaem_jquery_v_futer() {
//         wp_deregister_script('jquery');
//         wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), false, null, true);
//         wp_enqueue_script('jquery');
// }

add_action( 'wp_enqueue_scripts', 'bk_optimize_scripts', 99 );
function bk_optimize_scripts() {
	if(is_front_page()){
		wp_dequeue_style( 'contact-form-7' );
	}
	wp_dequeue_style( 'custom-404-pro' );
	wp_dequeue_style( 'hide-widgets-css' );
}
