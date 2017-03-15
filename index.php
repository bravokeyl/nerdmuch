<?php 
/**
 * Science Magazine main
**/ 
?>
<?php get_header();
$sci1_category_post_style = get_option('sci1_category_post_style');
$author_show  = get_option('sci1_category_show_author');
$date_show  = get_option('sci1_category_show_date');
?>
<div id="main">
	<div id="primary" class="three-parts archive">
		<div id="blog-list" <?php if ( $sci1_category_post_style == 'style_1' ){echo 'class="blog-category"';}elseif( $sci1_category_post_style == 'style_2' ){echo 'class="blogroll2 blog-category"';}elseif( $sci1_category_post_style == 'style_3' ){echo 'class="img-featured"';}?>>
			<ul>		
			<?php if (have_posts()) : while (have_posts()) : the_post();?>								
				<li <?php post_class((is_sticky()?'sticky':'')); ?>>					
				<?php if ( $sci1_category_post_style == 'style_1' ){	
					category_post_style1($author_show, $date_show);	
					}elseif( $sci1_category_post_style == 'style_2' ){
					category_post_style2($author_show, $date_show);
					}elseif( $sci1_category_post_style == 'style_3' ){
					category_post_style3($author_show, $date_show);	
					}?>			
				</li>
				<?php endwhile; endif;?>
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