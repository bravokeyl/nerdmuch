<?php 
/* 
Plugin Name: Ticker Widget 
Description: Ticker posts widget.
Version: 1.0 
Author: Stefan Naumovski 
*/    

add_action( 'widgets_init', 'ticker_posts_widget' );

function ticker_posts_widget() {register_widget( 'ticker_widget_sci1' );}

class ticker_widget_sci1 extends WP_Widget {
	
	/* Register widget with WordPress. */
	
	function __construct() {
		parent::__construct(
			'ticker_widget_sci1', // Widget ID
			__('Ticker', 'science-magazine'), // Name
			array( 'description' => '', ) // Args
			);}
	
		/* Front-end display of widget. */
		
		public function widget( $args, $instance ) {
		/* Default widget settings. */
		
			$defaults = array( 'title' => 'Breaking News', 'number' => 10, 'widget_size' => 'body-width-ticker', 'categories' => 0, 'sign_before_link' => '+', 'duration' => 'forever', 'post_type_pop' => 'latest');
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			$title = $instance['title'];
			$number = $instance['number'];
			$categories = $instance['categories'];
			$widget_size = $instance['widget_size'];
			$sign_before_link = $instance['sign_before_link'];
			$duration = $instance['duration'];
			$post_type_pop = $instance['post_type_pop'];
			
			
			$args['before_widget'] = str_replace('class="home-widget', 'class="home-widget '. esc_attr($widget_size) , $args['before_widget']);	
			echo $args ['before_widget'];
				?>

<div class="ticker-box">
	<div id="ticker">
		<div class="ticker-heading">
			<?php echo esc_html($title); ?>
		</div>
		<!--ticker-heading-->
		<div id="ticker-list-box">
			<ul class="ticker-list">
				<?php 	if($post_type_pop == 'popular'){
							if( $duration == 'week'){					
								$week = date('W');
									$pop = array(
										'posts_per_page'=> $number,
										'w' => $week,
										'meta_key' => 'post_views_count',
										'orderby' => 'meta_value_num',
										'cat' => $categories,
										'order'    => 'DESC'
										);
										
							} elseif ($duration == 'year'){
								$year = date('Y');
									$pop = array(
										'posts_per_page'=> $number,
										'year'     => $year,
										'meta_key' => 'post_views_count',
										'orderby' => 'meta_value_num',
										'cat' => $categories,
										'order'    => 'DESC'
										);	
							} elseif($duration == 'month'){	
								$month = date('m');
									$pop = array(
										'posts_per_page'=> $number,
										'monthnum'     => $month,
										'meta_key' => 'post_views_count',
										'orderby' => 'meta_value_num',
										'cat' => $categories,
										'order'    => 'DESC'
										);
							}elseif($duration == 'forever'){
									$pop = array(
										'posts_per_page'=> $number,
										'meta_key' => 'post_views_count',
										'orderby' => 'meta_value_num',
										'cat' => $categories,
										'order'    => 'DESC'
										);	
							}
							$sci1_posts = new WP_Query($pop);
						}else{
							$sci1_posts = new WP_Query(array( 'cat' => $categories, 'posts_per_page' => $number));
						}

				 while($sci1_posts->have_posts()) : $sci1_posts->the_post();?>
				<li <?php post_class((is_sticky()?'sticky':'')); ?>>
					<a href="<?php the_permalink(); ?>">
					<span class="ticker-sign" title="<?php the_title(); ?>">
					<?php echo esc_html($sign_before_link); ?>
					</span>
					<?php the_title(); ?>
					</a>
				</li>
				<?php endwhile; ?>
			</ul>
			<div class="ticker-arrows">
				<a class="ticker-left">
				</a>
				<a class="ticker-right">
				</a>
			</div>
		</div>
		<!--ticker-list-box-->
	</div>
	<!--ticker-->
</div>
<!--ticker-box-->
<?php

	/* After widget. */
		
		echo $args['after_widget'];
		}

	/* Widget settings. */
	
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags. */
		
		$instance['title'] = $new_instance['title'];
		$instance['number'] =$new_instance['number'];
		$instance['categories'] = $new_instance['categories'];
		$instance['widget_size'] = $new_instance['widget_size'];
		$instance['sign_before_link'] = $new_instance['sign_before_link'];
		$instance['duration'] =  $new_instance['duration'];
		$instance['post_type_pop'] =  $new_instance['post_type_pop'];
		

		return $instance;
	}


	function form( $instance ) {

		/* Default widget settings. */
		
		$defaults = array( 'title' => 'Breaking News', 'number' => 10, 'categories' => 0, 'widget_size' => 'body-width-ticker', 'sign_before_link' => '+', 'duration' => 'forever', 'post_type_pop' => 'latest');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

<!-- Widget Title-->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Ticker Title:', 'science-magazine');?> </label>
	<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_textarea($instance['title']); ?>" style="width:90%;" />
</p>

<!-- Width -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id('widget_size')); ?>"><?php _e('Widget width:', 'science-magazine');?> </label>
	<select name="<?php echo esc_attr($this->get_field_name('widget_size')); ?>" id="<?php echo esc_attr($this->get_field_id('widget_size')); ?>" class="widefat" >
		<?php $options = array('body-width-ticker', 'fullwidth-ticker');
		foreach ($options as $option) {?>
		<option value='<?php echo esc_attr($option); ?>' <?php if ($option == $instance['widget_size']) echo 'selected="selected"'; ?>><?php echo esc_html($option); ?></option>
		<?php } ?>
	</select>
</p>

<!-- Maximum number of posts -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"> <?php _e('Number of posts:', 'science-magazine');?>  </label>
	<input type="number" min="1" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" value="<?php echo esc_attr($instance['number']); ?>" size="3" />
</p>

<!-- sign before -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'sign_before_link' )); ?>"> <?php _e('Sign before post:', 'science-magazine');?>  </label>
	<input id="<?php echo esc_attr($this->get_field_id( 'sign_before_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'sign_before_link' )); ?>" value="<?php echo esc_attr($instance['sign_before_link']); ?>" size="3" />
</p>

<!-- Category -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id('categories')); ?>">
		<?php _e('(Optional)Select Category:', 'science-magazine'); ?>
	</label>
	<select id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" style="width:100%;">
		<option value='all' <?php if ('all' == (isset($instance['categories']))) echo 'selected="selected"'; ?>>
		<?php _e('All Categories', 'science-magazine'); ?>
		</option>
		<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
		<?php foreach($categories as $category) { ?>
		<option value='<?php echo esc_attr($category->term_id); ?>' <?php if(isset($instance['categories'])){ if ($category->term_id == $instance['categories']) echo 'selected="selected"';}?>>
		<?php echo esc_html($category->cat_name); ?>
		</option>
		<?php } ?>
	</select>
</p>
<!--Post Type-->
<p>
	<label for="<?php echo esc_attr($this->get_field_id('post_type_pop')); ?>"><?php _e('Latest or Popular posts:', 'science-magazine'); ?></label>
	<select name="<?php echo esc_attr($this->get_field_name('post_type_pop')); ?>" id="<?php echo esc_attr($this->get_field_id('post_type_pop')); ?>" class="widefat" >
		<?php $options = array('latest', 'popular');
		foreach ($options as $option) {?>
		<option value='<?php echo esc_html($option); ?>' <?php if ($option == $instance['post_type_pop']) echo 'selected="selected"'; ?>><?php echo esc_html($option); ?></option>
		<?php } ?>
	</select>
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


<?php }}?>