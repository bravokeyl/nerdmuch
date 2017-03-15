<?php 
/**
 * Science Magazine image sizes
**/ 
?>
<?php

// Register Thumbnails

$ds_site_width = get_option('sci1_site_width');
$ratio = 1290;
$ratio = $ds_site_width;

$width28thumb = round(((($ratio - 20) / 4 ) - 20 ) / 3.571);
$width25 = round((($ratio - 20) * 0.25 ) - 20 );
$jumping_thumb = round(($ratio - 20) * 0.25 );
$width40 = round(((($ratio - 20) * 0.25 ) - 40) * 0.40);
$width50 = round((($ratio - 20) * 0.5 ) - 20 );
$width75 = round((($ratio - 20) * 0.75 ) - 20 );
$width100 = round( $ratio - 40 );

// Register Thumbnails

if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );
//super-slider
add_image_size( 'fullwidthimage', 1920, 652, true );
add_image_size( 'sliderimagefeatured', $width50, round($width25 / 1.5), true );
//thumbnails
add_image_size( 'smallthumb', $width28thumb, $width28thumb, true );
//huge-featured-images
add_image_size( 'hugeimagefeatured', $width50, round($width25 / 0.75), true );
//big-featured-images
add_image_size( 'mediumimagefeatured', $width25, round($width25 / 0.75), true );
//small-featured-images
add_image_size( 'smallimagefeatured', $width25, round(($width25 / 2 / 0.75 ) - 10), true );
//slider
add_image_size( 'slider-three', $width75, round($width25 / 0.75), true );
add_image_size( 'slider-four', $width100, round($width100 / 2.496), true );
}

add_filter( 'image_size_names_choose', 'science_image_sizes_reg' );

function science_image_sizes_reg( $sizes ) {
	$new_sizes = array();
	$added_sizes = get_intermediate_image_sizes();
	foreach( $added_sizes as $key => $value) {
		$new_sizes[$value] = $value;
	}
	$new_sizes = array_merge( $new_sizes, $sizes );
	return $new_sizes;


}

//Woocommerce thumbnails dimensions
function catalog_woocommerce_image() {
	$ds_site_width = get_option('sci1_site_width');
	$ratio = 1290;
	$ratio = $ds_site_width;
	$woocatalog = round(((($ratio - 20) * 0.75 ) - 20)* 0.22);
  	$catalog = array(
		'width' 	=> $woocatalog,	// px
		'height'	=> $woocatalog,	// px
		'crop'		=> 1 		// true
	);
	return $catalog;
}
function single_woocommerce_image() {
	$ds_site_width = get_option('sci1_site_width');
	$ratio = 1290;
	$ratio = $ds_site_width;
	$woosingle = round(((($ratio - 20) * 0.75 ) - 20)* 0.48);
	$single = array(
		'width' 	=> $woosingle,	// px
		'height'	=> $woosingle,	// px
		'crop'		=> 1 		// true
	);
	return $single;
}
function thumbnail_woocommerce_image() {
	$ds_site_width = get_option('sci1_site_width');
	$ratio = 1290;
	$ratio = $ds_site_width;
	$woothumb = round(((($ratio - 20) * 0.25 ) - 20)* 0.25);
	$thumbnail = array(
		'width' 	=> $woothumb,	// px
		'height'	=> $woothumb,	// px
		'crop'		=> 0 		// false
	);
	return $thumbnail;
}
add_filter( 'woocommerce_get_image_size_shop_catalog', 'catalog_woocommerce_image' );
add_filter( 'woocommerce_get_image_size_shop_single', 'single_woocommerce_image' );
add_filter( 'woocommerce_get_image_size_shop_thumbnail', 'thumbnail_woocommerce_image' );




//if (get_option('sci1_wait_till_loaded' ) == 'false'){

function image_sizes_holder($sizes) {
global $_wp_additional_image_sizes;
$added_sizes = get_intermediate_image_sizes();?>

<style type="text/css">
<?php foreach( $added_sizes as $value) {
if ( in_array( $value, array( 'thumbnail', 'medium', 'large' ) ) ) {
            } elseif ( isset( $_wp_additional_image_sizes[ $value ] ) ) {

$ds_site_width = get_option('sci1_site_width');
$ratio = 1290;
$ratio = $ds_site_width;

if ($value == 'fullwidthimage'){$ratio = 1920;}

$img_uber = $ratio / $_wp_additional_image_sizes[ $value ]['width'];
$ratio_img = $_wp_additional_image_sizes[ $value ]['width'] / $_wp_additional_image_sizes[ $value ]['height'];

if ($value != 'fullwidthimage'){
	echo '.super-slider .slides li:first-child{display:block;}#header .size-small-thumb{max-width:auto;height:auto;}
@media screen and (min-width: 1024px) {
	#main{opacity:1;}
	.loading{opacity:1;};
	.size-'.$value.'{
	width:calc(100vw / '.$img_uber.');
	height:calc((100vw / '.$img_uber.') / '.$ratio_img.' );
max-width:'. $_wp_additional_image_sizes[ $value ]['width'].'px;
max-height:'. $_wp_additional_image_sizes[ $value ]['height'].'px;}	
@media screen and (-webkit-min-device-pixel-ratio:0) {
	.size-'.$value.'{
	width:calc((100vw - 17px) / '.$img_uber.');
	height:calc(((100vw - 17px) / '.$img_uber.') / '.$ratio_img.' );
max-width:'. $_wp_additional_image_sizes[ $value ]['width'].'px;
max-height:'. $_wp_additional_image_sizes[ $value ]['height'].'px;}
}}';
      }else{
echo '@media screen and (min-width: 1024px) {
.size-'.$value.'{width:calc(100vw / '.$img_uber.'); height:calc((100vw / '.$img_uber.') / '.$ratio_img.' );}
@media screen and (-webkit-min-device-pixel-ratio:0) {
.size-'.$value.'{width:calc((100vw - 17px) / '.$img_uber.'); height:calc(((100vw - 17px) / '.$img_uber.') / '.$ratio_img.' );}
}}';}}}?>
</style>

<?php
}
add_action( 'wp_head', 'image_sizes_holder');
//}




?>