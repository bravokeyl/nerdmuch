<?php
/**
 * Science Magazine related posts functions
**/
?>
<?php
function related_posts_tags() {
		wp_reset_postdata();
	//related posts by tags
		global $post;
		$tags = wp_get_post_tags($post->ID);

			if ($tags) {
				$tag_ids = array();
				foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
					 $sci1_posts = new WP_Query(array('tag__in' => $tag_ids, 'post__not_in' => array($post->ID), 'posts_per_page'=> 4, 'ignore_sticky_posts' => 1));?>

<div class="blog-category">
	<ul>

<?php  while ( $sci1_posts->have_posts()) : $sci1_posts->the_post();?>
		<li>
			<div class="blog-post-image">
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('smallimagefeatured'); ?>
				</a>
				<?php } ?>
			</div>
			<!--blog-post-image-->
			<div class="category-icon">
				<?php $category = get_the_category(); if($category[0]){echo '<a href="'.esc_url(get_category_link($category[0]->term_id )).'" title="'.esc_attr($category[0]->cat_name).'">'.esc_html($category[0]->cat_name).'</a>';} ?>
			</div>
			<!--featured-category-->
			<div class="blog-post-title-box">
				<div class="blog-post-title">
					<h2>
						<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
						</a>
					</h2>
				</div>
				<!--blog-post-title-->
			</div>
			<!--blog-post-title-box-->
			<div class="blog-post-content">
				<?php echo excerpt(30); ?>
			</div>
			<!--blog-post-content-->
		</li>
<?php endwhile;wp_reset_postdata(); ?>
</ul>
</div>
<?php }}

function related_posts_category() {
				wp_reset_postdata();
			//related posts by category
				global $post;
				$categories = get_the_category($post->ID);

					if ($categories) {
					$category_ids = array();
					foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
					 $sci1_rel_posts = new WP_Query(array('category__in' => $category_ids, 'post__not_in' => array($post->ID), 'posts_per_page'=> 4, 'ignore_sticky_posts' => 1));?>
<div class="blog-category">
	<ul>
<?php  while ( $sci1_rel_posts->have_posts()) : $sci1_rel_posts->the_post();?>
		<li>
			<div class="blog-post-image">
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('smallimagefeatured'); ?>
				</a>
				<?php } ?>
			</div>
			<!--blog-post-image-->
			<div class="category-icon">
				<?php $category = get_the_category(); if($category[0]){echo '<a href="'.esc_url(get_category_link($category[0]->term_id )).'" title="'.esc_attr($category[0]->cat_name).'">'.esc_html($category[0]->cat_name).'</a>';} ?>
			</div>
			<!--featured-category-->
			<div class="blog-post-title-box">
				<div class="blog-post-title">
					<h2>
						<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
						</a>
					</h2>
				</div>
				<!--blog-post-title-->
			</div>
			<!--blog-post-title-box-->
			<div class="blog-post-content">
				<?php echo excerpt(30); ?>
			</div>
			<!--blog-post-content-->
		</li><?php endwhile;wp_reset_postdata(); ?>
</ul>
</div>
<?php }}

function related_posts_author() {
				wp_reset_postdata();
//related posts by author
				global $post;
				$author = get_the_author_meta('ID');
				$sci1_posts = new WP_Query(array('author' => $author, 'post__not_in' => array( $post->ID ), 'posts_per_page' => 4));?>
<div class="blog-category">
	<ul>
<?php  while ( $sci1_posts->have_posts()) : $sci1_posts->the_post();?>

		<li>
			<div class="blog-post-image">
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('smallimagefeatured'); ?>
				</a>
				<?php } ?>
			</div>
			<!--blog-post-image-->
			<div class="category-icon">
				<?php $category = get_the_category(); if($category[0]){echo '<a href="'.esc_url(get_category_link($category[0]->term_id )).'" title="'.esc_attr($category[0]->cat_name).'">'.esc_html($category[0]->cat_name).'</a>';} ?>
			</div>
			<!--featured-category-->
			<div class="blog-post-title-box">
				<div class="blog-post-title">
					<h2>
						<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
						</a>
					</h2>
				</div>
				<!--blog-post-title-->
			</div>
			<!--blog-post-title-box-->
			<div class="blog-post-content">
				<?php echo excerpt(30); ?>
			</div>
			<!--blog-post-content-->
		</li>
<?php endwhile;wp_reset_postdata(); ?>
</ul>
</div>
<?php }

function sci1_popular_posts() {

$popular_post = get_option('sci1_popular_post');
$category = get_category( get_query_var( 'cat' ) );
$pop_cat = $category->cat_ID;

if( $popular_post == 'week'){


	  $week = date('W');
		$year = date('Y');
		$args = array(
			'cat'      => $pop_cat,
			'posts_per_page'=> '4',
			'w' => $week,
			'year'=> $year,
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'order'    => 'DESC'
			);

} elseif ($popular_post == 'year'){

	$year = date('Y');
		$args = array(
			'cat'      => $pop_cat,
			'posts_per_page'=> '4',
			'year'     => $year,
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'order'    => 'DESC'
			);
} elseif($popular_post == 'month'){

	$month = date('m');
		$args = array(
			'cat'      => $pop_cat,
			'posts_per_page'=> '4',
			'monthnum'     => $month,
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'order'    => 'DESC'
			);
}elseif($popular_post == 'forever'){

		$args = array(
			'cat'      => $pop_cat,
			'posts_per_page'=> '4',
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'order'    => 'DESC'
			);
}


$popular_posts = new WP_Query($args); if($popular_posts->have_posts()):?>


<div class="widget-title">
	<h1>
		<?php single_cat_title(); ?>
	</h1>
</div>
<!-- category-popular-title -->
<?php if(get_option('sci1_category_popular_title')) { ?>
<h3>
	<span class="widget-title">
	<?php echo esc_html(get_option('sci1_category_popular_title')); ?>
	</span>
</h3>
<?php } ?>

<div class="popular-slider-container">
	<div class="popular-slider <?php echo esc_attr(get_option('sci1_slider_picker'));?>">
		<ul class="slides">

			<?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
			<li>
				<?php the_post_thumbnail('slider-three');?>
			</li>
			<?php endwhile;wp_reset_postdata(); ?>
		</ul>
	</div>
	<!--flexslider-->
</div>
<!--slider-container-->

<div class="blog-category popular-slider-control">
	<ul>
		<?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
		<li>
			<div class="blog-post-image">
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('smallimagefeatured'); ?>
				</a>
				<?php } ?>
			</div>
			<!--blog-post-image-->
			<div class="blog-post-title-box">
				<div class="blog-post-title">
					<h2>
						<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
						</a>
					</h2>
				</div>
				<!--blog-post-title-->
				<span class="read-more">
					<a href="<?php the_permalink(); ?>">
						<?php echo esc_html(get_option('sci1_read_more_translate')); ?>
					</a>
				</span>
			</div>
			<!--blog-post-title-box-->
		</li>
		<?php endwhile; ?>
	</ul>
</div>
<?php endif;}
?>
