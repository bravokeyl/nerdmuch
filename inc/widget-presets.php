<?php

add_action('admin_menu', 'sci1_one_button_preset');

function sci1_one_button_preset() {
	if(is_super_admin() ){
	add_theme_page('Science Magazine one button install widgets', 'Science Magazine Widget Presets', 'read', 'sci1_one_button','sci1_prearange');
	}
}



function sci1_prearange(){
	wp_enqueue_style( 'Science Magazine one button install widgets style', get_template_directory_uri() . '/inc/sci1-widget-presets.css' );
	wp_enqueue_script('Science Magazine one button install widgets', get_template_directory_uri() . '/js/sci1-one-button-install.js', array('jquery'));
	$bloginfo = get_template_directory_uri(); ?>

<div class="theme-presets">
	<div class="color-presets">
		<div class="color-presets-text">
			<h2>
				<?php _e( 'Color Presets:', 'science-magazine' ); ?>
			</h2>
			<p>
				<?php _e( 'Pick Color Preset:', 'science-magazine' ); ?>
			</p>
		</div>
		<!-- color-presets-text -->

		<div class="color-presets-radios">
			<ul class="theme-colors-presets">
				<li class="theme-colors-preset1">
					
					<form method="post">
						<input  type="submit" class="button-secondary" name="preset1" value="<?php echo esc_attr('Hanamura'); ?>"/>
					</form>
				</li>
				<li class="theme-colors-preset2">
					
					<form method="post">
						<input  type="submit" class="button-secondary" name="preset2" value="<?php echo esc_attr('Roadhog'); ?>"/>
					</form>
				</li>
				<li class="theme-colors-preset3">
					
					<form method="post">
						<input  type="submit" class="button-secondary" name="preset3" value="<?php echo esc_attr('Genji'); ?>"/>
					</form>	
				</li>
				<li class="theme-colors-preset4">
					
					<form method="post">
						<input  type="submit" class="button-secondary" name="preset4" value="<?php echo esc_attr('Dorado'); ?>"/>
					</form>	               
				</li>
				<li class="theme-colors-preset5">
					
					<form method="post">
						<input  type="submit" class="button-secondary" name="preset5" value="<?php echo esc_attr('Symmetra'); ?>"/>
					</form>	               
				</li>
				<li class="theme-colors-preset6">
					 
					<form method="post">
						<input  type="submit" class="button-secondary" name="preset6" value="<?php echo esc_attr('7six'); ?>"/>
					</form>	               
				</li>
				<li class="theme-colors-preset7">
					
					<form method="post">
						<input  type="submit" class="button-secondary" name="preset7" value="<?php echo esc_attr('Kings Row'); ?>"/>
					</form>	                
				</li>
				<li class="theme-colors-preset8">
					 
					<form method="post">
						<input  type="submit" class="button-secondary" name="preset8" value="<?php echo esc_attr('LiJiang'); ?>"/>
					</form>              
				</li>                
			</ul>
		</div>
		<!-- color-presets-radios -->
	</div>
	<!-- color-presets -->



		<div class="widget-layouts-text">
			<h2>
				<?php _e( 'Widget Layout:', 'science-magazine' ); ?>
			</h2>
			<p>
				<?php _e( 'Pick Widget Layout:', 'science-magazine' ); ?>
			</p>
		</div>
		<!-- widget-layouts-text -->

	<div class="widget-layouts">
	
		<div class="widget-layout-dropdown">
			<form method="post">
			<select name="demo-installer-widgets-layout" id="widget-layout-dropdown">

				<?php $options = array(
					'' => 'Pick a Widget Layout',
					'demo1' => 'Demo1',
					'demo2' => 'Demo2',
					'demo3' => 'Demo3',
					'demo4' => 'Demo4',
					'demo5' => 'Demo5',
					'reset_widgets' => 'Blank Demo',
					);

				foreach ($options as $option => $name) {?>
					<option value='<?php echo esc_attr($option); ?>'>
						<?php echo esc_html($name); ?>
					</option>
				<?php } ?>
			</select>
			<input type="submit" value="<?php echo esc_attr('Submit');?>"/>
			</form>
		<?php 
		if(isset($_POST['demo-installer-widgets-layout']) && !empty($_POST['demo-installer-widgets-layout']) && $_POST['demo-installer-widgets-layout'] != 'reset_widgets'){
			stepfox_demo_remove_inactive_widgets();
			update_option('sidebars_widgets', array ('wp_inactive_widgets' => array ( )));
			$demo_picked = $_POST['demo-installer-widgets-layout'];
			stepfox_demo_layout($demo_picked);
		}elseif(isset($_POST['demo-installer-widgets-layout']) && $_POST['demo-installer-widgets-layout'] == 'reset_widgets'){
			stepfox_demo_remove_inactive_widgets();
			update_option('sidebars_widgets', array ('wp_inactive_widgets' => array ( )));
		}?>
		</div>
	<!-- widget-layout-dropdown -->

		<ul class="layout-images">
			<li>
				<img src="<?php echo esc_url($bloginfo); ?>/images/widget-presets/select_layout.png"/>
			</li>
			<li>
				<img src="<?php echo esc_url($bloginfo); ?>/images/widget-presets/demo1sci.png"/>
			</li>
			<li>
				<img src="<?php echo esc_url($bloginfo); ?>/images/widget-presets/demo2sci.png"/>
			</li>
			<li>
				<img src="<?php echo esc_url($bloginfo); ?>/images/widget-presets/demo3sci.png"/>
			</li>
			<li>
				<img src="<?php echo esc_url($bloginfo); ?>/images/widget-presets/demo4sci.png"/>
			</li>
			<li>
				<img src="<?php echo esc_url($bloginfo); ?>/images/widget-presets/demo5sci.png"/>
			</li>
			<li>
				<img src="<?php echo esc_url($bloginfo); ?>/images/widget-presets/reset_layout.png"/>
			</li>

		</ul>
	</div>
	<!-- widget-layouts -->




</div>
<!-- theme-presets -->

<?php


if(isset($_POST) && !empty($_POST['empty'])) {

	update_option('sidebars_widgets', array ('wp_inactive_widgets' => array ( )));
} elseif (isset($_POST) && !empty($_POST['preset1'])){

update_option('sci1_top_posts_background', '#FFFFFF');
update_option('sci1_top_posts_cat_color', '#cccccc');
update_option('sci1_top_posts_title_color', '#353535'); 
update_option('sci1_menu_background', '#f7f7f7');
update_option('sci1_menu_color', '#7a7a7a');
update_option('sci1_menu_hover_color', '#e5192c');
update_option('sci1_main_color', '#5990c6');
update_option('sci1_widget_color_one', '#222329');
update_option('sci1_widget_color_text', '#FFFFFF');
update_option('sci1_popular_background_color', '#101010');
update_option('sci1_popular_text_color', '#FFFFFF');
update_option('sci1_popular_read_more_color', '#e5192c');
update_option('sci1_super_slider_color', '#495f7c');
update_option('sci1_super_slider_title', '#FFFFFF');
set_theme_mod('background_color', 'eeeeee');




}elseif (isset($_POST) && !empty($_POST['preset2'])){


update_option('sci1_top_posts_background', '#002b42');
update_option('sci1_top_posts_cat_color', '#a0c4dc');
update_option('sci1_top_posts_title_color', '#FFFFFF'); 
update_option('sci1_menu_background', '#002539');
update_option('sci1_menu_color', '#FFFFFF');
update_option('sci1_menu_hover_color', '#a0c4dc');
update_option('sci1_main_color', '#00334e');
update_option('sci1_hover_color', '#f00');	
update_option('sci1_widget_color_one', '#002539');
update_option('sci1_widget_color_text', '#FFFFFF');
update_option('sci1_popular_background_color', '#00334e');
update_option('sci1_popular_text_color', '#FFFFFF');
update_option('sci1_popular_read_more_color', '#a0c4dc');
update_option('sci1_super_slider_color', '#002539');
update_option('sci1_super_slider_title', '#FFFFFF');
set_theme_mod('background_color', 'eeeeee');


	
}elseif (isset($_POST) && !empty($_POST['preset3'])){


update_option('sci1_top_posts_background', '#494949');
update_option('sci1_top_posts_cat_color', '#d8d8d8');
update_option('sci1_top_posts_title_color', '#FFFFFF'); 
update_option('sci1_menu_background', '#212121');
update_option('sci1_menu_color', '#FFFFFF');
update_option('sci1_menu_hover_color', '#81d742');
update_option('sci1_main_color', '#81d742');
update_option('sci1_widget_color_one', '#212121');
update_option('sci1_widget_color_text', '#FFFFFF');
update_option('sci1_popular_background_color', '#101010');
update_option('sci1_popular_text_color', '#FFFFFF');
update_option('sci1_popular_read_more_color', '#81d742');
update_option('sci1_super_slider_color', '#101010');
update_option('sci1_super_slider_title', '#FFFFFF');
set_theme_mod('background_color', '212121');

}elseif (isset($_POST) && !empty($_POST['preset4'])){


update_option('sci1_top_posts_background', '#293663');
update_option('sci1_top_posts_cat_color', '#d8d8d8');
update_option('sci1_top_posts_title_color', '#FFFFFF'); 
update_option('sci1_menu_background', '#232d53');
update_option('sci1_menu_color', '#FFFFFF');
update_option('sci1_menu_hover_color', '#ff3600');
update_option('sci1_main_color', '#ff3600');
update_option('sci1_widget_color_one', '#232d53');
update_option('sci1_widget_color_text', '#FFFFFF');
update_option('sci1_popular_background_color', '#1a203f');
update_option('sci1_popular_text_color', '#FFFFFF');
update_option('sci1_popular_read_more_color', '#ff3600');
update_option('sci1_super_slider_color', '#101010');
update_option('sci1_super_slider_title', '#FFFFFF');
set_theme_mod('background_color', '1a203f');

}elseif (isset($_POST) && !empty($_POST['preset5'])){

update_option('sci1_top_posts_background', '#f7f7f7');
update_option('sci1_top_posts_cat_color', '#cccccc');
update_option('sci1_top_posts_title_color', '#101010'); 
update_option('sci1_menu_background', '#f7f7f7');
update_option('sci1_menu_color', '#101010');
update_option('sci1_menu_hover_color', '#68bac6');
update_option('sci1_main_color', '#68bac6');
update_option('sci1_widget_color_one', '#222329');
update_option('sci1_widget_color_text', '#FFFFFF');
update_option('sci1_popular_background_color', '#27272f');
update_option('sci1_popular_text_color', '#FFFFFF');
update_option('sci1_popular_read_more_color', '#68bac6');
update_option('sci1_super_slider_color', '#101010');
update_option('sci1_super_slider_title', '#FFFFFF');
set_theme_mod('background_color', 'ffffff');

}elseif (isset($_POST) && !empty($_POST['preset6'])){


update_option('sci1_top_posts_background', '#3a5c90');
update_option('sci1_top_posts_cat_color', '#e0e0e0');
update_option('sci1_top_posts_title_color', '#FFFFFF'); 
update_option('sci1_menu_background', '#3a5c90');
update_option('sci1_menu_color', '#FFFFFF');
update_option('sci1_menu_hover_color', '#d63231');
update_option('sci1_main_color', '#d63231');
update_option('sci1_widget_color_one', '#3a5c90');
update_option('sci1_widget_color_text', '#FFFFFF');
update_option('sci1_popular_background_color', '#2b4368');
update_option('sci1_popular_text_color', '#FFFFFF');
update_option('sci1_popular_read_more_color', '#d63231');
update_option('sci1_super_slider_color', '#2b4368');
update_option('sci1_super_slider_title', '#FFFFFF');
set_theme_mod('background_color', 'ffffff');


}elseif (isset($_POST) && !empty($_POST['preset7'])){

update_option('sci1_top_posts_background', '#393939');
update_option('sci1_top_posts_cat_color', '#e0e0e0');
update_option('sci1_top_posts_title_color', '#FFFFFF'); 
update_option('sci1_menu_background', '#303030');
update_option('sci1_menu_color', '#FFFFFF');
update_option('sci1_menu_hover_color', '#e2a234');
update_option('sci1_main_color', '#e2a234');
update_option('sci1_widget_color_one', '#393939');
update_option('sci1_widget_color_text', '#FFFFFF');
update_option('sci1_popular_background_color', '#101010');
update_option('sci1_popular_text_color', '#FFFFFF');
update_option('sci1_popular_read_more_color', '#e2a234');
update_option('sci1_super_slider_color', '#101010');
update_option('sci1_super_slider_title', '#FFFFFF');
set_theme_mod('background_color', 'ffffff');


}elseif (isset($_POST) && !empty($_POST['preset8'])){

update_option('sci1_top_posts_background', '#101010');
update_option('sci1_top_posts_cat_color', '#d8d8d8');
update_option('sci1_top_posts_title_color', '#FFFFFF'); 
update_option('sci1_menu_background', '#101010');
update_option('sci1_menu_color', '#FFFFFF');
update_option('sci1_menu_hover_color', '#f7b504');
update_option('sci1_main_color', '#000000');
update_option('sci1_widget_color_one', '#352e48');
update_option('sci1_widget_color_text', '#FFFFFF');
update_option('sci1_popular_background_color', '#101010');
update_option('sci1_popular_text_color', '#FFFFFF');
update_option('sci1_popular_read_more_color', '#ffb800');
update_option('sci1_super_slider_color', '#101010');
update_option('sci1_super_slider_title', '#FFFFFF');
set_theme_mod('background_color', 'eeeeee');

}


}

