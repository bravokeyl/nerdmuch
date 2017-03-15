<?php get_header(); ?>

<div id="main">
	<div id="tv-mode">
		<?php
	//video wrapper and share buttons
	$id_post = (isset($_POST['id']));
	if ($id_post == ''){
		global $wp_query;
		$postID = $wp_query->post->ID;
		}
		else {
			$postID = $_POST['id'];
		}
		$permalink = get_permalink( $postID );
		$category = get_the_category($postID);
		$the_title = get_the_title($postID);
		$sci1_subtitle = get_post_meta($postID, 'sci1_sub_title', true);
		$sci1_excerpt = 	wp_trim_words( get_post_field('post_excerpt', $postID), 30);
		$sci1_content = 	wp_trim_words( get_post_field('post_content', $postID), 30);

		?>
		<div id="post-page-title" class="tv-format-title">
			<h1>
				<?php echo esc_html($the_title); ?>
			</h1>
		</div>
		<!--tv-format-title-->
		<div id="post-page-subtitle" class="tv-format-subtitle">
			<?php if(empty($sci1_subtitle) && empty($sci1_excerpt)) { echo esc_html($sci1_content); }  elseif (empty($sci1_subtitle) && !empty($sci1_excerpt)) { echo esc_html($sci1_excerpt);} elseif (!empty($sci1_subtitle)) {echo esc_html($sci1_subtitle);}?>
		</div>
		<!--tv-format-subtitle-->
		<div class="tv-video-wrapper">
			<div class="tv-page-video-wrapper">
				<?php sci1_gallery_tax($postID); ?>
			</div>
			<!--tv-page-video-wrapper-->
			<div class="share-tv">
				<div class="share-tv-title">
					<?php echo esc_html(get_option('sci1_share_this_gallery')); ?>
				</div>
				<ul>
					<li>
						<a href="http://www.facebook.com/sharer.php?u=<?php echo esc_html($permalink); ?>" target="blank" class="fb-share-icon" title="<?php _e('Share this post on Facebook', 'science-magazine'); ?>" onclick="window.open(this.href,'window','width=640,height=480,resizable,scrollbars,toolbar,menubar') ;return false;" >
						</a>
					</li>
					<li>
						<a href="https://twitter.com/intent/tweet?original_referer=<?php echo esc_html($permalink); ?>&amp;text=<?php the_title($postID); ?>&amp;tw_p=tweetbutton&amp;url=<?php echo esc_html($permalink); ?>" target="_blank"  class="twitter-share-icon" title="Share this post on Twitter" onclick="window.open(this.href,'window','width=640,height=480,resizable,scrollbars,toolbar,menubar') ;return false;" >
						</a>
					</li>
					<li>
						<a href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php echo esc_html($permalink); ?>" target="_blank" class="google-share-icon" title="<?php _e('Share this post on Google Plus', 'science-magazine'); ?>" onclick="window.open(this.href,'window','width=640,height=480,resizable,scrollbars,toolbar,menubar') ;return false;" >
						</a>
					</li>
					<li>
						<a href="http://pinterest.com/pin/create/bookmarklet/?media=<?php $pinimg = wp_get_attachment_image_src( get_post_thumbnail_id( $postID), 'hugeimagefeatured' ); echo esc_url($pinimg[0]); ?>&amp;url=<?php echo esc_html($permalink); ?>&amp;is_video=false&amp;description=<?php echo urlencode($the_title); ?>" target="_blank" class="pinterest-share-icon" title="<?php _e('Share this post on Pinterest', 'science-magazine'); ?>" onclick="window.open(this.href,'window','width=640,height=480,resizable,scrollbars,toolbar,menubar') ;return false;" >
						</a>
					</li>
					<li>
						<a href="http://www.reddit.com/submit?url=<?php echo esc_html($permalink); ?>&amp;title=<?php echo urlencode($the_title); ?>" target="_blank" class="reddit-share-icon" title="<?php _e('Share this post on Reddit', 'science-magazine'); ?>" onclick="window.open(this.href,'window','width=640,height=480,resizable,scrollbars,toolbar,menubar') ;return false;" >
						</a>
					</li>
				</ul>
				<span class="category-tv-icon">
				<a href="<?php echo esc_url(get_category_link($category[0]->term_id ));?>">
				<?php echo esc_html($category[0]->cat_name);?>
				</a>
				</span>
			</div>
		</div>
		<div class="tv-page-widget home-widget four-parts">
			<h3>
				<span class="widget-title">
				<?php echo esc_html(get_option('sci1_gallery_carousel_title')); ?>
				</span>
			</h3>
			<?php $sci1_tv_widget_style = get_option('sci1_tv_widget_style'); if ($sci1_tv_widget_style == 'one') {  ?>
			<div class="tv-carousel">
				<ul class="slides">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<li>
					<div class="img-featured-posts-image">
						<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
						<a class="ajax" href="<?php the_permalink(); ?>"  data-number="<?php esc_js(the_ID()); ?>" title="<?php the_title(); ?>">
						<?php the_post_thumbnail('mediumimagefeatured'); ?>
						</a>
						<?php } ?>
						<div class="img-featured-title">
							<h2>
							<a class="ajax" href="<?php the_permalink(); ?>"  data-number="<?php esc_js(the_ID()); ?>">
							<?php echo esc_html(get_the_title()); ?>
							</a>
							</h2>
						</div>
					<!--img-featured-title-->
					</div>
					<!---img-featured-posts-image-->
				</li>
					<?php endwhile; endif; ?>
				</ul>
			</div>
			<!--tv-carousel-->
			<?php } elseif($sci1_tv_widget_style == 'two'){?>
			<ul class="featured-thumbnails">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<li>
					<div class="featured-posts-image">
						<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
						<a class="ajax" href="<?php the_permalink(); ?>"  data-number="<?php esc_js(the_ID()); ?>" title="<?php the_title(); ?>">
						<?php the_post_thumbnail('smallthumb'); ?>
						</a>
						<?php } ?>
					</div>
					<!---featured-posts-image-->
					<div class="featured-posts-text">
						<span class="category-icon">
						<?php $category = get_the_category(); if($category[0]){echo '<a href="'.esc_url(get_category_link($category[0]->term_id )).'" title="'.esc_attr($category[0]->cat_name).'">'.esc_html($category[0]->cat_name).'</a>';} ?>
						</span>
						<div class="featured-posts-title">
							<a class="ajax" href="<?php the_permalink(); ?>"  data-number="<?php esc_js(the_ID()); ?>">
							<?php echo wp_trim_words( esc_html(get_the_title()), 10 ); ?>
							</a>
						</div>
						<!--featured-posts-title-->
						<span class="post-date">
						<?php echo esc_html(get_the_date()); ?>
						</span>
					</div>
					<!--featured-posts-text-->
				</li>
				<?php endwhile; endif; ?>
			</ul>
			<div class="pagination pagination-load-more">
				<?php $loadmoreword = get_option('sci1_word_load_more');
			next_posts_link(esc_html($loadmoreword), '' ); ?>
			</div>
			<!--pagination-->
			
			<?php }elseif($sci1_tv_widget_style == 'three'){ ?>
			<ul class="small-category">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<li>
					<div class="small-image">
						<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
						<a class="ajax" href="<?php the_permalink(); ?>"  data-number="<?php esc_js(the_ID()); ?>" title="<?php the_title(); ?>">
						<?php the_post_thumbnail('smallimagefeatured'); ?>
						</a>
						<?php } ?>
					</div>
					<!---small-image-->
					<div class="small-text">
						<div class="small-title">
							<a class="ajax" href="<?php the_permalink(); ?>"  data-number="<?php esc_js(the_ID()); ?>">
							<?php echo wp_trim_words( esc_html(get_the_title()), 7 ); ?>
							</a>
						</div>
						<!--small-title-->
					</div>
					<!--small-text-->
				</li>
				<?php endwhile; endif; ?>
			</ul>
			<div class="pagination pagination-load-more">
				<?php $loadmoreword = get_option('sci1_word_load_more');
			next_posts_link(esc_html($loadmoreword), '' ); ?>
			</div>
			<!--pagination-->
			<?php } ?>
		</div>
		<!--tv-page-widget-->
	</div>
	<!--tv-mode-->
</div>
<!--main-->
<?php get_footer(); ?>