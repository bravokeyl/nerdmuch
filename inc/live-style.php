<?php 
/**
 * Science Magazine live-style
**/ 
?>
<?php 

function sci1_head() {

	$slide_style = get_option('sci1_slider_picker');
	if($slide_style == 'slider_fx1'){$slide_picker='slide';}else{$slide_picker='fade';}

	$top_posts_background = get_option('sci1_top_posts_background');
	$sci1_popular_background_color = get_option('sci1_popular_background_color');
	$sci1_popular_text_color = get_option('sci1_popular_text_color');
	$sci1_popular_read_more_color = get_option('sci1_popular_read_more_color');

	$top_posts_cat_color = get_option('sci1_top_posts_cat_color');
	$top_posts_title_color = get_option('sci1_top_posts_title_color');
	$sci1_site_width = get_option('sci1_site_width').'px';
	$bloginfo = get_template_directory_uri();
	$menu_background = get_option('sci1_menu_background');

	$sci1_site_font_size = get_option('sci1_site_font_size');
	$sci1_hover_color = get_option('sci1_hover_color');



	$menucolor = get_option('sci1_menu_color');
	$menu_font_weight = get_option('sci1_menu_font_weight');
	$menu_font_size = get_option('sci1_menu_font_size');	
	$menu_hover_color =  get_option('sci1_menu_hover_color');
	$main_color = get_option('sci1_main_color');
	$widget_fx = get_option('sci1_widget_fx');
	$image_effect = get_option('sci1_image_effect');
	$font = get_option('sci1_fonts');
	$menu_font = get_option('sci1_menu_font');
	$small_text_font = get_option('sci1_small_text_font');


	$super_slider_color = get_option('sci1_super_slider_color');
	$super_slider_title = get_option('sci1_super_slider_title');	
	$uppercase_title = get_option('sci1_uppercase_title');
	$sci1_content_font_size = get_option('sci1_content_font_size').'px'; 
	$sci1_content_line_height = $sci1_content_font_size * 1.6.'px';



	$background_color = get_background_color();
	$sci1_widget_title_style = get_option('sci1_widget_title_style' );
	$sci1_widget_font_weight = get_option('sci1_widget_font_weight' );


	$sci1_widget_color_one = get_option('sci1_widget_color_one' );
	$sci1_widget_color_text = get_option('sci1_widget_color_text' );
	


//Typography
if ($font == 'Akashi' || $font == 'blowbrush' || $font =='alpha_echo'){
echo "
	<style type='text/css'>

@font-face {
    font-family: '$font';
    src: url('".get_template_directory_uri()."/css/font/$font.ttf');
}

	</style>";
}


if ($menu_font == 'Akashi' || $menu_font == 'blowbrush' || $menu_font =='alpha_echo'){
echo "
	<style type='text/css'>

@font-face {
    font-family: '$menu_font';
    src: url('".get_template_directory_uri()."/css/font/$menu_font.ttf');
}

	</style>";
}

if ($small_text_font == 'Akashi' || $small_text_font == 'blowbrush' || $small_text_font =='alpha_echo'){
echo "
	<style type='text/css'>

@font-face {
    font-family: '$small_text_font';
    src: url('".get_template_directory_uri()."/css/font/$small_text_font.ttf');
}

	</style>";
}





//Css

	echo "

<style type='text/css'>

.trending-posts ul::-webkit-scrollbar{background:$sci1_widget_color_one;}
.trending-posts li{background:$sci1_widget_color_one;}
.img-featured-posts-image:before, .small-image:before, .carousel-image:before, .trending-posts .img-featured-posts-image:before{background:$sci1_widget_color_one;opacity:0.5;}
.super-slider .super-slider-post:before, .wide-slider .slides li:after{background:$super_slider_color;opacity:0.5}
.latest-posts-button{color:#FFF;background:$main_color;}
.latests-posts-button-number:after{border-top-color:#FFF;}
#submit{border:none;color:$sci1_widget_color_text;background:$sci1_widget_color_one;}
html { font-size: $sci1_site_font_size; }
#wrapper, .footer-wrap, .latest-posts-menu ul{max-width:$sci1_site_width;}
#footer a, .copyright-text{color:$sci1_widget_color_text;}
#footer a:hover{color:$main_color;}
#main-nav ul li a, #mob-menu{font-family: $menu_font;}
.trending-icon{fill:$sci1_widget_color_text;}
.latest-posts-menu-title, .img-featured-title h2, .super-slider-title, .blog-post-title h2, .tv-widget-title, #post-page-title, .featured-posts-title, .comment-count, #reply-title{font-style: $sci1_widget_title_style;}
.tv-featured, #footer{background:$sci1_widget_color_one;}
.trending-posts ul, #footer{border-color:$sci1_widget_color_one;}
.tv-widget-content, .tv-widget-title a, .tv-ajax-carousel-title a{color:$sci1_widget_color_text;}

.trending-posts .img-featured-title h2 a, .trending-posts .img-featured-text, .category-icon, .img-featured-category-link a, .img-featured-title a, .img-featured-title, .author-date > div, #calendar_wrap a, .small-title a, .small-author, .small-author a, .trending-title, .trending-posts-category a, .trending-posts-title a, .carousel-title a, .carousel-author a{color:$sci1_widget_color_text;}


.post-author a, .post-author a:visited, .good-title, .bad-title, #post-content a, .category-tv-icon a, .ticker-sign, .category-icon a{color:$main_color;}

.huge .img-featured-category-link a:hover, .trending-posts-title a:hover, .trending-posts-category a:hover, a:hover, .category-icon a:hover, .featured-posts-title a:hover, #post-content a:hover, .blog-post-title h2 a:hover, .bypostauthor a:hover, .post-author a:hover, .img-featured-title a:hover, .trending-posts .img-featured-title h2 a:hover{color:$sci1_hover_color;}


#main-nav, .ticker-box, .page-numbers.current, .about-social, .widget_search .submit-button{background:$menu_background;}
.search-menu-icon {border: 3px solid $menucolor;}
.search-menu-icon:after{   background: $menucolor; }
.search-menu-icon:hover{border: 3px solid $menu_hover_color;}
.search-menu-icon:hover:after{ background: $menu_hover_color;}
.mob-menu-button:before, .author-date > div:first-child{border-color:$sci1_widget_color_text;}


.super-slider-title a, .slide-title h2 a, .slide-date a, .super-slider-post a:hover, .slide-title h2 a:hover, .slide-excerpt, .super-slider .author-date > div, .super-slider-post a{color:$super_slider_title;} 
.super-slider .author-date > div:first-child{border-color:$super_slider_title;}
.latest-posts-menu{background:#$background_color;} 
.top-menu{background-color:$top_posts_background;}
.top-menu-posts li .category-icon a{color:$top_posts_cat_color;}
.top-menu-posts .featured-posts-title a{color:$top_posts_title_color;}
body, .small-title, .widget-title, .about-text{font-family:$font;}
.popular-part:before{background:$sci1_popular_background_color;box-shadow: 0 -999px 0 999px $sci1_popular_background_color;}
.popular-slider-container .slides:before{background: radial-gradient(ellipse at center, rgba(0,0,0,0) 0%,$sci1_popular_background_color 64%,$sci1_popular_background_color 100%);}
.popular-part a, .popular-part .widget-title{color:$sci1_popular_text_color;}
.read-more a{color:$sci1_popular_read_more_color;}
.blog-post-content, .img-featured-text, .flex-active-slide .slide-excerpt, .combination-title-subtitle, .tv-widget-content, #post-content, #post-page-subtitle, .newsroll-posts-title a{font-family:$small_text_font;}
#site-logo, .about-logo, #mob-menu, .footer-logo{background:$main_color;}
.menu-item .menu-link, #ticker a, .page-numbers.current, #navigation .submit-button, .about-social a, .ticker-heading, #navigation .content-social li a{color:$menucolor;}
.subsignmeni:after{border-top: 8px solid $menucolor;}
#main .widget-title, #main .widget-title a{color:$main_color;}
#main-nav ul li:hover > .menu-link, #ticker a:hover, .about-social a:hover, .sub-menu-wrapper .small-category li:hover > .small-text a, #navigation .content-social li a:hover{color:$menu_hover_color;}
.subsignmeni:hover:after{border-top: 8px solid $menu_hover_color;}
#main-nav ul li > .menu-link{font-weight:$menu_font_weight;}
.menu-link {font-size:$menu_font_size;}
.featured-category, .page-numbers, input#wp-submit{background: $main_color;}
.newsroll-title, .post-page-gallery-thumbnails .flex-active-slide:after, .flex-active .wide-slider-thumb:after{border-color:$main_color;}
.blog-post-author a, #recentcomments li, .widget_categories select, .widget_archive select, .sticky a{color:$main_color;}
.img-featured-review-score, .blog-post-categories, .woocommerce input#searchsubmit, .floating-share-icons li, .pagination.pagination-load-more a, .latest-posts-menu-date, .wide-slider-control li{background:$main_color;}
.sub-meni .menu-links.inside-menu li{background: $menu_background;}
.sub-meni .menu-links.inside-menu li a{color: $menucolor;}
.sub-menu{border-color:$main_color;}
#post-content{font-size:$sci1_content_font_size;line-height:$sci1_content_line_height;}
::selection{background:$main_color;}
::-moz-selection{background:$main_color;}
.load-circle{border-bottom:5px solid $main_color;border-right:5px solid $main_color;box-shadow: 0 0 35px $main_color;}
#wp-calendar #today{background:$main_color !important;text-shadow:none;}
.total-score, .score-width, li:hover .play-icon{background: $main_color;}
.single-post #post-content.first-letter > p:first-of-type:first-letter{font-size:67px; color:$main_color;float: left;line-height: 60px;margin-right: 15px;font-weight:800;}
#post-page-title h1{text-transform:$uppercase_title;}
blockquote, q.left, q{border-left: 2px solid $main_color;color:$main_color;}
.img-featured-review-score:before{border-top: 9px solid $main_color;}
.sub-meni .menu-links.inside-menu li:hover{background:$menu_background;}
#main-nav .sub-meni .menu-links.inside-menu li:hover > .menu-link{color:$menu_hover_color;}
.ticker-arrows{background:$menu_background;box-shadow:-21px 0 30px $menu_background;}
.widget-title {font-style: $sci1_widget_title_style;font-weight:$sci1_widget_font_weight;}

.content q.right{border-left:0;border-right: 2px solid $main_color;color:$main_color;}
.widget.buddypress div.item-options a, .widget_display_stats dd{color:$main_color;}
#buddypress div.item-list-tabs ul li a span, #buddypress div.item-list-tabs ul li.current a span, #buddypress div.item-list-tabs ul li.selected a span, .widget.buddypress #bp-login-widget-form #bp-login-widget-submit, span.bp-login-widget-register-link a, button#user-submit, .bbp-login-form .bbp-login-links a, tt button.button.submit.user-submit, input#bbp_search_submit {background:$main_color;}
.image_fx1:hover:after, .image_fx1:hover:after, .img-featured li:hover .image_fx1:after, .small-category li:hover .image_fx1:after{background: $main_color;}



@media screen and (max-width: 700px) {
#main-nav ul li {background:$menu_background;}
.sub-menu-wrapper .menu-links.inside-menu .menu-link{color:$menucolor;}
.menu-item{border-bottom:none !important;}
.search-menu-icon:hover{border: 3px solid $sci1_widget_color_text;}
.search-menu-icon:hover:after{ background: $sci1_widget_color_text;}
.search-menu-icon {border: 3px solid $sci1_widget_color_text;}
.search-menu-icon:after{   background: $sci1_widget_color_text; }
}



@media screen and (min-width: 1024px) {




.tv-ajax-carousel .slides li:first-child{display:block;max-height:calc(((((($sci1_site_width - 20px) * 0.75 ) - 20px )  / 4) - 40px) / 1.6);height:calc((((((100vw - 20px) * 0.75 ) - 20px )  / 4) - 40px) / 1.6);  }
.wide-slider .slides > li:first-child{max-height:calc(((($sci1_site_width - 20px) * 0.25 ) - 20px ) / 0.75);height:calc((((100vw - 20px) * 0.25 ) - 20px ) / 0.75); }
.carousel .slides > li:first-child{max-height:calc(((($sci1_site_width - 20px) * 0.25 ) - 20px ) / 0.75);height:calc((((100vw - 20px) * 0.25 ) - 20px ) / 0.75);}
.four-parts .wide-slider .slides > li:first-child{max-height:calc(($sci1_site_width - 40px) / 2.496);height:calc((100vw - 40px) / 2.496);}

.newsroll ul.one-part-height{min-height:calc((((($sci1_site_width - 20px) * 0.25 ) - 20px ) / 0.75) - 20px);}
.newsroll ul.two-parts-height{min-height:calc(((((($sci1_site_width - 20px) * 0.25 ) - 20px ) / 0.75) * 2 ) - 20px);}




}

.woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce #content input.button.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page #content input.button.alt, .woocommerce .widget_layered_nav_filters ul li a, .woocommerce-page .widget_layered_nav_filters ul li a, .woocommerce .widget_layered_nav ul li.chosen a, .woocommerce-page .widget_layered_nav ul li.chosen a, .woocommerce span.onsale, .woocommerce-page span.onsale, .woocommerce .woocommerce-message:before, .woocommerce-page .woocommerce-message:before, .woocommerce .woocommerce-info:before, .woocommerce-page .woocommerce-info:before, .woocommerce table.cart a.remove:hover, .woocommerce #content table.cart a.remove:hover, .woocommerce-page table.cart a.remove:hover, .woocommerce-page #content table.cart a.remove:hover, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce #content div.product .woocommerce-tabs ul.tabs li, .woocommerce-page div.product .woocommerce-tabs ul.tabs li, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li{background:$main_color;}

.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .woocommerce div.product span.price, .woocommerce div.product p.price, .woocommerce #content div.product span.price, .woocommerce #content div.product p.price, .woocommerce-page div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce #content input.button.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page #content input.button.alt:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #main a.button:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce #content div.product .woocommerce-tabs ul.tabs li, .woocommerce-page div.product .woocommerce-tabs ul.tabs li, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product .woocommerce-tabs ul.tabs .active a:hover, span.posted_in a, span.tagged_as a, .woocommerce h1.page-title, .amount, #header .cart-contents:hover, #header .cart-contents, .woocommerce .blog-category .star-rating, .woocommerce-page .blog-category .star-rating{color:$main_color;}

.woocommerce .woocommerce-message, .woocommerce-page .woocommerce-message, .woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info{border-top:3px solid $main_color; }

.product_meta, .woocommerce div.product div.summary, .woocommerce #content div.product div.summary, .woocommerce-page div.product div.summary, .woocommerce-page #content div.product div.summary, .woocommerce #reviews #comments ol.commentlist li .comment-text p, .woocommerce-page #reviews #comments ol.commentlist li .comment-text p, .woocommerce #review_form #respond p, .woocommerce-page #review_form #respond p, .woocommerce div.product .woocommerce-tabs .panel, .woocommerce #content div.product .woocommerce-tabs .panel, .woocommerce-page div.product .woocommerce-tabs .panel, .woocommerce-page #content div.product .woocommerce-tabs .panel, .woocommerce #reviews h3, .woocommerce-page #reviews h3{font-size:$sci1_content_font_size;line-height:$sci1_content_line_height;}

</style>";

//Slider

	echo
	"<script type='text/javascript'>
			var slide_picker = '$slide_picker';
			var widget_fx = '$widget_fx';
			var image_effect = '$image_effect';
	</script>";

}

function customizer_css() {
	echo "
	
	<style type='text/css'>
.customize-control-image .container, .customize-control-header .container{float:left;background:#ebebeb;margin-bottom:10px;height:auto !important;}
.customize-control-header .header-view{background:#ebebeb;}	
.customize-control-image .actions{width:100%;float:left;}
.customize-section .customize-control-image .preview-thumbnail img {max-width:100% !important;max-height:100% !important;}
#customize-control-sci1_logo .container{}
#customize-section-sci1_images .customize-control{padding-bottom:20px;}
 
    </style>";
}
//Login page css
function custom_login_css() {
    $login_logo = get_header_image();
	$login_logo_height = get_custom_header()->height.'px';
	$login_logo_width = get_custom_header()->width.'px';
	$main_color = get_option('sci1_main_color');

	
	echo "
	<style type='text/css'>
body.login {background: #FFF;}
.login *{text-align:center;}
.login label{font-size:18px;font-weight:700;color:#000;}

input#rememberme {float: left;height: 17px;width: 17px;margin-right: 12px;margin-top: 2px;}
.login form .forgetmenot label{font-size:16px;}
.forgetmenot{margin:7px 0;}
.login h1 a {background: $main_color url($login_logo)no-repeat;background-size: $login_logo_width $login_logo_height;width: $login_logo_width;height: $login_logo_height;max-width:$login_logo_width;}
.interim-login #login{width:320px;}
#login {width: 400px;padding: 8% 0 0;margin: auto;}
input#wp-submit{background-color:$main_color;border:0;border-radius:0;font-size:16px;text-transform:uppercase;font-weight:700;color:#FFF !important;padding: 0 12px;height: 30px;line-height: 28px;}
.login form{margin-top:0;box-shadow:none;-webkit-box-shadow:none;padding:30px 0 60px;}
.login #nav{font-size:0;padding:0;}
p#nav a{background-color:$main_color;border:0;border-radius:0;font-size:16px;text-transform:uppercase;font-weight:700;color:#FFF !important;padding: 5px 0px;margin-right:20px; float: left;text-align: center;margin-bottom: 20px;width:100%;}
.login #backtoblog a{color:$main_color;font-size:20px;font-weight:700;}
 p#nav a:hover, input#wp-submit:hover{background-color:#FFF;color:$main_color !important;box-shadow:inset 0 0 10px $main_color;}
 .login #login_error{border-color:$main_color;}
    </style>";
}
//Fonts

function google_font() {
	$font = get_option('sci1_fonts');
	$fontmenu = get_option('sci1_menu_font');
	$fontwidget = get_option('sci1_small_text_font');
	$sci1_customfont = str_replace( ' ', '+', $font ) . ':400,600,700,800|' . esc_html($font);
	$sci1_customfontmenu = str_replace( ' ', '+', $fontmenu ) . ':400,600,700,800|' . esc_html($fontmenu);
	$sci1_customfontsmalltext = str_replace( ' ', '+', $fontwidget ) . ':400|' . esc_html($fontwidget);
	$protocol = is_ssl() ? 'https' : 'http';
	if ($font != 'Akashi' && $font != 'blowbrush' && $font !='alpha_echo'){
		wp_enqueue_style( 'google-fonts', "$protocol://fonts.googleapis.com/css?subset=latin,latin-ext,cyrillic,cyrillic-ext&family=".esc_html($sci1_customfont) . " rel='stylesheet' type='text/css" );
	}
	if ($fontmenu != 'Akashi' && $fontmenu != 'blowbrush' && $fontmenu !='alpha_echo'){
		wp_enqueue_style( 'google-menu-fonts', "$protocol://fonts.googleapis.com/css?subset=latin,latin-ext,cyrillic,cyrillic-ext&family=".esc_html($sci1_customfontmenu) . " rel='stylesheet' type='text/css" );
	}
	if ($fontwidget != 'Akashi' && $fontwidget != 'blowbrush' && $fontwidget !='alpha_echo'){
		wp_enqueue_style( 'google-widget-fonts', "$protocol://fonts.googleapis.com/css?subset=latin,latin-ext,cyrillic,cyrillic-ext&family=".esc_html($sci1_customfontsmalltext) . " rel='stylesheet' type='text/css" );
	}
}
add_action('login_head', 'custom_login_css');
add_action( 'wp_enqueue_scripts', 'google_font' );
add_action( 'wp_head', 'sci1_head');
add_action( 'customize_controls_print_styles', 'customizer_css' );
?>