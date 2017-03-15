<?php
/**
 * Science Magazine post page
**/
?>
<?php get_header();?>
<?php if (have_posts()) : while (have_posts()) : the_post();
$sci1_post_media_size = get_post_meta( get_the_ID(), 'media_size', true); if(empty($sci1_post_media_size)){$sci1_post_media_size = 'normal';}?>

<div id="main" <?php if ($sci1_post_media_size == "fullwidth") {echo 'class="fullwidth-post-image"';}?> >
<?php if ($sci1_post_media_size == "fullwidth") {?>
<div class="fullwidth-image">
	<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {the_post_thumbnail('fullwidthimage');}?>
</div>
<!--fullwidth-image-->
<?php }?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ($sci1_post_media_size == "big") {
        	$mageee = 'slider-four';
		  }elseif($sci1_post_media_size == "normal"){
        	$mageee = 'slider-three';?>
	<div id="primary">
		<?php } ?>
		<?php if ( $sci1_post_media_size != "none" && $sci1_post_media_size != "fullwidth") {

				if ( ! get_post_format() || 'aside' == get_post_format() ): // Standard or Review	
				elseif ( 'gallery' == get_post_format() ): // Gallery
					echo sci1_gallery();
				endif;?>
		<?php } ?>
		<?php if ($sci1_post_media_size == "big" || $sci1_post_media_size == "none" || $sci1_post_media_size == "fullwidth") { ?>
		<div id="primary">
			<?php } ?>
			<div class="post-page-content-wrapper">
				<?php
					$sci1_floating_share_post = get_option('sci1_floating_share_post');
					if ($sci1_floating_share_post == "true") {
						floating_share_icons();
						} ?>
				<div class="title-and-subtitle-wrap <?php if ($sci1_floating_share_post == "false") {echo 'no-floating-icons';}?> ">
						<div id="post-page-title">
							<h1>
								<?php the_title(); ?>
							</h1>
						</div>
						<!--post-page-title-->
						<?php  $sci1_subtitle = get_post_meta(get_the_ID(), 'sci1_sub_title', true); if(empty($sci1_subtitle)) {}  else { echo '<div id="post-page-subtitle">'.esc_html($sci1_subtitle).'</div><!--post-subtitle-->';} ?>

				<?php $sci1_post_info_author = get_option('sci1_post_info_author');
					if ($sci1_post_info_author == "true") { ?>
				<div class="post-info">
					<span class="post-page-date">
					<?php echo esc_html(get_the_date()); ?>
					</span>
					<?php if (get_option('sci1_post_page_views') == 'true'){?>
					<span class="post-page-views">
						<?php echo esc_html(get_views(get_the_ID()));?>
						<?php echo esc_html(get_option('sci1_post_views_translate'));?>
					</span>
					<?php } ?>
					<span class="post-author">
					<?php echo esc_html(get_option('sci1_word_before_author')); ?>
					<?php the_author_posts_link(); ?>
					</span>
				</div>
				<!--post-info-->
				<?php } ?>
				</div>
				<!-- title-and-subtitle -->
				<div id="post-content" class="content <?php echo esc_attr(get_option('sci1_first_letter'));?> <?php if ($sci1_floating_share_post == "false") {echo 'no-floating-icons';}?>">
					<?php the_content();
				  wp_link_pages(array(
    				'before' => '<div class="pagination">' . 'Pages:',
   					 'after' => '</div>'
  					  ));   ?>
				</div>
				<!--post-content-->
				<?php if ( 'aside' == get_post_format() ): // Review
					echo sci1_review();
				endif;?>
				<?php $sci1_tags_title = get_option('sci1_post_tags_title'); $sci1_post_tags = get_option('sci1_post_tags'); if ($sci1_post_tags == 'true') {?>
				<?php the_tags('<div class="post-tags"><div class="tags-title">'.esc_html($sci1_tags_title).'</div><!--tags-title-->', '', '</div><!--post-tags-->');}

		  		$sci1_post_categories = get_option('sci1_post_categories');
		  if ($sci1_post_categories == 'true') {
		  		$output = '';
		 		 $list_categories = get_the_category();
		  		 $sci1_category_title = get_option('sci1_post_category_title');

			  if($list_categories){
				  $output .='<div class="post-categories-wrapper"><div class="post-categories-title">'.esc_html($sci1_category_title).'</div>';
				  foreach($list_categories as $category) {
					  $output .='<span class="blog-post-categories"><a href="'.esc_url(get_category_link( $category->term_id )).'">'.esc_html($category->cat_name).'</a></span>';
				  }
				  $output .='</div><!--post-categories-wrapper-->';
				  echo trim($output);
			 	 }
		 	 }
			  ?>
				<?php post_share_icons();?>
				<?php count_views($post->ID); ?>
				<?php $sci1_nav_links = get_option('sci1_next_prev_links'); if ($sci1_nav_links == "true") { ?>
				<div class="nav-next-prev">
					<?php
                    $prev_post = get_previous_post();
					$next_post = get_next_post();

                    if ( !empty( $prev_post ) ){
                    ?>
					<div class="nav-previous">
						<div class="previous-article">
							<?php $older_article = get_option('sci1_older_article');?>
							<?php previous_post_link ( '%link', $older_article); ?>
						</div>
						<!--previous-article-->
						<div class="previous-title">
							<h2>
								<?php previous_post_link ( '%link', '%title'); ?>
							</h2>
							<div class="post-date">
								<span class="bypostauthor">
								<?php echo esc_html(get_option('sci1_word_before_author')); ?>
								<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID', $prev_post->post_author))); ?>">
								<?php the_author_meta('display_name', $prev_post->post_author); ?>
								</a>
								-
								</span>
								<span class="date-prev">
								<?php echo esc_html(mysql2date('M j, Y', $prev_post->post_date)); ?>
								</span>
							</div>
							<!--post-date-->
						</div>
						<!--previous-title-->
					</div>
					<!--nav-previous-->
					<?php } ?>
					<div class="splitter">
					</div>
					<!--splitter-->
					<?php
                    if ( !empty( $next_post ) ){
                    ?>
					<div class="nav-next">
						<div class="next-article">
							<?php $next_article = get_option('sci1_next_article');?>
							<?php next_post_link ( '%link', esc_html($next_article)); ?>
						</div>
						<!--next-article-->
						<div class="next-title">
							<h2>
								<?php next_post_link( '%link', '%title' ); ?>
							</h2>
							<div class="post-date">
								<span class="bypostauthor">
								<?php echo esc_html(get_option('sci1_word_before_author')); ?>
								<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID', $next_post->post_author))); ?>">
								<?php esc_html(the_author_meta('display_name', $next_post->post_author)); ?>
								</a>
								-
								</span>
								<span class="date-next">
								<?php echo esc_html(mysql2date('M j, Y', $next_post->post_date)); ?>
								</span>
							</div>
							<!--post-date-->
						</div>
						<!--next-title-->
					</div>
					<!--nav-next-->
					<?php } ?>
				</div>
				<!--nav-next-prev-->
				<?php } ?>
				<?php $sci1authorbox = get_option('sci1_author_box'); if ($sci1authorbox == "true") { ?>
				<div id="author-info">
					<div id="author-image">
						<?php echo wp_kses_post(get_avatar( get_the_author_meta('email'), '96' )); ?>
					</div>
					<!--author-image-->
					<div id="author-desc">
						<h2>
							<?php the_author_posts_link(); ?>
						</h2>
						<div class="description-author">
							<?php the_author_meta('description'); ?>
						</div>
						<!--description-author-->
						<ul class="author-social">
							<?php if(get_the_author_meta('facebook')) { ?>
							<li>
								<a href="<?php the_author_meta('facebook'); ?>" class="fb-social-icon" target="_blank">
								</a>
							</li>
							<?php } ?>
							<?php if(get_the_author_meta('twitter')) { ?>
							<li>
								<a href="<?php the_author_meta('twitter'); ?>" class="twitter-social-icon" target="_blank">
								</a>
							</li>
							<?php } ?>
							<?php if(get_the_author_meta('google')) { ?>
							<li>
								<a href="<?php the_author_meta('google'); ?>" class="google-social-icon" target="_blank">
								</a>
							</li>
							<?php } ?>
							<?php if(get_the_author_meta('pinterest')) { ?>
							<li>
								<a href="<?php the_author_meta('pinterest'); ?>" class="pinterest-social-icon" target="_blank">
								</a>
							</li>
							<?php } ?>
							<?php if(get_the_author_meta('instagram')) { ?>
							<li>
								<a href="<?php the_author_meta('instagram'); ?>" class="instagram-social-icon" target="_blank">
								</a>
							</li>
							<?php } ?>
						</ul>
					</div>
					<!--author-desc-->
				</div>
				<!--author-info-->
				<?php } ?>
				<?php if ( !post_password_required() ) { if (comments_open()){ $sci1_show_comments = get_option('sci1_show_comments'); if ($sci1_show_comments == "true") { ?>
				<div class="comments">
					<?php comments_template(); ?>
				</div>
				<!--comments-->
				<?php } }}?>
			</div>
			<!--post-page-contentn-wrapper-->
		</div>
		<!--primary-->

		<div id="secondary" class="widget-area <?php echo esc_html(get_option('sci1_last_widget_sticky'));?>">
			<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Post Sidebar')): endif; ?>
		</div>
		<!--secondary-->
	</div>
	<!--post-->
	<?php $sci1_related = get_option('sci1_related'); if ($sci1_related == "true") { ?>
	<div class="fullwidth">
		<div class="home-widget four-parts">
			<?php if(get_option('sci1_related_by')) { ?>
			<h3>
				<span class="widget-title">
				<?php echo esc_html(get_option('sci1_related_by')); ?>
				</span>
			</h3>
			<?php }

if(get_option('sci1_related_choice')== 'tags'){related_posts_tags();} elseif(get_option('sci1_related_choice')== 'category'){related_posts_category();} elseif(get_option('sci1_related_choice')== 'author'){related_posts_author();}  ?>
		</div>
		<!--home-widget-->
	</div>
	<!--fullwidth-->
	<?php } ?>
	<?php endwhile; endif; ?>
</div>
<!--main-->

<?php get_footer(); ?>
