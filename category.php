<?php 
/**
 * Science Magazine category page
**/ 
?>
<?php get_header();
$sci1_category_post_style = get_option('sci1_category_post_style');
$author_show  = get_option('sci1_category_show_author');
$date_show  = get_option('sci1_category_show_date');

?>

	<?php $sci1_popular_widget = get_option('sci1_popular_widget'); if ($sci1_popular_widget == "true") { ?>
	<div class="fullwidth popular-part">
		<div class="home-widget four-parts">
			<?php sci1_popular_posts();?>
		</div>
		<!--home-widget four-parts-->
	</div>
	<!--fullwidth-->
	<?php } ?>


<div id="main">
	<div id="primary" class="three-parts archive">
		<?php if ($sci1_popular_widget != "true") {?>
		<div class="widget-title">
			<h1>
				<?php echo esc_html(get_option('sci1_word_before_category')); ?>
				<?php single_cat_title(); ?>
			</h1>
		</div>
		<!--widget-title-->
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