function first_time_activation(){
	$sci1_menu_background = (get_option('sci1_menu_background', null) !== null);
	$sci1_menu_color = (get_option('sci1_menu_color', null) !== null);
	$sci1_fonts = (get_option('sci1_fonts', null) !== null);
	
	
if (empty($sci1_menu_background) && empty($sci1_menu_color ) && empty($sci1_fonts)){
	$bloginfo = get_template_directory_uri();
	update_option('sidebars_widgets', array ('wp_inactive_widgets' => array ( )));



	update_option('sci1_copyright', 'Copyright 2015 Science Magazine Theme. Stepfox Development Studios');
	//logo section
	set_theme_mod('header_image', esc_url($bloginfo).'/images/logo.png');
	set_theme_mod('background_image', '');
	update_option('sci1_facebook_default', esc_url($bloginfo).'/images/sci-mag-facebook.jpg');

	//colors
	update_option('sci1_top_posts_background', '#002b42');
	update_option('sci1_top_posts_cat_color', '#a0c4dc');
	update_option('sci1_top_posts_title_color', '#FFFFFF'); 
	update_option('sci1_menu_background', '#002539');
	update_option('sci1_menu_color', '#FFFFFF');
	update_option('sci1_menu_hover_color', '#a0c4dc');
	update_option('sci1_main_color', '#00334e');
	update_option('sci1_hover_color', '#f00');	
	update_option('sci1_widget_color_one', '#002539');
	update_option('sci1_widget_color_text', '#FFFFFF');
	update_option('sci1_popular_background_color', '#00334e');
	update_option('sci1_popular_text_color', '#FFFFFF');
	update_option('sci1_popular_read_more_color', '#a0c4dc');
	update_option('sci1_super_slider_color', '#002539');
	update_option('sci1_super_slider_title', '#FFFFFF');
	set_theme_mod('background_color', 'eeeeee');
	
	//design
	update_option('sci1_site_width', '1290');
	update_option('sci1_theme-colors-preset_shape', 'linear-theme-colors-preset(45deg');
	update_option('sci1_theme-colors-preset_opacity', '0.5');
	update_option('sci1_slider_picker', 'slider_fx1');
	update_option('sci1_image_effect', 'image_fx5');
	update_option('sci1_fixed_menu', 'show-menu');
	update_option('sci1_widget_fx', 'widgetfx-1');
	

    //typography
    
    update_option('sci1_site_font_size', '10px');
	update_option('sci1_fonts', 'Oswald');
	update_option('sci1_menu_font', 'Oswald');
	update_option('sci1_menu_font_weight', '800');
	update_option('sci1_menu_font_size', '15px');
	update_option('sci1_small_text_font', 'Oswald');
	update_option('sci1_content_font_size', '16');
	update_option('sci1_widget_title_style', 'normal');
	update_option('sci1_widget_font_weight', '700');
	
	

	//header posts
	update_option('sci1_header_posts_cat', 'all');
	update_option('sci1_header_button_show', 'true');
	update_option('sci1_header_button_time', 'forever');
	update_option('sci1_header_button_date_show', 'true');
	update_option('sci1_header_button_category_show', 'true');
	update_option('sci1_header_button_author_show', 'true');


	
	//post page options
	update_option('sci1_uppercase_title', 'uppercase');
	update_option('sci1_first_letter', '');
	update_option('sci1_post_info_author', 'true');	
	update_option('sci1_share_post', 'true');
	update_option('sci1_floating_share_post', 'true');
	update_option('sci1_post_page_views', 'false');
	update_option('sci1_post_tags', 'true');
	update_option('sci1_post_categories', 'true');
	update_option('sci1_author_box', 'true');
	update_option('sci1_show_comments', 'true');
	update_option('sci1_next_prev_links', 'true');
	update_option('sci1_last_widget_sticky', 'stickylastwidget');
	update_option('sci1_related', 'true');
	update_option('sci1_related_choice', 'category');
	
	//category and tv options
	update_option('sci1_category_post_style', 'style_1');
	update_option('sci1_category_big_post', 'true');
	update_option('sci1_category_big_post_style', 'style_1');
	update_option('sci1_category_show_author', 'true');
	update_option('sci1_category_show_date', 'true');
	update_option('sci1_popular_widget', 'true');
	update_option('sci1_popular_post', 'forever');
	update_option('sci1_tv_widget_style', 'one');
	update_option('sci1_category_number', '9');
	update_option('sci1_pagination_style', 'ajax');
	
	//translate
	
	update_option('sci1_search_translate', 'Search');
	update_option('sci1_new_articles_menu_translate', 'new articles');
	update_option('sci1_word_before_author', 'by');
	update_option('sci1_word_load_more', 'Load More');
	update_option('sci1_word_before_category', 'Latest in:');
	update_option('sci1_read_more_translate', 'Read More');
	update_option('sci1_post_tags_title', 'Tags');
	update_option('sci1_post_views_translate', 'Views');
	update_option('sci1_post_category_title', 'Categories');
	update_option('sci1_share_this_article', 'SHARE THIS ARTICLE');
	update_option('sci1_share_this_video', 'SHARE THIS VIDEO');
	update_option('sci1_share_this_gallery', 'SHARE THIS GALLERY');
	update_option('sci1_older_article', 'OLDER ARTICLE');
	update_option('sci1_next_article', 'NEXT ARTICLE');
	update_option('sci1_related_by', 'RELATED BY');
	update_option('sci1_category_popular_title', 'Popular Posts');
	update_option('sci1_tv_carousel_title', 'BROWSE MORE VIDEOS');
	update_option('sci1_gallery_carousel_title', 'BROWSE MORE GALLERIES');
	update_option('sci1_review_page_title', 'Reviews');
	update_option('sci1_review_good_title', 'The Good');
	update_option('sci1_review_bad_title', 'The Bad');
	update_option('sci1_comments_post_comment', 'Post comment');
	update_option('sci1_comments_post_reply', 'Leave a Reply');
	update_option('sci1_comments_post_reply_to', 'Leave a Reply to');
	update_option('sci1_comments_cancel_reply', 'Cancel reply');
	update_option('sci1_comments_logged_in_as', 'Logged in as');
	update_option('sci1_comments_logged_in_as_log_out', 'Log out');
	update_option('sci1_comments_name', 'Name');
	update_option('sci1_comments_email', 'Email');
	update_option('sci1_comments_website', 'Website');
	update_option('sci1_comments_no_comment', 'No Comment');
	update_option('sci1_comments_one_comment', 'One Comment');
	update_option('sci1_comments_number_comments', 'Comments on this post.');
	update_option('sci1_no_match', 'No posts matched your criteria.');


	


	

	//social
	update_option('sci1_facebook', 'stepfoxthemes');
	update_option('sci1_twitter', 'stepfoxthemes');
	update_option('sci1_pinterest', 'stepfoxthemes');
	update_option('sci1_google', 'stepfoxthemes');
	update_option('sci1_youtube', 'stepfoxthemes');
	update_option('sci1_instagram', 'stepfoxthemes');

		}
	}

add_action( 'after_switch_theme', 'first_time_activation' );

?>