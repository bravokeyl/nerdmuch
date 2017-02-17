<?php   
/* 
Plugin Name: Trending Posts
Description: Trending posts - most popular
Version: 1.0 
Author: Stefan Naumovski 
*/    

add_action( 'widgets_init', 'trending_posts' );

function trending_posts() {register_widget( 'trending_widget_sci1' );}

class trending_widget_sci1 extends WP_Widget {
	
	/* Register widget with WordPress. */
	
	function __construct() {
		parent::__construct(
			'trending_widget_sci1', // Widget ID
			__('Trending posts', 'science-magazine'), // Name
			array( 'description' =>'', ) // Args
			);}
		
		/* Front-end display of widget. */
		
		public function widget( $args, $instance ) {
		/* Default widget settings. */
		
			$defaults = array( 'title' => 'Trending posts', 'number' => 4, 'duration' => 'forever');
			$instance = wp_parse_args( (array) $instance, $defaults );			

			$title = $instance['title'];
			$duration = $instance['duration'];
			$number = $instance['number'];
			
			$args['before_widget'] = str_replace('class="home-widget', 'class="home-widget one-part' , $args['before_widget']);	
			echo $args['before_widget'];
			?>

<div class="trending-posts">


	<?php 			
		if ( ! empty( $title ) )
		echo  '<div class="trending-title-wrap">
					<svg class="trending-icon" viewBox="0 0 100 100" width="35" >
					<g>
						<path d="M54.877,44.304c0-1.211,5.193-17.29-4.914-22.151C38.319,16.549,35.096,12.083,35.197,4.919   c-0.01,0.293-7.042,11.63-2.465,17.233c7.115,8.67,4.109,15.384,0,14.768c-6.9-1.033-6.066-10.038-4.917-12.306   c-3.609-0.383-7.783,1.861-9.852,4.919c-6.208,9.228,7.25,18.054,2.465,24.614c-3.643,4.997-9.862-4.842-9.841-4.919   C3.196,87.8,56.86,88.778,59.812,56.612c0.88-9.646,9.563-14.892,9.839-14.766C60.401,37.572,54.877,44.609,54.877,44.304z    M37.657,71.375c-12.899,0.481-11.579-9.196-9.841-12.303c2.195-3.967,7.759-4.749,4.922-9.849   c0.036,0.072,6.041,0.979,9.841,4.919C48.414,60.17,47.752,71.003,37.657,71.375z M45.043,12.306   c-1.506-1.615-2.464-3.557-2.464-4.924c0-2.561,2.092-5.023,4.924-7.381c0.285,2.053-1.228,5.126,0,7.381   c0.953,1.67,2.465,3.557,2.465,4.924c0,1.831-0.684,3.5-2.465,4.922C47.233,16.544,46.763,14.294,45.043,12.306z"></path>
					</g>
					</svg>
					<div class="trending-title">
						'.esc_html($title).'
					</div>
				</div>';
	?>

<?php 
if( $duration == 'week'){					
	$week = date('W');
		$pop = array(
			'posts_per_page'=> $number,
			'w' => $week,
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'order'    => 'DESC'
			);
			
} elseif ($duration == 'year'){
	$year = date('Y');
		$pop = array(
			'posts_per_page'=> $number,
			'year'     => $year,
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'order'    => 'DESC'
			);	
} elseif($duration == 'month'){	
	$month = date('m');
		$pop = array(
			'posts_per_page'=> $number,
			'monthnum'     => $month,
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'order'    => 'DESC'
			);
}elseif($duration == 'forever'){
		$pop = array(
			'posts_per_page'=> $number,
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'order'    => 'DESC'
			);	
}


$count = 0;

$sci1_posts = new WP_Query($pop); while ( $sci1_posts->have_posts()) : $sci1_posts->the_post();
?>

<?php 	if($count == 0){?>
<div class="img-featured-posts-image">
	<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
	<?php the_post_thumbnail('mediumimagefeatured');if ( 'video' == get_post_format() ): echo '<span class="play-icon"></span>'; endif; ?>
	</a>
	<?php } ?>
	<div class="img-featured-title">
		<div class="img-featured-category-link">
			<?php $category = get_the_category(); if($category[0]){echo '<a href="'.esc_url(get_category_link($category[0]->term_id )).'" title="'.esc_attr($category[0]->cat_name).'">'.esc_html($category[0]->cat_name).'</a>';} ?>
		</div>
		<h2>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<?php the_title(); ?>
			</a>
		</h2>
		<div class="img-featured-text">
			<?php echo excerpt(14); ?>
		</div>
		<!--img-featured-text-->
	</div>
	<!--img-featured-title-->
</div>
<!--img-featured-posts-image-->
	<ul>

<?php } else { ?>
		<li <?php post_class((is_sticky()?'sticky':'')); ?>>
		
			<div class="trending-posts-title">
			<div class="trending-posts-category">
			<?php $category = get_the_category(); if($category[0]){echo '<a href="'.esc_url(get_category_link($category[0]->term_id )).'" title="'.esc_attr($category[0]->cat_name).'">'.esc_html($category[0]->cat_name).'</a>';} ?>
			</div>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_title(); ?>
				</a>
			</div>
			<!--trending-posts-title-->
		</li>
		<?php } $count++; endwhile; ?>
	
	</ul>
</div>


<?php

	/* After widget. */
	
	echo $args['after_widget'];
	}


	/* Widget settings. */


	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
	/* Strip tags. */
		
		$instance['title'] =  $new_instance['title'];
		$instance['duration'] =  $new_instance['duration'];
		$instance['number'] = $new_instance['number'];
		
		return $instance;
	}
	
	
	function form( $instance ) {
		
	/* Default widget settings. */
		
		$defaults = array('title' => 'Trending posts', 'number' => 4, 'duration' => 'forever');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

<!-- Widget Title-->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
		<?php _e('Title:', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_textarea($instance['title']); ?>" style="width:90%;" />
</p>

<!--Duration-->
<p>
	<label for="<?php echo esc_attr($this->get_field_id('duration')); ?>"><?php _e('Popular time:', 'science-magazine'); ?></label>
	<select name="<?php echo esc_attr($this->get_field_name('duration')); ?>" id="<?php echo esc_attr($this->get_field_id('duration')); ?>" class="widefat" >
		<?php $options = array('week', 'month', 'year', 'forever');
		foreach ($options as $option) {?>
		<option value='<?php echo esc_html($option); ?>' <?php if ($option == $instance['duration']) echo 'selected="selected"'; ?>><?php echo esc_html($option); ?></option>
		<?php } ?>
	</select>
</p>

<!-- Number of posts -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>">
		<?php _e('Number of posts to show:', 'science-magazine'); ?>
	</label>
	<input type="number" min="3" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" value="<?php echo esc_attr($instance['number']); ?>" size="3" />
</p>
<?php }} ?>