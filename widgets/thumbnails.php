<?php   

/* 
Plugin Name: Thumbnails
Description: Thumbnails widget 
Version: 1.0 
Author: Stefan Naumovski 
*/    

add_action( 'widgets_init', 'thumbnails_widget' );

function thumbnails_widget() {register_widget( 'thumbnails_widget_sci1' );}

class thumbnails_widget_sci1 extends WP_Widget {
	
	/* Register widget with WordPress. */
	
	function __construct() {
		parent::__construct(
			'thumbnails_sci1', // Widget ID
			__('Thumbnails', 'science-magazine'), // Name
			array( 'description' => '', ) // Args
			);}
		
		/* Front-end display of widget. */
	public function widget( $args, $instance ) {
		
		/* Default widget settings. */
		
		$defaults = array( 'title' => 'Thumbnail widget', 'number' => 3, 'widget_size' => 'one-part', 'categories' => 0, 'offset' => 0, 'date' => 'on', 'cat_show' => 'on');
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		
		$title = $instance['title'];
		$number = $instance['number'];
		$offset = $instance['offset'];
		$categories = $instance['categories'];
		$widget_size = $instance['widget_size'];
		$date = $instance['date'];
		$cat_show = $instance['cat_show'];
						
		$args['before_widget'] = str_replace('class="home-widget', 'class="home-widget '. esc_attr($widget_size) , $args['before_widget']);							
		echo $args['before_widget'];
		if ( ! empty( $title ) ){
			echo $args['before_title'];		
				if($categories != 0){echo '<a href='.esc_url(get_category_link( $categories )).'>';}		
			echo esc_html($title); 			
				if($categories != 0){echo '</a>';}
			echo $args['after_title'];}
			?>

<ul class="featured-thumbnails">
	<?php $sci1_posts = new WP_Query(array( 'cat' => $categories, 'posts_per_page' => $number, 'offset' => $offset )); while ( $sci1_posts->have_posts()) : $sci1_posts->the_post(); ?>
	<li <?php post_class((is_sticky()?'sticky':'')); ?>>
		<div class="featured-posts-image">
			<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<?php the_post_thumbnail('smallthumb'); ?>
			</a>
			<?php } ?>
		</div>
		<!---featured-posts-image-->
		<div class="featured-posts-text">
			<?php if($cat_show) { ?>
			<span class="category-icon">
			<?php $category = get_the_category(); if($category[0]){echo '<a href="'.esc_url(get_category_link($category[0]->term_id )).'" title="'.esc_attr($category[0]->cat_name).'">'.esc_html($category[0]->cat_name).'</a>';} ?>
			</span>
			<?php } ?>
			<div class="featured-posts-title">
				<a href="<?php the_permalink(); ?>">
				<?php echo wp_trim_words( esc_html(get_the_title()), 10 ); ?>
				</a>
			</div>
			<!--featured-posts-title-->
			<?php if($date) { ?>
			<span class="post-date">
			<?php echo esc_html(get_the_date()); ?>
			</span>
			<?php } ?>
		</div>
		<!--featured-posts-text-->
	</li>
	<?php endwhile; ?>
</ul>
<?php
		/* After widget. */
		
		echo $args['after_widget'];
	}
	
		/* Widget settings. */
		
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		/* Strip tags. */
		
		$instance['title'] = $new_instance['title'];
		$instance['number'] = $new_instance['number'];
		$instance['offset'] = $new_instance['offset'];
		$instance['categories'] = $new_instance['categories'];	
		$instance['widget_size'] = $new_instance['widget_size'];	
		$instance['date'] = $new_instance['date'];	
		$instance['cat_show'] = $new_instance['cat_show'];	
		return $instance;
	}
	

	function form( $instance ) {
		
		/* Default widget settings. */
		
		$defaults = array( 'title' => 'Thumbnail widget', 'number' => 3, 'widget_size' => 'one-part', 'categories' => 0, 'offset' => 0, 'date' => 'on', 'cat_show' => 'on');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

<!-- Widget Title-->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
		<?php _e('Title:', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_textarea($instance['title']); ?>" style="width:90%;" />
</p>

<!-- widget_size -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'widget_size' )); ?>">
		<?php _e('Widget size:', 'science-magazine'); ?>
	</label>
	<br>
	<input type="radio" name="<?php echo esc_attr($this->get_field_name( 'widget_size' )); ?>" value="one-part" <?php checked('one-part', $instance['widget_size']); ?> class="one-part"/>
	<input type="radio" name="<?php echo esc_attr($this->get_field_name( 'widget_size' )); ?>" value="two-parts" <?php checked('two-parts', $instance['widget_size']); ?> class="two-parts" />
	<input type="radio" name="<?php echo esc_attr($this->get_field_name( 'widget_size' )); ?>" value="three-parts" <?php checked('three-parts', $instance['widget_size']); ?> class="three-parts"/>
	<input type="radio" name="<?php echo esc_attr($this->get_field_name( 'widget_size' )); ?>" value="four-parts" <?php checked('four-parts', $instance['widget_size']); ?> class="four-parts"/>
</p>

<!-- Number of posts -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>">
		<?php _e('Number of posts to show:', 'science-magazine'); ?>
	</label>
	<input type="number" min="1" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" value="<?php echo esc_attr($instance['number']); ?>" size="3" />
</p>

<!-- Offset posts -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'offset' )); ?>">
		<?php _e('Forward Posts(offset):', 'science-magazine'); ?>
	</label>
	<input type="number" min="0" id="<?php echo esc_attr($this->get_field_id( 'offset' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'offset' )); ?>" value="<?php echo esc_attr($instance['offset']); ?>" size="3" />
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

<!-- Date -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'date' )); ?>">
		<?php _e('Show Date:', 'science-magazine'); ?>
	</label>
	<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'date' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'date' )); ?>" <?php checked( (bool) $instance['date'], true ); ?> />
</p>

<!-- category show -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'cat_show' )); ?>">
		<?php _e('Show category:', 'science-magazine'); ?>
	</label>
	<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'cat_show' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'cat_show' )); ?>" <?php checked( (bool) $instance['cat_show'], true ); ?> />
</p>
<?php }} ?>