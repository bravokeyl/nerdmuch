<?php 
/**
 * Science Magazine top menu posts
**/ 
?>
<?php 
function top_menu_posts(){
$sci1_header_posts_cat = get_option('sci1_header_posts_cat');
	?>
<div class="top-menu-posts">
	<ul>
	<?php $sci1_posts = new WP_Query(array( 'cat'=>$sci1_header_posts_cat, 'posts_per_page' => '3', 'ignore_sticky_posts' => 1 )); while ( $sci1_posts->have_posts()) : $sci1_posts->the_post(); ?>
		<li>				
			<div class="featured-posts-text">
				<span class="category-icon">
				<?php $category = get_the_category(); if($category[0]){echo '<a href="'.esc_url(get_category_link($category[0]->term_id )).'" title="'.esc_attr($category[0]->cat_name).'">'.esc_html($category[0]->cat_name).'</a>';} ?>
				</span>
				<div class="featured-posts-title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php echo wp_trim_words( esc_html(get_the_title()), 10 ); ?>
					</a>
				</div>
				<!--featured-posts-title-->	
			</div>
			<!--featured-posts-text-->
		</li>
		<?php 
		endwhile;
		wp_reset_postdata(); ?>
	</ul>
</div>
<!-- top-menu-posts -->
 <?php }?>