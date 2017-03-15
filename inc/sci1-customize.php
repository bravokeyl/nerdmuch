<?php 
/**
 * Science Magazine customizer
**/ 
?>
<?php 
function sci1_customize( $wp_customize ) {
	//  = Science Magazine: Sections =
	
	$wp_customize->get_section('title_tagline')->title = __('Site Title, Tagline, Footer copyright text & Favorite Icon', 'science-magazine');
	$wp_customize->get_section('title_tagline')->priority = '1';

	$wp_customize->get_section('header_image')->title = __('Logo', 'science-magazine');
	$wp_customize->get_section('header_image')->priority = '2';	
	
	$wp_customize->get_section('colors')->title = __('Colors', 'science-magazine');
	$wp_customize->get_section('colors')->priority = '3';

	$wp_customize->add_section('sci1_design' , array(
			'title' => __('Design', 'science-magazine'),
			'priority' => '4'
	));
	
	$wp_customize->add_section('sci1_typography' , array(
			'title' => __('Typography', 'science-magazine'),
			'priority' => '5'
	));

	$wp_customize->add_section('sci1_header_posts_options' , array(
			'title' => __('Header Posts', 'science-magazine'),
			'priority' => '6'
	));

	$wp_customize->add_section('sci1_post_page_options' , array(
			'title' => __('Post page option', 'science-magazine'),
			'priority' => '7'
	));
	
	$wp_customize->add_section('sci1_category_page_options' , array(
			'title' => __('Category and TV options', 'science-magazine'),
			'priority' => '8'
	));

	$wp_customize->add_section('sci1_translate' , array(
			'title' => __('Translate', 'science-magazine'),
			'priority' => '9'
	));
	
	$wp_customize->add_section('sci1_social' , array(
			'title' => __('Social settings', 'science-magazine'),
			'priority' => '10'
	));


	
	//  = Science Magazine: Colors =
	
	$colors = array();

	$colors[] = array(
			'slug'=>'sci1_top_posts_background',
			'default' => '#FFFFFF',
			'label' => __('Top posts background', 'science-magazine'),
			'section' => 'colors',
			'priority' => '2'
	);

	$colors[] = array(
			'slug'=>'sci1_top_posts_cat_color',
			'default' => '#000000',
			'label' => __('Top posts category color', 'science-magazine'),
			'section' => 'colors',
			'priority' => '2'
	);

	$colors[] = array(
			'slug'=>'sci1_top_posts_title_color',
			'default' => '#000000',
			'label' => __('Top posts title color', 'science-magazine'),
			'section' => 'colors',
			'priority' => '2'
	);

	$colors[] = array(
			'slug'=>'sci1_menu_background',
			'default' => '#FFFFFF',
			'label' => __('Menu background color', 'science-magazine'),
			'section' => 'colors',
			'priority' => '2'
	);

	$colors[] = array(
			'slug'=>'sci1_menu_color',
			'default' => '#000000',
			'label' => __('Menu font color', 'science-magazine'),
			'section' => 'colors',
			'priority' => '3'
	);
	
	$colors[] = array(
			'slug'=>'sci1_menu_hover_color',
			'default' => '#ff6e00',
			'label' => __('Menu hover color', 'science-magazine'),
			'section' => 'colors',
			'priority' => '3'
	);

	$colors[] = array(
			'slug'=>'sci1_main_color',
			'default' => '#ff6e00',
			'label' => __('Main Color', 'science-magazine'),
			'section' => 'colors',
			'priority' => '5'
	);

	$colors[] = array(
			'slug'=>'sci1_hover_color',
			'default' => '#ff6e00',
			'label' => __('Hover Color', 'science-magazine'),
			'section' => 'colors',
			'priority' => '5'
	);

		$colors[] = array(
			'slug'=>'sci1_widget_color_one',
			'default' => '#222329',
			'label' => __('Widget Background 1','science-magazine'), 
			'section' => 'colors',
			'priority' => '5'
	);

		$colors[] = array(
			'slug'=>'sci1_widget_color_text',
			'default' => '#FFFFFF',
			'label' => __('Widget Text Color','science-magazine'), 
			'section' => 'colors',
			'priority' => '5'
	);



	
	$colors[] = array(
			'slug'=>'sci1_super_slider_color',
			'default' => '#ebebeb',
			'label' => __('Super Slider overlay color','science-magazine'), 
			'section' => 'colors',
			'priority' => '4'
	);

	$colors[] = array(
			'slug'=>'sci1_super_slider_title',
			'default' => '#000',
			'label' => __('Super Slider Title color','science-magazine'), 
			'section' => 'colors',
			'priority' => '4'
	);


	$colors[] = array(
			'slug'=>'sci1_popular_background_color',
			'default' => '#F00',
			'label' => __('Category page:popular background color','science-magazine'), 
			'section' => 'colors',
			'priority' => '7'
	);


		$colors[] = array(
			'slug'=>'sci1_popular_text_color',
			'default' => '#F00',
			'label' => __('Category page:popular text color','science-magazine'), 
			'section' => 'colors',
			'priority' => '7'
	);

		$colors[] = array(
			'slug'=>'sci1_popular_read_more_color',
			'default' => '#F00',
			'label' => __('Category page:popular read more color','science-magazine'), 
			'section' => 'colors',
			'priority' => '7'
	);



	foreach( $colors as $color ) {
		$wp_customize->add_setting(
				$color['slug'], array(
						'default' => $color['default'],
						'type' => 'option',
						'capability' =>'edit_theme_options',
						'sanitize_callback' => 'sanitize_hex_color',

				)
		);

		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						$color['slug'],
						array('label' => $color['label'],
								'section' => $color['section'],
								'settings' => $color['slug'],
								'priority' => $color['priority'])
				)
		);
	}
	


		//  = Science Magazine: Images =

		
		$sci1images = array();
		$bloginfo = get_template_directory_uri();

		$sci1images[] = array(
				'slug'=>'sci1_facebook_default',
				'default' => $bloginfo.'/images/sci-mag-facebook.jpg',
				'label' => __('Facebook Homepage image','science-magazine'),
				'priority' => '30'
		);
		
		foreach( $sci1images as $sci1image ) {		
		
		
		$wp_customize->add_setting($sci1image['slug'], array(
				'capability'        => 'edit_theme_options',
				'type'           => 'option',
				'default' => $sci1image['default'],
				'sanitize_callback' => 'sci1_sanitize'
		));
		
		$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, $sci1image['slug'], array(
				'label'    => $sci1image['label'],
				'section'  => 'header_image',
				'settings' => $sci1image['slug'],
				'priority' => $sci1image['priority']
		)));
	
	
	
		}
	
	
		//  = Science Magazine: Text =
		
		
		$sci1text = array();
	
		$sci1text[] = array(
				'slug'=>'sci1_facebook',
				'default' => '',
				'label' => __('Facebook:','science-magazine'), 
				'section' => 'sci1_social',
				'priority' => '1'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_twitter',
				'default' => '',
				'label' => __('Twitter:','science-magazine'),  
				'section' => 'sci1_social',
				'priority' => '2'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_pinterest',
				'default' => '',
				'label' => __('Pinterest:','science-magazine'),  
				'section' => 'sci1_social',
				'priority' => '3'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_google',
				'default' => '',
				'label' => __('Google:', 'science-magazine'), 
				'section' => 'sci1_social',
				'priority' => '4'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_youtube',
				'default' => '',
				'label' => __('Youtube:','science-magazine'), 
				'section' => 'sci1_social',
				'priority' => '5'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_instagram',
				'default' => '',
				'label' => __('Instagram:','science-magazine'),  
				'section' => 'sci1_social',
				'priority' => '6'
		);

		$sci1text[] = array(
				'slug'=>'sci1_search_translate',
				'default' => 'Search',
				'label' => __('Search','science-magazine'), 
				'section' => 'sci1_translate',
				'priority' => '1'
		);

		$sci1text[] = array(
				'slug'=>'sci1_new_articles_menu_translate',
				'default' => 'new articles',
				'label' => __('Menu Button new articles','science-magazine'), 
				'section' => 'sci1_translate',
				'priority' => '1'
		);

		$sci1text[] = array(
				'slug'=>'sci1_word_before_author',
				'default' => 'by',
				'label' => __('Word before author(eg. by, from, posted by)','science-magazine'), 
				'section' => 'sci1_translate',
				'priority' => '1'
		);

		$sci1text[] = array(
				'slug'=>'sci1_word_load_more',
				'default' => 'Load More',
				'label' => __('Load More button','science-magazine'), 
				'section' => 'sci1_translate',
				'priority' => '1'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_word_before_category',
				'default' => 'Latest in:',
				'label' => __('Category page:Word before Category title','science-magazine'), 
				'section' => 'sci1_translate',
				'priority' => '1'
		);

		$sci1text[] = array(
				'slug'=>'sci1_read_more_translate',
				'default' => 'Read More',
				'label' => __('Category page:Popular posts Read More','science-magazine'), 
				'section' => 'sci1_translate',
				'priority' => '1'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_post_tags_title',
				'default' => 'Tags',
				'label' => __('Post page: Tags title','science-magazine'), 
				'section' => 'sci1_translate',
				'priority' => '4'
		);

		$sci1text[] = array(
				'slug'=>'sci1_post_views_translate',
				'default' => 'Views',
				'label' => __('Post page: Views','science-magazine'), 
				'section' => 'sci1_translate',
				'priority' => '4'
		);

		$sci1text[] = array(
				'slug'=>'sci1_post_category_title',
				'default' => 'Categories',
				'label' => __('Post page: Categories title','science-magazine'), 
				'section' => 'sci1_translate',
				'priority' => '4'
		);

		$sci1text[] = array(
				'slug'=>'sci1_share_this_article',
				'default' => 'SHARE THIS ARTICLE',
				'label' => __('Post page: share', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '4'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_share_this_video',
				'default' => 'SHARE THIS VIDEO',
				'label' => __('TV page: share', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '4'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_share_this_gallery',
				'default' => 'SHARE THIS GALLERY',
				'label' => __('Gallery page: share', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '4'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_older_article',
				'default' => 'OLDER ARTICLE',
				'label' => __('Post page: Older article', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '5'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_next_article',
				'default' => 'NEXT ARTICLE',
				'label' => __('Post page: next article', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '6'
		);
		
		
		$sci1text[] = array(
				'slug'=>'sci1_related_by',
				'default' => 'RELATED BY',
				'label' => __('Post page: related widget title', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '7'
		);

		$sci1text[] = array(
				'slug'=>'sci1_category_popular_title',
				'default' => 'Popular Posts',
				'label' => __('Category page: Popular posts widget title', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '7'
		);
	
		$sci1text[] = array(
				'slug'=>'sci1_tv_carousel_title',
				'default' => 'BROWSE MORE VIDEOS',
				'label' => __('Tv title', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '10'
		);

		$sci1text[] = array(
				'slug'=>'sci1_no_match',
				'default' => 'Sorry, no posts matched your criteria.',
				'label' => __('No posts matched your criteria.', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '10'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_gallery_carousel_title',
				'default' => 'BROWSE MORE GALLERIES',
				'label' => __('Gallery title', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '10'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_review_page_title',
				'default' => 'Reviews',
				'label' => __('Reviews title', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '10'
		);

		$sci1text[] = array(
				'slug'=>'sci1_review_good_title',
				'default' => 'The Good',
				'label' => __('Reviews: Good', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '10'
		);

		$sci1text[] = array(
				'slug'=>'sci1_review_bad_title',
				'default' => 'The Bad',
				'label' => __('Reviews: Bad', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '10'
		);		
			
		$sci1text[] = array(
				'slug'=>'sci1_comments_post_comment',
				'default' => 'Post comment',
				'label' => __('Comments: Post comment', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '12'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_comments_post_reply',
				'default' => 'Leave a Reply',
				'label' => __('Comments: Leave a Reply', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '13'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_comments_post_reply_to',
				'default' => 'Leave a Reply to',
				'label' => __('Comments: Leave a Reply to', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '14'
		);
		
		
		$sci1text[] = array(
				'slug'=>'sci1_comments_cancel_reply',
				'default' => 'Cancel reply',
				'label' => __('Comments: Cancel reply', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '15'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_comments_logged_in_as',
				'default' => 'Logged in as',
				'label' => __('Comments: Logged in as', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '15'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_comments_logged_in_as_log_out',
				'default' => 'Log out',
				'label' => __('Comments: Log out', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '15'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_comments_name',
				'default' => 'Name',
				'label' => __('Comments: Name', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '16'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_comments_email',
				'default' => 'Email',
				'label' => __('Comments: Email', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '17'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_comments_website',
				'default' => 'Website',
				'label' => __('Comments: Website', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '18'
		);
				
		$sci1text[] = array(
				'slug'=>'sci1_comments_no_comment',
				'default' => 'No Comment',
				'label' => __('Comments: No Comment', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '19'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_comments_one_comment',
				'default' => 'One Comment',
				'label' => __('Comments: One Comment', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '20'
		);
		
		$sci1text[] = array(
				'slug'=>'sci1_comments_number_comments',
				'default' => 'Comments on this post.',
				'label' => __('Comments: Number of comments on this post.(the line after the number)', 'science-magazine'),
				'section' => 'sci1_translate',
				'priority' => '21'
		);

		
		$sci1text[] = array(
				'slug'=>'sci1_category_number',
				'default' => '9',
				'label' => __('Number of posts to show', 'science-magazine'),
				'section' => 'sci1_category_page_options',
				'priority' => '100'
		);	
		
		$sci1text[] = array(
				'slug'=>'sci1_copyright',
				'default' => 'Copyright 2015 Science Magazine Theme. Stepfox Development Studios',
				'label' => __('Footer copyright text', 'science-magazine'),
				'section' => 'title_tagline',
				'priority' => '10'
		);
	
		foreach( $sci1text as $sci1_text ) {
			
			
			$wp_customize->add_setting($sci1_text['slug'], array(
					'default'        => $sci1_text['default'],
					'capability'     => 'edit_theme_options',
					'type'           => 'option',
					'sanitize_callback' => 'sci1_sanitize'
			
			));
			
			$wp_customize->add_control($sci1_text['slug'], array(
					'label'      => $sci1_text['label'],
					'section'    => $sci1_text['section'],
					'settings'   => $sci1_text['slug'],
					'priority'   => $sci1_text['priority'],
			));
					
		}
		
		
		
		
		
		
		
		//  = Science Magazine: Dropdown =
		
		$sci1_tags = array();
		
		$sci1_tags_obj = get_categories('hide_empty=0');
		
		foreach ($sci1_tags_obj as $sci1_tag) {
		
			$sci1_tags[$sci1_tag->term_id] = $sci1_tag->slug;
		}
		 $sci1_tags = array('all' => 'Latest') + $sci1_tags;


			
			
			$fonts_list = array(
				'Asap' => 'Asap',
				'Asul' => 'Asul',		
				'Bitter' => 'Bitter',
				'Caudex' => 'Caudex',
				'Droid Sans' => 'Droid Sans',
				'Droid Serif' => 'Droid Serif',
				'Electrolize' => 'Electrolize',
				'Hanuman' => 'Hanuman',
				'Jura' => 'Jura',
				'Kameron' => 'Kameron',
				'Kotta One' => 'Kotta One',
				'Lato' => 'Lato',
				'Lora' => 'Lora',
				'Magra' => 'Magra',
				'Maven Pro' => 'Maven Pro',
				'Metrophobic' => 'Metrophobic',
				'Molengo' => 'Molengo',
				'Montserrat' => 'Montserrat',
				'Open Sans' => 'Open Sans',
				'PT Sans' => 'PT Sans',
				'PT Serif' => 'PT Serif',
				'Play' => 'Play',
				'Podkova' => 'Podkova',
				'Pontano Sans' => 'Pontano Sans',
				'Quattrocento Sans' => 'Quattrocento Sans',
				'Raleway' => 'Raleway',
				'Rosario' => 'Rosario',
				'Shanti' => 'Shanti',
				'Share' => 'Share',
				'Signika' => 'Signika',
				'Telex' => 'Telex',
				'Tinos' => 'Tinos',
				'Ubuntu' => 'Ubuntu',
				'Vidaloka' => 'Vidaloka',
				'Oswald' => 'Oswald',
				'Coda' => 'Coda',
				'Passion One' => 'Passion One',	
				'Squada One' => 'Squada One',					
				'Viga' => 'Viga',
				'Akashi' => 'Akashi',
				'blowbrush' => 'blowbrush',
				'alpha_echo' => 'Alpha Echo'							
			);
					
			$sci1_dropdowns = array();


			$sci1_dropdowns[] = array(
					'slug'=>'sci1_header_posts_cat',
					'default' => 'all',
					'label' => __('Header small posts category:', 'science-magazine'),
					'section' => 'sci1_header_posts_options',
					'choices' => $sci1_tags,
			);	


			$sci1_dropdowns[] = array(
					'slug'=>'sci1_header_button_show',
					'default' => 'true',
					'label' => __('Header middle menu open on click:', 'science-magazine'),
					'section' => 'sci1_header_posts_options',
					'choices'    => array(
							'true' => 'Show',
							'false' => 'Hide',
					));	

			$sci1_dropdowns[] = array(
					'slug'=>'sci1_header_button_time',
					'default' => 'forever',
					'label' => __('Header button posts time', 'science-magazine'),
					'section' => 'sci1_header_posts_options',
					'choices'    => array(
							'week' => 'week',
							'month' => 'month',
							'year' => 'year',
							'forever' => 'forever',
			
					));	
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_header_button_date_show',
					'default' => 'true',
					'label' => __('Header button date show/hide', 'science-magazine'),
					'section' => 'sci1_header_posts_options',
					'choices'    => array(
							'true' => 'Show',
							'false' => 'Hide',
					));

			$sci1_dropdowns[] = array(
					'slug'=>'sci1_header_button_category_show',
					'default' => 'true',
					'label' => __('Header button category show/hide', 'science-magazine'),
					'section' => 'sci1_header_posts_options',
					'choices'    => array(
							'true' => 'Show',
							'false' => 'Hide',
					));

			$sci1_dropdowns[] = array(
					'slug'=>'sci1_header_button_author_show',
					'default' => 'true',
					'label' => __('Header button author show/hide', 'science-magazine'),
					'section' => 'sci1_header_posts_options',
					'choices'    => array(
							'true' => 'Show',
							'false' => 'Hide',
					));		

					
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_site_width',
					'default' => '1290',
					'label' => __('Body width:(if you play with this option dont forget to reupload or regenerate your images so the new sizes can take full effect!!!important!!!!!) ', 'science-magazine'),
					'section' => 'sci1_design',
					'choices'    => array(
							'1290' => '1290px',
							'1596' => '1596px',
							'1903' => '1903px',
				
					));
	
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_wait_till_loaded',
					'default' => 'true',
					'label' => __('Wait till images loaded:', 'science-magazine'),
					'section' => 'sci1_design',
					'choices'    => array(
							'true' => 'Wait',
							'false' => 'Dont Wait',
		
					));	


			$sci1_dropdowns[] = array(
					'slug'=>'sci1_slider_picker',
					'default' => 'slider_fx2',
					'label' => __('Slider transition', 'science-magazine'),
					'section' => 'sci1_design',
					'choices'    => array(
							'slider_fx1' => 'Slide',
							'slider_fx2' => 'Fade',
							'slider_fx3' => 'Pop',
							'slider_fx4' => 'Move up',
							'slider_fx5' => 'Drop in',
							'slider_fx6' => 'Rise from bottom',
							'slider_fx7' => 'Clapper',
							'slider_fx8' => 'Zoom',
							'slider_fx9' => 'Black and white',							
					));
					
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_image_effect',
					'default' => 'image_fx1',
					'label' => __('Image Effect:', 'science-magazine'),
					'section' => 'sci1_design',
					'choices'    => array(
							'' => 'None',
							'image_fx1' => 'Fast Shine',
							'image_fx2' => 'Zoom in',
							'image_fx3' => 'Border Line',
							'image_fx4' => 'Black and white',
							'image_fx5' => 'Opacity',					
					));
							
										
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_fixed_menu',
					'default' => 'show-menu',
					'label' => __('Menu follow with scroll', 'science-magazine'),
					'section' => 'sci1_design',
					'choices'    => array(
							'show-menu' => 'Show',
							'' => 'Hide',
		
					));
	
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_site_font_size',
					'default' => '10px',
					'label' => __('Site Font Size', 'science-magazine'),
					'section' => 'sci1_typography',
					'choices'    => array(
							'8px' => '8px',
							'9px' => '9px',
							'10px' =>'10px',
							'11px' =>'11px',
							'12px' =>'12px',
							'13px' =>'13px',
							'14px' =>'14px',
							'15px' =>'15px',

			));

			$sci1_dropdowns[] = array(
					'slug'=>'sci1_fonts',
					'default' => 'Open Sans',
					'label' => __('Main Font', 'science-magazine'),
					'section' => 'sci1_typography',
					'choices'    => $fonts_list
	
					);
			
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_menu_font',
					'default' => 'Open Sans',
					'label' => __('Menu Font', 'science-magazine'),
					'section' => 'sci1_typography',
					'choices'    => $fonts_list
			
			);
			
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_menu_font_weight',
					'default' => '400',
					'label' => __('Menu Font Weight', 'science-magazine'),
					'section' => 'sci1_typography',
					'choices'    => array(
							'400' => 'Regular',
							'600' => 'Semi-bold',
							'700' => 'Bold',
							'800' => 'Extra Bold',
			));

			$sci1_dropdowns[] = array(
					'slug'=>'sci1_menu_font_size',
					'default' => '16px',
					'label' => __('Menu Font Size', 'science-magazine'),
					'section' => 'sci1_typography',
					'choices'    => array(
							'13px' => '13px',
							'14px' => '14px',
							'15px' => '15px',
							'16px' => '16px',
							'17px' => '17px',
							'18px' => '18px',
							'19px' => '19px',
							'20px' => '20px',
			));
			
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_small_text_font',
					'default' => 'Open Sans',
					'label' => __('Small text font', 'science-magazine'),
					'section' => 'sci1_typography',
					'choices'    => $fonts_list
			
			);

			$sci1_dropdowns[] = array(
					'slug'=>'sci1_widget_title_style',
					'default' => '',
					'label' => __('Featured Title Style', 'science-magazine'),
					'section' => 'sci1_typography',
					'choices'    => array(
							'italic' => 'Italic',
							'normal' => 'Normal',		
					));

			$sci1_dropdowns[] = array(
					'slug'=>'sci1_widget_font_weight',
					'default' => '700',
					'label' => __('Widget Title Font Weight', 'science-magazine'),
					'section' => 'sci1_typography',
					'choices'    => array(
							'400' => 'Regular',
							'600' => 'Semi-bold',
							'700' => 'Bold',
							'800' => 'Extra Bold',
			));


						
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_widget_fx',
					'default' => 'widgetfx-1',
					'label' => __('Widget load effect', 'science-magazine'),
					'section' => 'sci1_design',
					'choices'    => array(
							'nowidgetfx' => 'no effect',
							'widgetfx-1' => 'Fade in',
							'widgetfx-2' => 'Move up',
							'widgetfx-3' => 'Scale up',
							'widgetfx-4' => 'Rubber band',
							'widgetfx-5' => 'Bounce up',
							'widgetfx-6' => 'Pulse',
							'widgetfx-7' => 'Fade in up',
							'widgetfx-8' => 'Pop up',
							'widgetfx-9' => 'Bounce',
		
					));	


			$sci1_dropdowns[] = array(
					'slug'=>'sci1_uppercase_title',
					'default' => 'uppercase',
					'label' => __('Title Uppercase', 'science-magazine'),
					'section' => 'sci1_post_page_options',
					'choices'    => array(
							'uppercase' => 'On',
							'none' => 'Off',	
					));	

			$sci1_dropdowns[] = array(
					'slug'=>'sci1_first_letter',
					'default' => '',
					'label' => __('First Letter', 'science-magazine'),
					'section' => 'sci1_post_page_options',
					'choices'    => array(
							'first-letter' => 'On',
							'' => 'Off',	
					));	
									
											
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_content_font_size',
					'default' => '13',
					'label' => __('Post: Content font size', 'science-magazine'),
					'section' => 'sci1_typography',
					'choices'    => array(
							'12' => '12px',
							'13' => '13px',
							'14' => '14px',
							'15' => '15px',
							'16' => '16px',
							'17' => '17px',
							'18' => '18px',

		
					));	

			$sci1_dropdowns[] = array(
					'slug'=>'sci1_share_post',
					'default' => 'true',
					'label' => __('Share buttons', 'science-magazine'),
					'section' => 'sci1_post_page_options',
					'choices'    => array(
							'true' => 'Show',
							'false' => 'Hide',
		
					));	

			$sci1_dropdowns[] = array(
					'slug'=>'sci1_post_info_author',
					'default' => 'true',
					'label' => __('Author and Date', 'science-magazine'),
					'section' => 'sci1_post_page_options',
					'choices'    => array(
							'true' => 'Show',
							'false' => 'Hide',
		
					));	

			$sci1_dropdowns[] = array(
					'slug'=>'sci1_post_page_views',
					'default' => 'false',
					'label' => __('Display Pageviews:', 'science-magazine'),
					'section' => 'sci1_post_page_options',
					'choices'    => array(
							'true' => 'Show',
							'false' => 'Hide',
		
					));

			$sci1_dropdowns[] = array(
					'slug'=>'sci1_floating_share_post',
					'default' => 'true',
					'label' => __('Floating Share buttons', 'science-magazine'),
					'section' => 'sci1_post_page_options',
					'choices'    => array(
							'true' => 'Show',
							'false' => 'Hide',
		
					));		
			
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_post_tags',
					'default' => 'true',
					'label' => __('Post tags', 'science-magazine'),
					'section' => 'sci1_post_page_options',
					'choices'    => array(
							'true' => 'Show',
							'false' => 'Hide',
		
					));	
					
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_post_categories',
					'default' => 'true',
					'label' => __('Post categories', 'science-magazine'),
					'section' => 'sci1_post_page_options',
					'choices'    => array(
							'true' => 'Show',
							'false' => 'Hide',
		
					));			
	
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_author_box',
					'default' => 'true',
					'label' => __('Author-box', 'science-magazine'),
					'section' => 'sci1_post_page_options',
					'choices'    => array(
							'true' => 'Show',
							'false' => 'Hide',
		
					));
			
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_show_comments',
					'default' => 'true',
					'label' => __('Comments', 'science-magazine'),
					'section' => 'sci1_post_page_options',
					'choices'    => array(
							'true' => 'Show',
							'false' => 'Hide',
			
					));
					
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_next_prev_links',
					'default' => 'true',
					'label' => __('Navigation Links', 'science-magazine'),
					'section' => 'sci1_post_page_options',
					'choices'    => array(
							'true' => 'Show',
							'false' => 'Hide',
			
					));	

			$sci1_dropdowns[] = array(
					'slug'=>'sci1_last_widget_sticky',
					'default' => 'stickylastwidget',
					'label' => __('Last Widget Sticky follow', 'science-magazine'),
					'section' => 'sci1_post_page_options',
					'choices'    => array(
							'stickylastwidget' => 'On',
							'' => 'Off',
			
					));					
			
		
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_related',
					'default' => 'true',
					'label' => __('Related Posts', 'science-magazine'),
					'section' => 'sci1_post_page_options',
					'choices'    => array(
							'true' => 'Show',
							'false' => 'Hide',
			
					));
									
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_related_choice',
					'default' => 'tags',
					'label' => __('Chose related posts', 'science-magazine'),
					'section' => 'sci1_post_page_options',
					'choices'    => array(
							'tags' => 'Tags',
							'category' => 'Category',
							'author' => 'Author',
			
					));					

			$sci1_dropdowns[] = array(
					'slug'=>'sci1_category_post_style',
					'default' => 'style_1',
					'label' => __('Category post style', 'science-magazine'),
					'section' => 'sci1_category_page_options',
					'choices'    => array(
							'style_1' => 'Style 1',
							'style_2' => 'Style 2',
							'style_3' => 'Style 3',
			
					));
					
	

			$sci1_dropdowns[] = array(
					'slug'=>'sci1_category_show_author',
					'default' => 'true',
					'label' => __('Category show author', 'science-magazine'),
					'section' => 'sci1_category_page_options',
					'choices'    => array(
							'true' => 'Show',
							'false' => 'Hide',
			
					));	
					
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_category_show_date',
					'default' => 'true',
					'label' => __('Category show date', 'science-magazine'),
					'section' => 'sci1_category_page_options',
					'choices'    => array(
							'true' => 'Show',
							'false' => 'Hide',
			
					));		
			
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_popular_widget',
					'default' => 'true',
					'label' => __('Popular Posts', 'science-magazine'),
					'section' => 'sci1_category_page_options',
					'choices'    => array(
							'true' => 'Show',
							'false' => 'Hide',
			
					));
										
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_popular_post',
					'default' => 'forever',
					'label' => __('Popular Posts Time', 'science-magazine'),
					'section' => 'sci1_category_page_options',
					'choices'    => array(
							'week' => 'week',
							'month' => 'month',
							'year' => 'year',
							'forever' => 'forever',
			
					));	
					
			$sci1_dropdowns[] = array(
					'slug'=>'sci1_tv_widget_style',
					'default' => 'one',
					'label' => __('TV-Widget-Style', 'science-magazine'),
					'section' => 'sci1_category_page_options',
					'choices'    => array(
							'one' => 'Style 1',
							'two' => 'Style 2',
							'three' => 'Style 3',		
					));	

			$sci1_dropdowns[] = array(
					'slug'=>'sci1_pagination_style',
					'default' => 'ajax',
					'label' => __('Pagination', 'science-magazine'),
					'section' => 'sci1_category_page_options',
					'choices'    => array(
							'ajax' => 'Ajax Load More',
							'normal' => 'Normal Pagination',
							'auto-load'=>'Ajax Auto Load on scroll',	
					));	
								
			foreach( $sci1_dropdowns as $sci1_dropdown ) {
					
					
				$wp_customize->add_setting($sci1_dropdown['slug'], array(
						'default'        => $sci1_dropdown['default'],
						'capability'     => 'edit_theme_options',
						'type'           => 'option',
						'sanitize_callback' => 'sci1_sanitize'
							
				));
					
				$wp_customize->add_control($sci1_dropdown['slug'], array(
						'label'      => $sci1_dropdown['label'],
						'section'    => $sci1_dropdown['section'],
						'settings'   => $sci1_dropdown['slug'],
						'choices' => $sci1_dropdown['choices'],
						'type'    => 'select',
				));
					
			}


		
function sci1_sanitize($input) {return esc_html($input);}

}

add_action( 'customize_register', 'sci1_customize' );







function sf_adjust_customizer_responsive_sizes() {

    $mobile_margin_left = '-240px'; 
    $mobile_width = '480px';
    $mobile_height = '720px';

    $mobile_landscape_width = '720px';
    $mobile_landscape_height = '480px';

    $tablet_width = '768px';
    $tablet_height = '1023px';

    $tablet_landscape_width = '1023px';
    $tablet_landscape_height = '768px';

    ?>
    <style>
        .wp-customizer .preview-mobile .wp-full-overlay-main {
            margin-left: <?php echo esc_html($mobile_margin_left); ?>;
            width: <?php echo esc_html($mobile_width); ?>;
            height: <?php echo esc_html($mobile_height); ?>;
        }

        .wp-customizer .preview-mobile-landscape .wp-full-overlay-main {

            width: <?php echo esc_html($mobile_landscape_width); ?>;
            height: <?php echo esc_html($mobile_landscape_height); ?>;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .wp-customizer .preview-tablet .wp-full-overlay-main {

            width: <?php echo esc_html($tablet_width); ?>;
            height: <?php echo esc_html($tablet_height); ?>;
        }

        .wp-customizer .preview-tablet-landscape .wp-full-overlay-main {

            width: <?php echo esc_html($tablet_landscape_width); ?>;
            height: <?php echo esc_html($tablet_landscape_height); ?>;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .wp-full-overlay-footer .devices .preview-tablet-landscape:before {
            content: "\f167";
        }

        .wp-full-overlay-footer .devices .preview-mobile-landscape:before {
            content: "\f167";
        }
    </style>
    <?php

}

add_action( 'customize_controls_print_styles', 'sf_adjust_customizer_responsive_sizes' );
function sf_filter_customize_previewable_devices( $devices )
{
    $custom_devices[ 'desktop' ] = $devices[ 'desktop' ];
    $custom_devices[ 'tablet' ] = $devices[ 'tablet' ];
    $custom_devices[ 'tablet-landscape' ] = array (
            'label' => __( 'Enter tablet landscape preview mode', 'science-magazine' ), 'default' => false,
    );
    $custom_devices[ 'mobile' ] = $devices[ 'mobile' ];
    $custom_devices[ 'mobile-landscape' ] = array (
            'label' => __( 'Enter mobile landscape preview mode', 'science-magazine' ), 'default' => false,
    );

    foreach ( $devices as $device => $settings ) {
        if ( ! isset( $custom_devices[ $device ] ) ) {
            $custom_devices[ $device ] = $settings;
        }
    }

    return $custom_devices;
}

add_filter( 'customize_previewable_devices', 'sf_filter_customize_previewable_devices' );
?>