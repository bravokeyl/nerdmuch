<?php 
/**
 * Science Magazine author
**/ 
?>
<?php get_header();
$sci1_category_post_style = get_option('sci1_category_post_style');
$author_show  = get_option('sci1_category_show_author');
$date_show  = get_option('sci1_category_show_date');
$sci1_category_big_post = get_option('sci1_category_big_post');
?>

<div id="main">
	<div id="primary" class="three-parts archive">
		<?php 
$sci1authorbox = get_option('sci1_author_box'); if ($sci1authorbox == "true") { ?>
		<?php $curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) ); ?>
		<div id="author-info">
			<div id="author-image">
				<?php echo wp_kses_post(get_avatar( $curauth->ID, '150' )); ?>
			</div>
			<!--author-image-->
			<div id="author-desc">
				<h2>
					<?php echo esc_html($curauth->display_name); ?>
				</h2>
				<?php echo esc_html($curauth->description); ?>
				<ul class="author-social">
					<?php if($curauth->facebook) { ?>
					<li>
						<a href="<?php echo esc_url($curauth->facebook); ?>" class="fb-social-icon" target="_blank">
						</a>
					</li>
					<?php } ?>
					<?php if($curauth->twitter) { ?>
					<li>
						<a href="<?php echo esc_url($curauth->twitter); ?>" class="twitter-social-icon" target="_blank">
						</a>
					</li>
					<?php } ?>
					<?php if($curauth->google) { ?>
					<li>
						<a href="<?php echo esc_url($curauth->google); ?>" class="google-social-icon" target="_blank">
						</a>
					</li>
					<?php } ?>
					<?php if($curauth->pinterest) { ?>
					<li>
						<a href="<?php echo esc_url($curauth->pinterest); ?>" class="pinterest-social-icon" target="_blank">
						</a>
					</li>
					<?php } ?>
					<?php if($curauth->instagram) { ?>
					<li>
						<a href="<?php echo esc_url($curauth->instagram); ?>" class="instagram-social-icon" target="_blank">
						</a>
					</li>
					<?php } ?>
				</ul>
			</div>
			<!--author-desc-->
		</div>
		<!--author-info-->
		<?php } ?>
		<div id="blog-list" <?php if ( $sci1_category_post_style == 'style_1' ){echo 'class="blog-category"';}elseif( $sci1_category_post_style == 'style_2' ){echo 'class="blogroll2 blog-category"';}elseif( $sci1_category_post_style == 'style_3' ){echo 'class="img-featured"';}?>>
			<ul>		
			<?php if (have_posts()) : while (have_posts()) : the_post();?>								
				<li>					
				<?php if ( $sci1_category_post_style == 'style_1' ){	
					category_post_style1($author_show, $date_show);	
					}elseif( $sci1_category_post_style == 'style_2' ){
					category_post_style2($author_show, $date_show);
					}elseif( $sci1_category_post_style == 'style_3' ){
					category_post_style3($author_show, $date_show);	
					}?>			
				</li>
				<?php endwhile; else : ?>
					<div class="widget-title"><?php echo esc_html(get_option('sci1_no_match')); ?></div>
				<?php endif;?>
			</ul>
		</div>
	
		<?php $sci1_pagination_style = get_option('sci1_pagination_style');if($sci1_pagination_style =='ajax' || $sci1_pagination_style =='auto-load' ){?>
		<div class="pagination pagination-load-more <?php if($sci1_pagination_style =='auto-load'){echo esc_attr('auto-load');}?>">
			<?php $loadmoreword = get_option('sci1_word_load_more');
			next_posts_link(esc_html($loadmoreword), '' ); ?>
		</div>
		<!--pagination-->
		<?php } else { ?>
		<div class="pagination-simple">
			<?php sci1_pagination(); ?>
		</div>
		<!--pagination-simple-->
		<?php } ?>
	</div>
	<!--primary-->
	<div id="secondary" class="widget-area <?php echo esc_html(get_option('sci1_last_widget_sticky'));?>">
		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Category Sidebar')): endif; ?>
	</div>
	<!--secondary-->
</div>
<!--main-->
<?php get_footer(); ?>