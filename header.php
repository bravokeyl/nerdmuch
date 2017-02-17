<?php
/**
 * Science Magazine theme header
**/
?>
<!DOCTYPE html>
<html <?php language_attributes();?>><head>
<script>window.mrf={host:"b.marfeel.com",dt:3},function(e,t,o,a,i,r,n){function d(){l&&(e.cookie="fromt=yes;path=/;expires="+new Date(Date.now()+18e5).toGMTString(),o.reload())}var l=!/marfeelgarda=no|fromt=yes/i.test(r+";"+i);if((/(ipad.*?OS )(?!1_|2_|3_|4_|X)|mozilla.*android (?!(1|2|3)\.)[0-9](?!.*mobile)|\bSilk\b/i.test(a)&&2&n.dt||/(ip(hone|od).*?OS )(?!1_|2_|3_|4_|X)|mozilla.*android (?!(1|2|3)\.)[0-9].*mobile|bb10/i.test(a)&&1&n.dt||/marfeelgarda=off/i.test(r))&&t===t.top){l&&e.write('<plaintext style="display:none">');var s="script",m=setTimeout(d,1e4),c=e.createElement(s),f=e.getElementsByTagName(s)[0];c.src="//bc.marfeel.com/statics/marfeel/gardac.js",c.onerror=d,c.onload=function(){clearTimeout(m)},f.parentNode.insertBefore(c,f)}}(document,window,location,navigator.userAgent,document.cookie,location.search,window.mrf);</script>
<meta property="fb:pages" content="1423694334614664" />
<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<!--viewport-->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!--charset-->
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<!--rss-comments-->
<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>"/>
<!--rss-->
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<!--atom-->
<link rel="alternate" type="application/atom+xml" title="Atom" href="<?php bloginfo('atom_url'); ?>" />
<!--pingback-->
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!--Facebook Open Graph-->
<?php if ( defined('WPSEO_VERSION') ) {}else{?>
<!--FB page title-->
<meta property="og:title" content="<?php if (! function_exists('bp_is_active') ) {if (is_single() && !is_front_page() || is_page() && !is_front_page()){echo esc_attr(get_the_title());}else if ( is_home() || is_front_page()){bloginfo('name');}else{bloginfo('name');}}else {if (is_single() || is_page() && !is_buddypress()) {echo esc_attr(get_the_title());} elseif(is_buddypress()){wp_title();} else {bloginfo('name');}} ?>" />
<!--FB description-->
<meta property="og:description" content="<?php if (is_single()) {echo substr(strip_tags($post->post_content), 0, 200); echo '...';} else {bloginfo('description');} ?>"/>
<!--FB url-->
<meta property="og:url" content="<?php if ( is_home() || is_front_page() ){echo esc_url(home_url('/'));} else{the_permalink();} ?>"/>
<!--FB image-->
<meta property="og:image" content="<?php if (is_single()) {$fbthumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider-three'); echo esc_url($fbthumb[0]);} else {echo esc_url(get_option('sci1_facebook_default'));}?>" />
<!--FB type-->
<meta property="og:type" content="<?php if (is_single()) { echo "article"; } else { echo "website";} ?>"/>
<!--FB site name-->
<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
<?php } ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header id="header">
		<div id="nav-wrapper">
		<div id="navigation" class="<?php echo esc_attr(get_option('sci1_fixed_menu')); ?> <?php echo esc_attr(get_option('sci1_header_type')); ?>">
			<div id="site-logo">
				<div class="big-logo">
					<a href="<?php echo esc_url(home_url('/')); ?>">
					<img src="<?php header_image(); ?>" height="<?php echo esc_attr(get_custom_header()->height); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>" alt="<?php bloginfo( 'name' ); ?>"/>
					</a>
				</div>
				<!--big-logo-->
			</div>
			<!--site-logo-->
			<div class="top-menu <?php if(get_option( 'sci1_header_button_show' ) == 'true'){echo esc_attr('has-button-menu');}?>">
				<?php top_menu_posts(); ?>
				<?php if(get_option( 'sci1_header_button_show' ) == 'true'){ ?>
				<div class="latest-posts-button">
					<?php latests_posts_button();?>

				</div>
				<!-- latest-posts-button -->
				<?php } ?>
			</div>
			<!-- top-menu -->
			<?php if(get_option( 'sci1_header_button_show' ) == 'true'){ ?>
			<div class="latest-posts-menu">
				<?php latests_posts_menu(); ?>
			</div>
			<!-- latest-posts-menu -->
			<?php } ?>
			<nav id="main-nav">
				<div class="main-nav-wrap">
				<div id="mob-menu">
					<div class="mob-menu-button">
					</div>
					<!-- mob-menu-button -->
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<img src="<?php header_image(); ?>" height="<?php echo esc_attr(get_custom_header()->height); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>" alt="<?php bloginfo( 'name' ); ?>"/>
					</a>
					<div class="search-box">

						<?php //get_search_form(); ?>
					</div>
					<!--search-box-->

				</div>
				<!--mob-menu-->
				<?php if ( has_nav_menu( 'main-menu' ) ) {wp_nav_menu(array(
				'theme_location' => 'main-menu',
				'depth' => 10,
				'fallback_cb'     => 'wp_page_menu',
				'walker' => new sci1_super_menu()
				));}else { echo '<span class="add-menu">ADD MENU</span>';} ?>
				<a href="#" class="search-menu-icon">
				</a>
				<?php	menu_share_icons();	 ?>
				<div class="search-box widgetfx-1">
					<span class="close-search-box">
					</span>
					<?php get_search_form(); ?>
				</div>
				<!--search-box-->
			</div>
			<!-- main-nav-wrap -->
			</nav>
			<!--main-nav-->
		</div>
		<!--navigation-->
	</div>
	<!--nav-wrapper-->
</header>
<!--header-->
<section id="wrapper" class="hfeed">
